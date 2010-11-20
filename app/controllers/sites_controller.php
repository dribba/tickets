<?php
class SitesController extends AppController {


	function admin_index() {
		//$this->Event->recursive = 0;
		$this->Filter->process();
		$this->set('data', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid event', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$data = $this->Site->findById($id);
		$this->set('data', $data);
	}
	
	function admin_add($id = null) {

		if (!empty($this->data)) {

			$allowedExtensions = array('jpg', 'gif', 'png');
			$extension = array_pop(explode('.', $this->data['Site']['plane']['name']));		
			if (!empty($this->data['Site']['plane']['name'])) {

				if (!in_array($extension, $allowedExtensions)) {
					$this->Session->setFlash(__('Sólo se permiten archivos de tipo imagen', true), 'flash_error');
					$this->Site->invalidate('Site.plane');
				} else {

					$plane = uniqid();
					$uploadfile = IMAGES . $plane;

					if (move_uploaded_file($this->data['Site']['plane']['tmp_name'], $uploadfile)) {
						$this->data['Site']['plane'] = $plane . '|' .
							strtolower(basename($this->data['Site']['plane']['name']));
					} else {
						$this->Session->setFlash(__('Error subiendo la imagen', true), 'flash_error');
						$this->Site->invalidate('Site.plane');
					}
				}
			} else {
				unset($this->data['Site']['plane']);
			}

			if ($this->Site->save($this->data)) {
				$this->Session->setFlash(__('Sitio agregado', true), 'flash_success');
			} else {
				$this->Session->setFlash(__('El sitio no se pudo agregar', true), 'flash_error');
			}
			$this->redirect(array('action' => 'index'));

		} else {
			if (!empty($id)) {
				$this->data = $this->Site->read(null, $id);
				$this->set('id', $this->data['Site']['id']);
			}
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for site', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Site->delete($id)) {
			$this->Session->setFlash(__('Sitio eliminado', true), 'flash_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Error al eliminar sitio', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}