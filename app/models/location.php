<?php
class Location extends AppModel {
	var $name = 'Location';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array('Site');
	var $hasMany = array(
		'Sit' => array(
			'className' => 'Sit',
			'foreignKey' => 'location_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	protected function _initialitation() {

		$this->validate = array(
			'name' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __("Ingrese el nombre del evento", true),
					'last' => true, // Stop validation after this rule
				),
			)
		);

    }

}