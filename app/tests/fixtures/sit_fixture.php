<?php
/* Sit Fixture generated on: 2010-10-18 13:10:49 : 1287418249 */
class SitFixture extends CakeTestFixture {
	var $name = 'Sit';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'location_id' => 1,
			'created' => '2010-10-18 13:10:49',
			'modified' => '2010-10-18 13:10:49'
		),
	);
}
?>