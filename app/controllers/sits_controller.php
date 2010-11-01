<?php
class SitsController extends AppController {

	var $name = 'Sits';


	function load() {
		set_include_path(get_include_path() . PATH_SEPARATOR . APP . 'vendors' . DS . 'PHPExcel' . DS . 'Classes');
		App::import('Vendor', 'IOFactory', true, array(APP . 'vendors' . DS . 'PHPExcel' . DS . 'Classes' . DS . 'PHPExcel'), 'IOFactory.php');

		$file = '/tmp/PlateaAlta.xls';
		if (preg_match("/.*\.xls$/", $file)) {
			$objReader = PHPExcel_IOFactory::createReader('Excel5');
		} elseif (preg_match("/.*\.xlsx$/", $file)) {
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		}
		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($file);

		$highestCol = PHPExcel_Cell::columnIndexFromString(
			$objPHPExcel->getActiveSheet()->getHighestColumn()
		);
		$highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();


		$matrix = array();

		for ($row = 1; $row < $highestRow; $row++) {
			for ($col = 1; $col < $highestCol; $col++) {
				$v = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row)->getValue();
				$matrix[$row][$col] = $v;
			}
		}

		

		$this->Sit->saveAll();

		d($matrix);

	}

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
		$this->set(compact('locations'));
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

	function admin_table() {
		$axis = $this->Sit->query('SELECT MAX(`Sits`.`x`) AS x, MAX(`Sits`.`y`) AS y FROM sits AS Sits');
		$sits = $this->Sit->find('all', array('recursive' => -1));
		$data['axis'] = $axis[0][0];
		$data['sits'] = $sits;
		$this->set('data', $data);
	}
}
?>