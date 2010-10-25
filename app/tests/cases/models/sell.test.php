<?php
/* Sell Test cases generated on: 2010-10-18 13:10:33 : 1287418353*/
App::import('Model', 'Sell');

class SellTestCase extends CakeTestCase {
	var $fixtures = array('app.sell', 'app.user', 'app.events_sit', 'app.event', 'app.sit', 'app.location');

	function startTest() {
		$this->Sell =& ClassRegistry::init('Sell');
	}

	function endTest() {
		unset($this->Sell);
		ClassRegistry::flush();
	}

}
?>