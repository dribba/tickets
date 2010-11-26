<?php
class Event extends AppModel {

	var $displayField = 'name';

	var $virtualFields = array(
		'formated_start' 		=> 'DATE_FORMAT(`Event`.`start`, "%Y-%m-%d %H:%i")',
		'formated_end' 			=> 'DATE_FORMAT(`Event`.`end`, "%Y-%m-%d %H:%i")',
		'formated_short_start' 	=> 'DATE_FORMAT(`Event`.`start`, "%Y-%m-%d")',
		'formated_short_end' 	=> 'DATE_FORMAT(`Event`.`end`, "%Y-%m-%d")',
		'uuid_image' 			=> 'SUBSTRING_INDEX(`Event`.`image`, "|", 1 )',
		'filename_image' 		=> 'SUBSTRING_INDEX(SUBSTRING_INDEX(`Event`.`image`, "|", 2 ), "|", -1)'
	);

	var $hasMany = array('EventsSit');
	var $belongsTo = array('Site');

	protected function _initialitation() {

		$this->validate = array(
			'name' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __('Ingrese el nombre del evento', true),
					'last' => true,
				),
			)
		);

    }

	function daily_stat($event_id, $date) {
		$sells = $this->EventsSit->find('all',
			array(
				//'contain' => array('SellsDetail.EventsSit'),
				'conditions' => array(
					'Sell.created LIKE'	=>  '%' . $date . '%',
					'Event.id'			=> $event_id
				)
			)
		);
		
		$sellData = Set::combine($sells, '{n}.Sell.id', '{n}.Sell.total');

		$total = 0;
		foreach ($sellData as $id => $sell) {
			$total += $sell;
		}

		$data['total_sells'] =  sizeof($sellData);
		$data['amount_sits_selled'] = sizeof($sells);
		$data['total'] = $total;
		
		return $data;
	}


	function findStats($eventId, $locationId = null) {

		$data = null;

		$conditions['EventsSit.event_id'] = $eventId;
		if (!empty($locationId)) {
			$conditions['Sit.location_id'] = $locationId;
		}

		$r = $this->EventsSit->find('all',
			array(
				'contain'		=> array('Sit'),
				'fields' 		=> array(
					'Sit.location_id',
					'COUNT(`EventsSit`.`id`) AS total_sits',
					'SUM(IF(`EventsSit`.`sell_id` > 0, 1, 0)) AS total_selled_sits',
					'COUNT(`EventsSit`.`id`) - SUM(IF(`EventsSit`.`sell_id` > 0, 1, 0)) AS total_free_sits'
				),
				'conditions'	=> $conditions,
				'group'			=> array('Sit.location_id'),
			)
		);

		if (!empty($r)) {
			$locationIds = Set::extract('/Sit/location_id', $r);
			$r = Set::combine($r, '{n}.Sit.location_id', '{n}.0');

			$data = $this->EventsSit->Sit->Location->find('all',
				array(
					'contain'		=> array('Site'),
					'conditions'	=> array('Location.id' => $locationIds)
				)
			);
			foreach ($data as $k => $v) {
				$data[$k]['Location'] += $r[$data[$k]['Location']['id']];
			}

			if (!empty($locationId) && !empty($data[0])) {
				return $data[0];
			} else {
				return $data;
			}
		}
	}

}