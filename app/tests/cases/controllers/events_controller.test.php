<?php
/* Events Test cases generated on: 2010-10-18 13:10:20 : 1287418280*/
App::import('Controller', 'Events');

class TestEventsController extends EventsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EventsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.event', 'app.sit', 'app.location', 'app.events_sit');

	function startTest() {
		$this->Events =& new TestEventsController();
		$this->Events->constructClasses();
	}

	function endTest() {
		unset($this->Events);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>