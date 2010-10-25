<?php
class Event extends AppModel {
	var $name = 'Event';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Sit' => array(
			'className' => 'Sit',
			'joinTable' => 'events_sits',
			'foreignKey' => 'event_id',
			'associationForeignKey' => 'sit_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}