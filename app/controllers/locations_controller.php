<?php
class LocationsController extends AppController {

	function admin_index() {
		$this->set('sites', $this->Location->Site->find('list'));
		$this->Filter->process();
		$this->set('data', $this->paginate());
	}

	private function __view($id = null, $wizard = false, $eventId = null) {

		if (!$id) {
			$this->Session->setFlash(__('Invalid location', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->Location->contain(array('Price.Event', 'Sit'));
		$location = $this->Location->read(null, $id);
		unset($location['Sit']);
		$location += $this->Location->Sit->findSits($eventId, $id);
		$location += $this->Location->Sit->formatToPaint($location);

		/*
		if ($location['Location']['sits'] == count($location['sits'])) {
			$location['Location']['numbered'] = 1;
		} else {
			$location['Location']['numbered'] = 0;
		}
		*/

		$this->set('data', $location);


		if (!$wizard) {
   			$this->render('admin_view');
		} else {
			$this->render('view');
		}
	}

	function view($id, $eventId) {
		$this->layout = 'talleres';
		$this->__view($id, true, $eventId);
	}

	function admin_view($id) {
		$this->__view($id, false);
	}

	function admin_add($id = null) {
		$this->set('sites', $this->Location->Site->find('list'));
		if (!empty($this->data)) {
			$this->Location->create();
			if ($this->Location->save($this->data)) {
				$this->Session->setFlash(__('Ubicación agregada', true), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La ubicación no se pudo agregar', true), 'flash_error');
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
			$this->Session->setFlash(__('Ubicación eliminada', true), 'flash_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Error al eliminar ubicación', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}