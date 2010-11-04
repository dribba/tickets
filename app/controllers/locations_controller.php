<?php
class LocationsController extends AppController {

	function admin_index() {
		$this->set('sites', $this->Location->Site->find('list'));
		$this->Filter->process();
		$this->set('data', $this->paginate());
	}

	private function __view($id = null, $wizard = false) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid location', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->Location->contain(array('Price.Event'));
		$location = $this->Location->read(null, $id);

		$location += $this->Location->Sit->getSitsByLocationAndEvent($location['Location']['id'], 2);
		$this->set('data', $location);
		if (!$wizard) {
			$this->render('admin_view');
		} else {
			$this->render('view');
		}
	}

	function view($id = null) {
		$this->__view($id, true);
	}

	function admin_view($id) {
		$this->__view($id);
	}


	function admin_full_screen($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid location', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->Location->recursive = -1;
		$location = $this->Location->read(null, $id);

		$location += $this->Location->Sit->getSitsByLocationAndEvent($location['Location']['id'], 2);
		$this->set('data', $location);
		$this->render('../elements/table', 'print');
	}


	function admin_add($id = null) {
		$this->set('sites', $this->Location->Site->find('list'));
		if (!empty($this->data)) {
			$this->Location->create();
			if ($this->Location->save($this->data)) {
				$this->Session->setFlash(__('Locacion agregada', true), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La locacion no se pudo agregar', true), 'flash_error');
			}
		} else {
			if (!empty($id)) {
				$this->data = $this->Location->read(null, $id);
				$this->set('id', $this->data['Location']['id']);
			}
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for location', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Location->delete($id)) {
			$this->Session->setFlash(__('Locacion eliminada', true), 'flash_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Error al eliminar locacion', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}