<?php
class Sell extends AppModel {

	var $virtualFields = array(
		'formated_date' => 'DATE_FORMAT(Sell.date, "%Y-%m-%d")'
	);

	var $belongsTo = array('User', 'Event');

	var $hasMany = array('SellsDetail');

}