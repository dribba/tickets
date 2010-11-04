<?php
class Price extends AppModel {

	var $belongsTo = array('Location', 'Event');

	protected function _initialitation() {

		$this->validate = array(
			'type' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __('Ingrese el tipo de precio', true),
					'last' => true,
				),
			),
			'price' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __('Ingrese el valor', true),
					'last' => true,
				),
			)
		);

    }

}