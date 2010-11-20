<?php
class PricesController extends AppController {


	function admin_index() {
		$this->Filter->process();
		$locations = $this->Price->Location->find('all', array('contain' => 'Site'));
		$this->set('locations',
			Set::combine($locations, '{n}.Location.id', '{n}.Location.name', '{n}.Site.name')
		);
		$this->set('events', $this->Price->Event->find('list'));

		$this->set('data', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sit', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('data', $this->Price->read(null, $id));
	}

	function admin_add($id = null) {
		if (!empty($this->data)) {
			$this->Price->create();
			if ($this->Price->save($this->data)) {
				$this->Session->setFlash(__('Precio agregado', true), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Error al agregar/modificar el precio', true), 'flash_error');
			}
		} else {
			if (!empty($id)) {
				$this->data = $this->Price->read(null, $id);
				$this->set('id', $this->data['Price']['id']);

				$locations = $this->Price->Location->find('list',
					array('conditions' => array('Location.site_id' => $this->data['Event']['site_id']))
				);
				$this->set(compact('locations'));
			}
		}
		$events = $this->Price->Event->find('list');
		$this->set(compact('events'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for sit', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Price->delete($id)) {
			$this->Session->setFlash(__('Precio eliminada', true), 'flash_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Error al eliminar Precio', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}

}