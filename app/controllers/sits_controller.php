<?php
class SitsController extends AppController {

	var $name = 'Sits';

	function admin_index() {
		$this->Sit->recursive = 0;
		$this->set('data', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sit', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('data', $this->Sit->read(null, $id));
	}

	function admin_add($id = null) {
		if (!empty($this->data)) {
			$this->Sit->create();
			if ($this->Sit->save($this->data)) {
				$this->Session->setFlash(__('Butaca agregada', true), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Error al agregar butaca', true), 'flash_error');
			}
		} else {
			if (!empty($id)) {
				$this->data = $this->Sit->read(null, $id);
				$this->set('id', $this->data['Sit']['id']);
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

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for sit', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Sit->delete($id)) {
			$this->Session->setFlash(__('Butaca eliminada', true), 'flash_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Error al eliminar Butaca', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>