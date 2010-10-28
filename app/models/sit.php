<?php
class Sit extends AppModel {
	var $name = 'Sit';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array('Location', 'Event');

	var $hasAndBelongsToMany = array(
		'Event' => array(
			'className' => 'Event',
			'joinTable' => 'events_sits',
			'foreignKey' => 'sit_id',
			'associationForeignKey' => 'event_id',
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
			'code' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __("Ingrese el nombre del evento", true),
					'last' => true, // Stop validation after this rule
				),
			)
		);

    }

}