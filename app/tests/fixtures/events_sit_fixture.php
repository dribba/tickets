<?php
/* EventsSit Fixture generated on: 2010-10-18 13:10:30 : 1287418170 */
class EventsSitFixture extends CakeTestFixture {
	var $name = 'EventsSit';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'event_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'sit_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'state' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'sell_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'event_id' => 1,
			'sit_id' => 1,
			'state' => 1,
			'sell_id' => 1,
			'created' => '2010-10-18 13:09:30',
			'modified' => '2010-10-18 13:09:30'
		),
	);
}
?>