<?php
class EventsSit extends AppModel {

	var $belongsTo = array('Event', 'Sit', 'Sell');


	function sync($eventId, $locationId) {

		$eventsSits = $this->find('all',
			array(
				'recursive'		=> -1,
				'conditions'	=> array(
					'EventsSit.event_id'	=> $eventId,
					'EventsSit.sell_id'		=> 0,
				),
			)
		);
		$eventsSitSitIds = Set::extract('/EventsSit/id', $eventsSits);


		$sits = $this->Sit->find('all',
			array(
				'recursive'		=> -1,
				'conditions'	=> array(
					'Sit.location_id'	=> $locationId,
					'Sit.state'			=> 'En venta',
				),
			)
		);
		$SitIds = Set::extract('/Sit/id', $sits);

		//$eventsSitSitIds = array(1, 2, 3);
		//$SitIds = array(1, 2, 4);

		$toAdd = array_diff($SitIds, $eventsSitSitIds);
		$toDelete = array_diff($eventsSitSitIds, $SitIds);

		if (!empty($toAdd)) {
			foreach ($toAdd as $sitId) {
				$save[] = array('sit_id' => $sitId, 'event_id' => $eventId);
			}
			$this->saveAll($save, array('atomic' => false));
		}


		if (!empty($toDelete)) {
			$this->unbindModel(array('belongsTo' => array('Event', 'Sit', 'Sell')));
			$this->deleteAll(array('EventsSit.event_id' => $eventId, 'EventsSit.sit_id' => $toDelete));
		}

	}

}