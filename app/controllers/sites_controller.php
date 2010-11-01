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
	
	function isUploadedFile($params){
		$val = array_shift($params);
		if ((isset($val['error']) && $val['error'] == 0) ||
		(!empty( $val['tmp_name']) && $val['tmp_name'] != 'none')) {
			return is_uploaded_file($val['tmp_name']);
		}
		return false;
	}

	function admin_add($id = null) {
		if (!empty($this->data)) {
			$this->Site->create();


			$allowedExtensions = array('jpg', 'jpeg', 'png');
			$extension = strtolower(substr($this->data['Site']['plane']['name'], -3));
			
			if (!in_array($extension, $allowedExtensions)) {
				$this->Session->setFlash(__('Solo se permiten archivos del tipo imagen', true), 'flash_error');
				$this->Site->invalidate('Site.plane');
			}

			$plane = uniqid();

			$uploaddir = WWW_ROOT . DS . 'files' . DS;
			$uploadfile = $uploaddir . $plane;
			
			if (move_uploaded_file($this->data['Site']['plane']['tmp_name'], $uploadfile)) {

				$this->data['Site']['plane'] = $plane . 
					'|' .
					strtolower(basename($this->data['Site']['plane']['name']));
			} else {
				$this->Session->setFlash(__('Error subiendo archivo', true), 'flash_error');
				$this->Site->invalidate('Site.plane');
			}
			
			
			if ($this->Site->save($this->data)) {
				$this->Session->setFlash(__('Sitio agregado', true), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El sitio no se pudo agregar', true), 'flash_error');
			}
		} else {
			if (!empty($id)) {
				$this->data = $this->Site->read(null, $id);
				$this->set('id', $this->data['Site']['id']);
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid site', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Site->save($this->data)) {
				$this->Session->setFlash(__('The event has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Event->read(null, $id);
		}
		$sits = $this->Event->Site->find('list');
		$this->set(compact('sits'));
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
?>