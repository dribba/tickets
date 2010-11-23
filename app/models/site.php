<?php
class Site extends AppModel {

	var $hasMany = array('Location');

	var $virtualFields = array(
		'uuid_plane' 		=> 'SUBSTRING_INDEX(`Site`.`plane`, "|", 1 )',
		'filename_plane' 	=> 'SUBSTRING_INDEX(SUBSTRING_INDEX(`Site`.`plane`, "|", 2 ), "|", -1)'
	);


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

		if ($primary && empty($results[0][0]) && !empty($results[0]['Location'])) {
			foreach ($results as $k => $v) {
				$results[$k]['Site']['locations'] = count($results[$k]['Location']);
			}
		}

		return parent::afterFind($results, $primary);
	}


}