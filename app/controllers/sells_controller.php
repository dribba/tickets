<?php
class SellsController extends AppController {


	function admin_stats($period = null) {
		$title = __('Resultado de la busqueda', true);
		$conditions['Sell.date <='] = date('Y-m-d');
		switch($period) {
			case 'today':
				$conditions['Sell.date >='] = date('Y-m-d');
				$title = __('Ventas del Dia', true);
			break;
			case 'week':
				$conditions['Sell.date >='] = date('Y-m-d', strtotime('-1 week'));
				$title = __('Ventas de la Semana', true);
			break;
			case 'month':
				$conditions['Sell.date >='] = date('Y-m-d', strtotime('-1 month'));
				$title = __('Ventas del Mes', true);
			break;
			case 'all':
				$title = __('Todas las Ventas', true);
			break;
		}
		
		$this->paginate['limit'] = 1000;
		
		$extraConditions = $this->Filter->process(true);

		$this->paginate['conditions'] = array_merge($conditions, $extraConditions);
		//d($this->paginate['conditions']);
		
		$data = $this->paginate();
		$this->set('data', $data);
		$this->set('title', $title);
	}
	

	function index() {
		$this->layout = 'talleres';
		$this->paginate['contain'] = array('Event', 'SellsDetail.EventsSit' => array('Sit.Location'));
		$this->paginate['conditions'] = array('Sell.user_id' => User::get('/User/id'));
		$this->__index();
	}

	function admin_index() {
		$this->Filter->process();
		$this->__index();
	}

	function __index() {
		$this->paginate['order'] = array('Sell.created' => 'DESC');
		$this->set('data', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sell', true));
			$this->redirect(array('action' => 'index'));
		}


		$data = $this->Sell->find('first',
			array(
				'contain'		=> array(
					'User',
					'SellsDetail.EventsSit.Event',
					'SellsDetail.EventsSit.Sit.Location'
				),
				'conditions'	=> array(
					'Sell.id'	=> $id
				)
			)
		);
		$this->set('data', $data);
	}

