<?php
class Sell extends AppModel {

	var $virtualFields = array(
		'formated_date' => 'DATE_FORMAT(Sell.date, "%d-%m-%Y")'
	);

	var $belongsTo = array('User');

	var $hasMany = array('SellsDetail');

}