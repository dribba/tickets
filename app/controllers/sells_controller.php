<?php
class SellsController extends AppController {

	var $name = 'Sells';

	function index() {
		$this->layout = 'talleres';
		$this->paginate['contain'] = array('EventsSit.Sit.Location', 'EventsSit.Event');
		$this->paginate['conditions'] = array('Sell.user_id' => User::get('/User/id'));
		$this->__index();
	}

	function admin_index() {
		$this->__index();
	}

	function __index() {
		$this->Filter->process();
		$this->set('data', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sell', true));
			$this->redirect(array('action' => 'index'));
		}

		$data = $this->Sell->findById($id);
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
					$this->Sell->EventsSit->Event->find(
						'list', array('conditions' => array('Event.state' => 'active'))
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
				$sits = $this->Sell->EventsSit->Sit->find('all',
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

				if ($this->Sell->save($sellData)) {

					foreach ($sits_ids as $sit) {
						$eventSits[]['EventsSit'] = array(
							'event_id'	=> $event_id,
							'sit_id'	=> $sit,
							'sell_id'	=> $this->Sell->id
						);
					}
					$this->Sell->EventsSit->saveAll($eventSits);

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

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for site', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Sell->delete($id)) {
			$this->Session->setFlash(__('Venta eliminada', true), 'flash_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Error al eliminar venta', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>