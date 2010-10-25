<?php
/* Sells Test cases generated on: 2010-10-18 14:10:54 : 1287423834*/
App::import('Controller', 'Sells');

class TestSellsController extends SellsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SellsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.sell', 'app.user', 'app.events_sit', 'app.event', 'app.sit', 'app.location');

	function startTest() {
		$this->Sells =& new TestSellsController();
		$this->Sells->constructClasses();
	}

	function endTest() {
		unset($this->Sells);
		ClassRegistry::flush();
	}

}
?>