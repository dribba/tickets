<?php
class Site extends AppModel {
	var $name = 'Site';
	

	protected function _initialitation() {

		$this->validate = array(
			'name' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __("Ingrese el nombre del sitio", true),
					'last' => true, // Stop validation after this rule
				),
			)
		);

    }


}