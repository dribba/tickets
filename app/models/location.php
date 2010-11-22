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

		if ($primary && empty($results[0][0]) && !empty($results[0]['Sit'])) {
			foreach ($results as $k => $v) {
				$results[$k]['Location']['sits'] = count($results[$k]['Sit']);
			}
		}

		return parent::afterFind($results, $primary);
	}


}