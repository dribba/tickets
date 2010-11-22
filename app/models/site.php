<?php
class Site extends AppModel {
	var $name = 'Site';
	

	var $hasMany = array('Location');

	protected function _initialitation() {

		$this->validate = array(
			'name' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __('Ingrese el nombre del sitio', true),
					'last' => true, // Stop validation after this rule
				),
			)
		);

    }


	function afterFind($results, $primary = false) {

		if ($primary && empty($results[0][0])) {
			foreach ($results as $k => $v) {
				$results[$k]['Site']['locations'] = count($results[$k]['Location']);
			}
		}

		return parent::afterFind($results, $primary);
	}


}