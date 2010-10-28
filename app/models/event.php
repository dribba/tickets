<?php
class Event extends AppModel {
	var $name = 'Event';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $virtualFields = array(
		'formated_start' => 'DATE_FORMAT(Event.start, "%d/%m/%Y %H:%i")',
		'formated_end' => 'DATE_FORMAT(Event.end, "%d/%m/%Y %H:%i")'
	);
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

	protected function _initialitation() {

		$this->validate = array(
			'name' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __("Ingrese el nombre del evento", true),
					'last' => true, // Stop validation after this rule
				),
			)
		);

    }

}