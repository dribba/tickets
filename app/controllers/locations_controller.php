<?php
class LocationsController extends AppController {

	function admin_index() {
		$this->set('sites', $this->Location->Site->find('list'));
		$this->Filter->process();
		$this->set('data', $this->paginate());
	}

	private function __view($id = null, $wizard = false, $full_screen = false, $event_id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid location', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->Location->contain(array('Price.Event'));
		$location = $this->Location->read(null, $id);

		if (empty($event_id)) {
			$event_id = $location['Price'][0]['event_id'];
		}

		$location += $this->Location->Sit->getSitsByLocationAndEvent($location['Location']['id'], $event_id);

		$this->set('data', $location);
		if ($full_screen) {
			$this->render('../elements/table', 'print');
		} else if(!$wizard) {
			$this->render('admin_view');
		} else {
			$this->render('view');
		}
	}

	function view($id = null, $full_screen = false) {
		$this->layout = 'talleres';
		$event_id = $this->Session->read('sellData');
		$this->__view($id, true, $full_screen, $event_id['Sell']['event_id']);
	}

	function admin_view($id, $full_screen = false) {
		$this->__view($id, false, $full_screen);
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