	function admin_add($id = null) {
		if (!empty($this->data)) {
			$this->Sell->create();
			if ($this->Sell->save($this->data)) {
				$this->Session->setFlash(__('Venta guardada', true), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La venta no se pudo guardar', true), 'flash_error');
			}
		} else {
			if (!empty($id)) {
				$this->data = $this->Sell->read(null, $id);
				$this->set('id', $this->data['Sell']['id']);
			}
		}
		//$this->set('sites', $this->Sell->Site->find('list'));
	}

	/*function sell() {
		$this->set('locations', $this->Sell->Location->find('list'));
		//d($this->Sell->EventsSit->Sit->find('list'));

		if (!empty($this->data)) {
			$this->Sell->create();
			if ($this->Sell->save($this->data)) {
				$this->Session->setFlash(__('The sell has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sell could not be saved. Please, try again.', true));
			}
		}
	}
	 */

	function sell($step = 0) {

		$this->layout = 'talleres';

		if ($step == 0) { //Select event

			// ensure no previous data is in the session
			$this->Session->delete('sellData');

			$this->set('step', 1);

			$this->set('events',
				$this->Sell->SellsDetail->EventsSit->Event->find('all',
					array(
						'recursive'		=> -1,
						'conditions' 	=> array('Event.state' => 'active')
					)
				)
			);

		} elseif ($step == 1) {  //Select location

			$this->set('step', 2);

			$Site = ClassRegistry::init('Site');
			$Site->recursive = -1;
			$sellData = $Site->findById($this->params['named']['site']);

			$this->set('data', $sellData);
			$sellData['event_id'] = $this->params['named']['event'];
			$this->Session->write('sellData', $sellData);

		} elseif ($step == 2) { // Select sits [optional]

			$this->set('step', 3);

			$sellData = $this->Session->read('sellData');
			$this->Sell->SellsDetail->EventsSit->Sit->Location->recursive = -1;
			$sellData += $this->Sell->SellsDetail->EventsSit->Sit->Location->findById($this->params['named']['location']);
			$this->Session->write('sellData', $sellData);

			$this->set('sellData', $sellData);

		} elseif ($step == 3) { // tos


			$this->set('step', 4);

			$sellData = $this->Session->read('sellData');
			$sellData['numbered'] = $this->params['named']['numbered'];

			if (!$this->params['named']['numbered']) {
				// must search for n emty sits in the locations & event
				$eventsSit = $this->Sell->SellsDetail->EventsSit->find('all',
					array(
						'contain'		=> array('Sit'),
						'conditions'	=> array(
							'Sit.location_id' 		=> $sellData['Location']['id'],
							'EventsSit.event_id'	=> $sellData['event_id'],
							'EventsSit.state'		=> 'En venta',
							'EventsSit.sell_id'		=> '0',
						),
						'limit'			=> $this->params['named']['sits']
					)
				);

				if (count($eventsSit) < $this->params['named']['sits']) {
					$this->Session->setFlash(
						__('No hay butacas suficientes para el evento', true), 'flash_error'
					);
					$this->redirect(array('controller' => 'sells', 'action' => 'sell'));
				} else {
					$this->params['named']['sits'] = implode('|', Set::extract('/EventsSit/sit_id', $eventsSit));
				}
			}

			$sellData['sits'] = $this->Sell->SellsDetail->EventsSit->Sit->find('all',
				array(
					'contain'		=> array('Location.Price'),
					'conditions'	=> array(
						'Sit.id' 	=> explode('|', $this->params['named']['sits'])
					)
				)
			);

			$userType = User::get('/User/type');
			$sub_total = 0;
			foreach ($sellData['sits'] as $k => $sit) {
				$price = Set::combine($sit['Location']['Price'], '{n}.type', '{n}');
				$sellData['sits'][$k]['Sit']['price'] = $price[$userType]['price'];
				$sub_total += $price[$userType]['price'];
			}
			$sellData['sub_total'] = $sub_total;

			$this->Session->write('sellData', $sellData);

		} elseif ($step == 4) { // resume

			$this->set('step', 5);

			$sellData = $this->Session->read('sellData');
			$sellData += $this->data['Sell'];

			$licensePrice = 0;
			if (!empty($sellData['license_available']) && $sellData['license_available'] == 'No') {
				$licensePrice = (($sellData['send'] == 'Si') ? '20' : '15');
			}
			$sellData['license_price'] = $licensePrice;

			$sellData['total'] = $sellData['sub_total'] + $licensePrice;

			$this->Session->write('sellData', $sellData);
			$this->set('sellData', $sellData);

		} elseif ($step == 5) { // payment

			$this->set('step', 6);

			$sellData = $this->Session->read('sellData');

			if ($this->params['named']['payment'] == 'card') {
				$sellData['payment'] = '4,5,6,14,15,16,17,18';
			} elseif ($this->params['named']['payment'] == 'cash') {
				$sellData['payment'] = '18,2';
			} elseif ($this->params['named']['payment'] == 'transfer') {
				$sellData['payment'] = '18,13';
			}

			$save['date'] = date('Y-m-d h:i:s');
			$save['state'] = 'Pendiente';
			$save['event_id'] = $sellData['event_id'];
			$save['user_id'] = User::get('/User/id');
			$save['license_available'] = $sellData['license_available'];
			$save['license_number'] = $sellData['license_number'];
			$save['send'] = $sellData['send'];
			$save['street'] = $sellData['street'];
			$save['horary'] = $sellData['horary'];
			$save['payment'] = $this->params['named']['payment'];
			$save['total'] = $sellData['total'];

			if ($this->Sell->save($save)) {

				$sellDetail = array();
				foreach ($sellData['sits'] as $sit) {

					$eventsSit = $this->Sell->SellsDetail->EventsSit->find('first',
						array(
							'recursive'		=> -1,
							'conditions' 	=> array(
								'EventsSit.event_id'	=> $sellData['event_id'],
								'EventsSit.sit_id'		=> $sit['Sit']['id']
							)
						)
					);

					$this->Sell->SellsDetail->EventsSit->save(
						array('EventsSit' =>
							array(
								'id'		=> $eventsSit['EventsSit']['id'],
								'state'		=> 'Vendido',
								'sell_id' 	=> $this->Sell->id
							)
						)
					);

					$sellDetail[]['SellsDetail'] = array(
						'sell_id'		=> $this->Sell->id,
						'events_sit_id'	=> $eventsSit['EventsSit']['id'],
						'price'			=> $sit['Sit']['price']
					);
				}
				$this->Sell->SellsDetail->saveAll($sellDetail);


				$this->set('data', $this->Sell->id);
				$this->render('../elements/only_text', 'ajax');
		
				$this->Session->setFlash(
					__('Compra realizada con exito', true), 'flash_success'
				);

			} else {

				$this->Session->setFlash(
					__('Se produjo un error al intentar realizar la compra', true), 'flash_error'
				);

				$this->redirect(array('controller' => 'sells', 'action' => 'index'));

			}

		} // step 6
	}

}