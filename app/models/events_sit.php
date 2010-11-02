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

		$r = $this->find('all',
			array(
				'contain'		=> array('Sit'),
				'fields' 		=> array(
					'Sit.location_id',
					'COUNT(`EventsSit`.`id`) AS total_sits',
					'SUM(IF(`EventsSit`.`sell_id`>0, 1, 0)) AS total_selled_sits',
					'COUNT(`EventsSit`.`id`) - SUM(IF(`EventsSit`.`sell_id`>0, 1, 0)) AS total_free_sits'
				),
				'conditions'	=> array('EventsSit.event_id' => $eventId),
				'group'			=> array('Sit.location_id'),
			)
		);

		if (!empty($r)) {
			$locationIds = Set::extract('/Sit/location_id', $r);
			$r = Set::combine($r, '{n}.Sit.location_id', '{n}.0');

			$data = $this->Sit->Location->find('all',
				array(
					'contain'		=> array('Site'),
					'conditions'	=> array('Location.id' => $locationIds)
				)
			);
			foreach ($data as $k => $v) {
				$data[$k]['Location'] += $r[$data[$k]['Location']['id']];
			}
			d($data);
		}
	}


	
}