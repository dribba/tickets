<?php
class SellsController extends AppController {

	var $name = 'Sells';

	function index() {
		//$this->Sell->recursive = 0;
		$this->paginate['conditions'] = array('Sell.user_id' => 2);
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

	function sell() {

		if (empty($this->data)) {
			$this->set('locations', $this->Sell->Location->find('list'));
			$this->set('step', 1);
		} else {

			if ($this->data['Sell']['step'] == 1) {

				$this->Sell->set($this->data);

				if ($this->Sell->validates()) {


						$this->Session->write('user_data', $this->data);
						$this->Session->write('valid_data', $valid);
						$this->set('validation_data', $data);

					$this->set('step', 2);
				} else {
					$this->set('step', 1);
				}
			} else if ($this->data['Sell']['step'] == 2) {

				$this->set('step', 3);

				$validData = $this->Session->read('valid_data');

				$this->redirect(array('controller' => 'sells', 'action' => 'index'));
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