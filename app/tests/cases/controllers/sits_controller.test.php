<?php
/* Sits Test cases generated on: 2010-10-18 14:10:30 : 1287423930*/
App::import('Controller', 'Sits');

class TestSitsController extends SitsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SitsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.sit', 'app.location', 'app.event', 'app.events_sit');

	function startTest() {
		$this->Sits =& new TestSitsController();
		$this->Sits->constructClasses();
	}

	function endTest() {
		unset($this->Sits);
		ClassRegistry::flush();
	}

}
?>