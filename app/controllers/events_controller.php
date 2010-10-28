<?php
class EventsController extends AppController {


	function admin_index() {
		//$this->Event->recursive = 0;
		$this->set('data', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid event', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('data', $this->Event->read(null, $id));
	}

	function admin_add($id = null) {
		if (!empty($this->data)) {
			$this->Event->create();
			if ($this->Event->save($this->data)) {
				$this->Session->setFlash(__('Evento agregado', true), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El evento no se pudo agregar', true), 'flash_error');
			}
		} else {
			if (!empty($id)) {
				$this->data = $this->Event->read(null, $id);
				$this->set('id', $this->data['Event']['id']);
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid event', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Event->save($this->data)) {
				$this->Session->setFlash(__('The event has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Event->read(null, $id);
		}
		$sits = $this->Event->Sit->find('list');
		$this->set(compact('sits'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for event', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Event->delete($id)) {
			$this->Session->setFlash(__('Evento eliminado', true), 'flash_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Error al eliminar evento', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>