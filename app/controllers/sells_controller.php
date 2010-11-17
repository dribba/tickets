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
		//$this->paginate['contain'] = array('EventsSit.Sit.Location', 'EventsSit.Event');
		$this->paginate['contain'] = array(
			'SellsDetail.EventsSit.Sit.Location',
			'SellsDetail.EventsSit.Event'
		);
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

	function sell($step = null, $sit = null) {
		$this->layout = 'talleres';
		if ($step == 3) {

			$this->set('step', 3);
			$this->set('sit', $sit);

		} else {
			if (empty($this->data)) {

				$this->set('events',
					$this->Sell->SellsDetail->EventsSit->Event->find('all',
						array(
							'recursive'		=> -1,
							'conditions' 	=> array('Event.state' => 'active')
						)
					)
				);
				$this->set('step', 1);
			} else if ($this->data['Sell']['step'] == 1) {

				$this->set('step', 2);
				$sell['Sell']['event_id'] = $this->data['Sell']['event_id'];
				$this->Session->write('sellData', $sell);
			} else if ($this->data['Sell']['step'] == 2) {
				
				$this->set('step', 3);

				$sellData = $this->Session->read('sellData');
				$sellData['Sell']['sits_ids'] = $this->data['Sell']['sits_ids'];
				$this->Session->write('sellData', $sellData);
				
			} else if ($this->data['Sell']['step'] == 3) {

				$sellData = $this->Session->read('sellData');
				$this->Session->write('sellData', array_merge($sellData['Sell'], $this->data['Sell']));

				//Sell resume
				$sellData = $this->Session->read('sellData');
				$ids = explode(',', $sellData['sits_ids']);
				$sits = $this->Sell->SellsDetail->EventsSit->Sit->find('all',
					array(
						'contain'		=> array('Location.Price'),
						'conditions'	=> array(
							'Sit.id' => $ids
						)
					)
				);
				$price = Set::combine($sits[0]['Location']['Price'], '{n}.type', '{n}');
				$this->set('price', $price[User::get('/User/type')]['price']);
				$this->set('data', $sits);

				$this->set('step', 4);

				
			} else if ($this->data['Sell']['step'] == 4) {
				$sellData = $this->Session->read('sellData');
				$this->Session->write('sellData', array_merge($sellData, $this->data['Sell']));

				$this->set('step', 5);
				
			} else if ($this->data['Sell']['step'] == 5) {
				$this->set('step', 5);

				$sellData = $this->Session->read('sellData');
				$sellData['user_id'] = User::get('/User/id');
				unset($sellData['tos']);
				$sits_ids = explode(',', $sellData['sits_ids']);
				unset($sellData['sits_ids']);
				unset($sellData['step']);
				$event_id = $sellData['event_id'];
				unset($sellData['event_id']);
				$price = $sellData['price'];
				unset($sellData['price']);
				$sellData['date'] = date("Y-m-d");
				
				if ($this->Sell->save($sellData)) {

					foreach ($sits_ids as $sit) {
						$eventSits[]['EventsSit'] = array(
							'event_id'	=> $event_id,
							'sit_id'	=> $sit,
							'sell_id'	=> $this->Sell->id
						);
						$sellDetail[]['SellsDetail'] = array(
							'sell_id'		=> $this->Sell->id,
							'events_sit_id'	=> $sit,
							'price'			=> $price
						);
					}
					$this->Sell->SellsDetail->EventsSit->saveAll($eventSits);
					$this->Sell->SellsDetail->saveAll($sellDetail);
					//$this->Session->delete('sellData');
					$this->Session->setFlash(
						__('Compra realizada con exito', true), 'flash_success'
					);
				} else {
					$this->Session->setFlash(
						__('Se produjo un error al intentar realizar la compra', true), 'flash_error'
					);
				}
				$this->redirect(array('controller' => 'sells', 'action' => 'index'));
				//d($sellData);

			}
		}
	}

}