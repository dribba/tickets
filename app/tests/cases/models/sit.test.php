<?php
/* Sit Test cases generated on: 2010-10-18 13:10:49 : 1287418249*/
App::import('Model', 'Sit');

class SitTestCase extends CakeTestCase {
	var $fixtures = array('app.sit', 'app.location', 'app.event', 'app.events_sit');

	function startTest() {
		$this->Sit =& ClassRegistry::init('Sit');
	}

	function endTest() {
		unset($this->Sit);
		ClassRegistry::flush();
	}

}
?>