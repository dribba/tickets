<?php
/* EventsSit Test cases generated on: 2010-10-18 13:10:30 : 1287418170*/
App::import('Model', 'EventsSit');

class EventsSitTestCase extends CakeTestCase {
	var $fixtures = array('app.events_sit', 'app.event', 'app.sit', 'app.sell');

	function startTest() {
		$this->EventsSit =& ClassRegistry::init('EventsSit');
	}

	function endTest() {
		unset($this->EventsSit);
		ClassRegistry::flush();
	}

}
?>