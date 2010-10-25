<?php
/* EventsSits Test cases generated on: 2010-10-18 13:10:11 : 1287418451*/
App::import('Controller', 'EventsSits');

class TestEventsSitsController extends EventsSitsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EventsSitsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.events_sit', 'app.event', 'app.sit', 'app.location', 'app.sell', 'app.user');

	function startTest() {
		$this->EventsSits =& new TestEventsSitsController();
		$this->EventsSits->constructClasses();
	}

	function endTest() {
		unset($this->EventsSits);
		ClassRegistry::flush();
	}

}
?>