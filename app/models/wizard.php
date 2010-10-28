<?php

class Wizard extends AppModel {


	var $useTable = false;

	function unflatten($data) {
		$result = null;
		foreach ($data as $field => $value) { 
			$field = explode('.', $field);
			$result[$field[0]][$field[1]] = $value;
		}
		return $result;
	}


	function flatten($data, $separator = '.') {

		$result = array();
		$path = null;

		if (is_array($separator)) {
			extract($separator, EXTR_OVERWRITE);
		}

		if (!is_null($path)) {
			$path .= $separator;
		}

		foreach ($data as $key => $val) {
			if (is_array($val)) {

				if (isset($val[0])) { // 1:N relation
					foreach ($val[0] as $field => $foo) {

						// Standarize show
						if (preg_match('/[A-Za-z]__show/', $field)) {
							$field = 'show';
						}
						$result[$key . '.' . $field] = implode(
							',', Set::extract('/' . $key . '/' . $field, $data)
						);
					}
					break;
				} else {
					$result += (array)$this->flatten($val, array(
						'separator' => $separator,
						'path' 		=> $key
					));
				}
			} else {

				// Standarize show
				if (preg_match('/[A-Za-z]__show/', $key)) {
					$key = 'show';
				}
				$result[$path . $key] = $val;
			}
		}
		return $result;
	}	

}