<?php
class Sit extends AppModel {
	var $name = 'Sit';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array('Location');

	var $hasMany = array('EventsSit');


	protected function _initialitation() {

		$this->validate = array(
			'location_id' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __('Seleccione la Ubicación', true),
					'last' => true,
				),
			)
		);

    }



	function findSits($eventId, $locationId = null) {

		$this->unbindModel(
			array(
				'hasMany'	=> array('EventsSit'),
			)
		);

		$options = array(
			'fields'		=> array('Sit.*', 'EventsSit.*', 'Location.*', 'Sell.*'),
			'joins' 		=> array(
				array(
					'table' => '`events_sits`',
					'alias' => 'EventsSit',
					'type' => 'LEFT',
					'conditions' => array(
						'EventsSit.sit_id = Sit.id',
						'EventsSit.event_id = ' . $eventId,
					)
				),
				array(
					'table' => '`sells`',
					'alias' => 'Sell',
					'type' => 'LEFT',
					'conditions' => array(
						'EventsSit.sell_id = Sell.id',
					)
				)
			),
			'order'			=> array(
				'Sit.row', 'Sit.col'
			),
			//'limit' 		=> 100,
		);

		if (!empty($locationId)) {
			$options['conditions'] = array('Sit.location_id' => $locationId);
		}

		return $this->find('all', $options);
	}


	function getSitsByLocationAndEvent($locationId, $eventId) {

		$this->unbindModel(
			array(
				'hasMany'	=> array('EventsSit'),
				'belongsTo'	=> array('Location')
			)
		);

		$sits = $this->find('all',
			array(
				'fields'		=> array('Sit.*', 'EventsSit.*', 'Sell.*'),
				'joins' 		=> array(
					array(
						'table' => '`events_sits`',
						'alias' => 'EventsSit',
						'type' => 'LEFT',
						'conditions' => array(
							'EventsSit.sit_id = Sit.id',
							'EventsSit.event_id = ' . $eventId,
						)
					),
					array(
						'table' => '`sells`',
						'alias' => 'Sell',
						'type' => 'LEFT',
						'conditions' => array(
							'EventsSit.sell_id = Sell.id',
						)
					)
				),
				'conditions' 	=> array(
					'Sit.location_id' => $locationId
				),
				'order'			=> array(
					'Sit.row', 'Sit.col'
				),
				//'limit' 		=> 100,
			)
		);
//ds($sits);

		$data = array();
		$lastRow = $lastCol = 0;
		foreach ($sits as $sit) {

			if ($sit['Sit']['row'] > $lastRow) {
				$lastRow = $sit['Sit']['row'];
			}
			if ($sit['Sit']['col'] > $lastCol) {
				$lastCol = $sit['Sit']['col'];
			}

			$data[$sit['Sit']['row']][$sit['Sit']['col']] = $sit;
		}

		return array(
			'sits' 		=> $data,
			'limits' 	=> array('lastRow' => $lastRow, 'lastCol' => $lastCol)
		);
	}

}