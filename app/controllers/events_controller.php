<?php
class EventsController extends AppController {


	function admin_stat($eventId, $locationId) {


		$data['width'] = 250;
		$data['height'] = 150;
		$data['title'] = __('Estadistica de ventas', true);
		
		$r = $this->Event->findStats($eventId, $locationId);
		
		//$data['legends'] = array('Libres (%1.1f%%)', 'Vendidas (%1.1f%%)');
		$data['legends'] = array(
			'Libres (' . $r['Location']['total_free_sits'] . ')',
			'Vendidas (' . $r['Location']['total_selled_sits'] . ')'
		);
		$data['data'] = array($r['Location']['total_free_sits'], $r['Location']['total_selled_sits']);

		$this->set('data', $data);
		$this->render('../elements/charts/pie', 'ajax');
	}



	function admin_index() {
		//$this->Event->recursive = 0;
		$this->set('sites', $this->Event->Site->find('list'));
		$this->Filter->process();
		$this->set('data', $this->paginate());
	}

	function admin_view($id = null) {

		if (!$id) {
			$this->Session->setFlash(__('Invalid event', true));
			$this->redirect(array('action' => 'index'));
		}

		$stat = $this->Event->daily_stat($id, date('Y-m-d'));
		
		$this->set('stat', $stat);
		//$stats = $this->Event->EventsSit->findStats($id);
		//d($this->Event->EventsSit->Sit->findSits($id));
		$this->Event->contain('Site.Location');
		$data = $this->Event->findById($id);
		$this->set('data', $data);
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
		$this->set('sites', $this->Event->Site->find('list'));
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