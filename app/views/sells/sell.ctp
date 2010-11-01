<?php

$this->set('title_for_layout', __('Compra de entrada', true));

$out[] = $this->MyForm->create('User', array('class' => 'mainForm clear', 'id' => 'formEditor'));
$out[] = $this->MyHtml->tag(
	'p',
	$this->MyHtml->tag('span', '* ', array('class' => 'star')) .
		__('Los campos marcados con asterisco son obligatorios', true),
	array('id' => 'asterisk')
);

$content[] = $this->MyHtml->tag('legend', __('Detalles de la compra', true));
/**
############################################################################
# STEP 1
############################################################################
*/
$steps[1][] = $this->MyForm->input('Sell.location',
	array(
		'label' 	=> __('Ubicacion', true),
	)
);
$steps[1][] = $this->MyForm->input('Sell.sit_id',
	array(
		'label' 	=> __('Butaca', true)
	)
);

/**
############################################################################
# STEP 2
############################################################################
*/
if (!empty($validation_data)) {

	$t['address'] = 'Domicilio';
	$t['phone'] = 'Telefono';
	$t['know'] = 'Persona conocida';
	$t['work'] = 'Empleo';

	foreach ($validation_data as $d => $v) {

		$steps[2][] = $this->MyForm->input($d,
			array(
				'label' 	=> __($t[$d], true),
				'type'		=> 'radio',
				'options'	=> $v,
				'div'		=> 'No',
				'class'		=> 'validation_data'
			)
		);

	}
}



$out[] = $this->MyForm->input('step',
	array(
		'type' 		=> 'hidden',
		'value' 	=> $step,
	)
);
foreach ($steps[$step] as $field) {
	$content[] = $field;
}



$out[] = $this->MyHtml->tag('fieldset', $content, array('class' => 'clear'));


//$out[] = $this->MyForm->end(__('Siguiente', true));
$out[] = $this->element("footer", array('link' => 'users/login', 'text' => __('Siguiente', true)));

$mainContent = $this->MyHtml->tag('div', $out);

echo $this->element('add', array('content' => $mainContent));