<?php
class EventsSit extends AppModel {
	var $name = 'EventsSit';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Event' => array(
			'className' => 'Event',
			'foreignKey' => 'event_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Sit' => array(
			'className' => 'Sit',
			'foreignKey' => 'sit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Sell' => array(
			'className' => 'Sell',
			'foreignKey' => 'sell_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);



	function findStats($eventId, $locationId = null) {

		ds($this->find('all',
			array(
				'contain'		=> array('Sit'),
				'fields' 		=> array('Sit.location_id', 'COUNT(EventsSit.id) AS count'),
				'conditions'	=> array('EventsSit.event_id' => $eventId),
				'group'			=> array('Sit.location_id'),
			)
		));

	}


	
}