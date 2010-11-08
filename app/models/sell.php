<?php
class Sell extends AppModel {

	var $virtualFields = array(
		'formated_date' => 'DATE_FORMAT(Sell.created, "%d-%m-%Y %H:%i")'
	);

	var $belongsTo = array('User');

	var $hasMany = array('SellsDetail');

}