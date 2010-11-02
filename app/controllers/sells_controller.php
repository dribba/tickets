<?php
class SellsController extends AppController {

	var $name = 'Sells';

	function index() {
		//$this->Sell->recursive = 0;
		$this->paginate['conditions'] = array('Sell.user_id' => User::get('/User/id'));
		$this->set('data', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sell', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('sell', $this->Sell->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Sell->create();
			if ($this->Sell->save($this->data)) {
				$this->Session->setFlash(__('The sell has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sell could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Sell->User->find('list');
		$this->set(compact('users'));
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

		if ($step == 2) {

			$this->set('step', 2);
			$this->set('sit', $sit);
				
			
		} else {
			if (empty($this->data)) {
				$this->set('locations', $this->Sell->Location->find('list'));
				$this->set('step', 1);
			} else if ($this->data['Sell']['step'] == 2) {
				$this->set('step', 3);
				$this->Session->write('sell_data', $this->data);
			} else if ($this->data['Sell']['step'] == 3) {
				$this->set('step', 4);

				$sellData = $this->Session->read('sell_data');
				$sellData['Sell']['user_id'] = User::get('/User/id');

				if ($this->Sell->save($sellData)) {

					$eventSit['EventsSit'] = array(
						'event_id'	=> 2,
						'sit_id'	=> $sellData['Sell']['sit_id'],
						'sell_id'	=> $this->Sell->id
					);
					$this->Sell->EventsSit->save($eventSit);

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

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid sell', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Sell->save($this->data)) {
				$this->Session->setFlash(__('The sell has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sell could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Sell->read(null, $id);
		}
		$users = $this->Sell->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for sell', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Sell->delete($id)) {
			$this->Session->setFlash(__('Sell deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Sell was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>