<?php
class Price extends AppModel {

	var $belongsTo = array('Location', 'Event');

	protected function _initialitation() {

		$this->validate = array(
			'event_id' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __('Seleccione el evento', true),
					'last' => true,
				),
			),
			'location_id' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __('Seleccione la ubicación', true),
					'last' => true,
				),
			),
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