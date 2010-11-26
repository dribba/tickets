<?php
class Location extends AppModel {

	var $displayField = 'name';
	var $belongsTo = array('Site');
	var $hasMany = array('Sit', 'Price');

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


	function afterFind($results, $primary = false) {

		if ($primary && empty($results[0][0])) {
			foreach ($results as $k => $v) {
				if (!empty($v['Sit'])) {
					$results[$k]['Location']['sits'] = count($v['Sit']);
				} else {
					$results[$k]['Location']['sits'] = 0;
				}
			}
		}

		return parent::afterFind($results, $primary);
	}


	function locations($siteId) {

		$locationsId = Set::extract('/Location/id',
			 $this->findAllBySiteId($siteId)
		);
		$related = $this->Sit->find('all',
			array(
				'recursive'		=> -1,
				'fields'		=> array('Sit.location_id'),
				'conditions'	=> array('Sit.location_id' => $locationsId),
				'group'			=> array('Sit.location_id'),
			)
		);
		$relatedLocationId = Set::extract('/Sit/location_id', $related);

		$locations = array();
		$this->recursive = -1;
		foreach ($this->findAllBySiteId($siteId) as $location) {
			if (in_array($location['Location']['id'], $relatedLocationId)) {
				$locations[$location['Location']['id']] = $location['Location']['name'] . '|selected';
			} else {
				$locations[$location['Location']['id']] = $location['Location']['name'] . '|not_selected';
			}
		}

		return $locations;
	}
	

}