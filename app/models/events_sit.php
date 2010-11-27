<?php
class EventsSit extends AppModel {

	var $belongsTo = array('Event', 'Sit', 'Sell');


	function sync($eventId, $locationId) {

		$eventsSits = $this->find('all',
			array(
				'contain'		=> array('Sit'),
				'conditions'	=> array(
					'EventsSit.event_id'	=> $eventId,
					'EventsSit.sell_id'		=> 0,
					'Sit.location_id'		=> $locationId
				)
			)
		);
		$eventsSitSitIds = Set::extract('/EventsSit/sit_id', $eventsSits);


		$sits = $this->Sit->find('all',
			array(
				'recursive'		=> -1,
				'conditions'	=> array(
					'Sit.location_id'	=> $locationId,
					'Sit.state'			=> 'En venta',
				)
			)
		);
		$sitIds = Set::extract('/Sit/id', $sits);


		$toAdd = array_diff($sitIds, $eventsSitSitIds);
		$toDelete = array_diff($eventsSitSitIds, $sitIds);


		if (!empty($toAdd)) {
			$save = array();
			foreach ($toAdd as $sitId) {
				$save[] = array('sit_id' => $sitId, 'event_id' => $eventId, 'state' => 'En venta');
			}
			$this->saveAll($save, array('atomic' => false));
		}

		if (!empty($toDelete)) {
			$this->unbindModel(array('belongsTo' => array('Event', 'Sit', 'Sell')));
			$this->deleteAll(array('EventsSit.event_id' => $eventId, 'EventsSit.sit_id' => $toDelete));
		}

	}

}