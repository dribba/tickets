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
				'belongsTo'	=> array('Location'),
			)
		);

		$options = array(
			'fields'		=> array('Sit.*', 'EventsSit.*'),
			'joins' 		=> array(
				array(
					'table' => '`events_sits`',
					'alias' => 'EventsSit',
					'type' 	=> 'LEFT',
					'conditions' => array(
						'EventsSit.sit_id = Sit.id',
						'EventsSit.event_id = ' . $eventId,
					)
				)
			),
			'order'			=> array(
				'Sit.row', 'Sit.col'
			),
		);

		if (!empty($locationId)) {
			$options['conditions'] = array('Sit.location_id' => $locationId);
		}

		$r = array();

		foreach ($this->find('all', $options) as $v) {
			if ($v['EventsSit']['state'] == 'Vendido') {
				$v['Sit']['state'] = 'Vendido';
			}
			$r[] = $v['Sit'];
		}

		return array('Sit' => $r);
	}


	function formatToPaint($data) {

		$sits = array();
		$lastRow = $lastCol = 0;

		foreach ($data['Sit'] as $sit) {

			if ($sit['row'] > $lastRow) {
				$lastRow = $sit['row'];
			}
			if ($sit['col'] > $lastCol) {
				$lastCol = $sit['col'];
			}

			$sits[$sit['row']][$sit['col']]['Sit'] = $sit;
		}

		return array(
			'sits' 		=> $sits,
			'limits' 	=> array('lastRow' => $lastRow, 'lastCol' => $lastCol)
		);

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
			)
		);


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