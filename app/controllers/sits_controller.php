<?php
class SitsController extends AppController {

	var $name = 'Sits';

	function index() {
		$this->Sit->recursive = 0;
		$this->set('sits', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sit', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('sit', $this->Sit->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Sit->create();
			if ($this->Sit->save($this->data)) {
				$this->Session->setFlash(__('The sit has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sit could not be saved. Please, try again.', true));
			}
		}
		$locations = $this->Sit->Location->find('list');
		$events = $this->Sit->Event->find('list');
		$this->set(compact('locations', 'events'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid sit', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Sit->save($this->data)) {
				$this->Session->setFlash(__('The sit has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sit could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Sit->read(null, $id);
		}
		$locations = $this->Sit->Location->find('list');
		$events = $this->Sit->Event->find('list');
		$this->set(compact('locations', 'events'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for sit', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Sit->delete($id)) {
			$this->Session->setFlash(__('Sit deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Sit was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>