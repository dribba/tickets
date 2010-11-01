<?php

App::import('helper', 'form');

class MyFormHelper extends FormHelper {

	var $helpers = array('MyHtml', 'Html');
	
	function dateControl() {
	
		//static
		/** TODO: get ranges out of prev version */
		
		$out[] = $this->input('date', array('type' => 'date'));
		$out[] = $this->input('start', array('type' => 'time'));
		$out[] = $this->input('end', array('type' => 'time'));
		$out[] = $this->input('message', array('type' => 'text'));
		
		return $this->MyHtml->tag('div', $out);
		
	}
	
	
	
/**
 * Generates a form input element complete with label and wrapper div
 *
 * ### Options
 *
 * See each field type method for more information. Any options that are part of
 * $attributes or $options for the different **type** methods can be included in `$options` for input().
 *
 * - `type` - Force the type of widget you want. e.g. `type => 'select'`
 * - `label` - Either a string label, or an array of options for the label. See FormHelper::label()
 * - `div` - Either `false` to disable the div, or an array of options for the div.
 *    See HtmlHelper::div() for more options.
 * - `options` - for widgets that take options e.g. radio, select
 * - `error` - control the error message that is produced
 * - `empty` - String or boolean to enable empty select box options.
 * - `before` - Content to place before the label + input.
 * - `after` - Content to place after the label + input.
 * - `between` - Content to place between the label + input.
 * - `format` - format template for element order. Any element that is not in the array, will not be in the output.
 *     Default input format order: array('before', 'label', 'between', 'input', 'after', 'error')
 *     Default checkbox format order: array('before', 'input', 'between', 'label', 'after', 'error')
 *     Hidden input will not be formatted
 *
 * @param string $fieldName This should be "Modelname.fieldname"
 * @param array $options Each type of input takes different options.
 * @return string Completed form widget.
 * @access public
 * @link http://book.cakephp.org/view/1390/Automagic-Form-Elements
 */
	function input($fieldName, $options = array()) {


		if (!empty($options['class'])) {
			
			if ($options['class'] == 'validation_data') {
				foreach ($options['options'] as $k => $value) {
					$options['options'][$value] = $value;
					unset($options['options'][$k]);
				}
			}
		}

		$options['div'] = array('class' => 'field clear');
		$options['error'] = array('class' => 'error clear', 'wrap' => 'p');

		if (!empty($options['help'])) {
//			 $options['after'] = $this->MyHtml->image(
//				'ico/icohint.png',
//				array(
//					'url'	=> array('a')
//				)
//			) . $this->MyHtml->tag('span', $options['help']);

			$options['after'] = $this->MyHtml->tag(
				'a',
				$this->MyHtml->image('ico/icohint.png')	. $this->MyHtml->tag('span', $options['help']),
				array('class' => 'hint')
			);
		}


		return parent::input($fieldName, $options);
		
	}


	function label($fieldName = null, $text = null, $options = array()) {

		
		return parent::label($fieldName, $text, $options);
	}

	

}