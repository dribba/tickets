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

}