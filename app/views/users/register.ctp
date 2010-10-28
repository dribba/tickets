<?php

$out[] = $myForm->create('User', array('action' => 'register'));

/**
############################################################################
# STEP 1
############################################################################
*/
$steps[1][] = $myForm->input('document',
	array(
		'label' 	=> __('Documento', true),
	)
);
$steps[1][] = $myForm->input('sex',
	array(
		'options' 	=> array('M' => __('Masculino', true), 'F' => __('Femenino', true)),
		'label' 	=> __('Sex', true)
	)
);
$after = $myForm->input('mobile_phone',
	array(
		'before'	=> '15',
		'label' 	=> false,
		'div' 		=> false
	)
);
$steps[1][] = $myForm->input('mobile_area',
	array(
		'before'	=> '0',
		'after'		=> $after,
		'label' 	=> __('Celular', true)
	)
);
$steps[1][] = $myForm->input('mobile_company',
	array(
		'type'		=> 'radio',
		'options'	=> array(
			'claro' 		=> 'Claro',
			'movistar' 		=> 'Movistar',
			'nextel' 		=> 'Nextel',
			'personal' 		=> 'Personal'
		),
		'label' 	=> __('Compañia', true)
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

		$steps[2][] = $myForm->input($d,
			array(
				'label' 	=> __($t[$d], true),
				'type'		=> 'radio',
				'options'	=> $v
			)
		);

	}
}



$out[] = $myForm->input('step',
	array(
		'type' 		=> 'hidden',
		'value' 	=> '1',
	)
);
foreach ($steps[$step] as $field) {
	$out[] = $field;
}

$out[] = $myForm->end(__('Siguiente', true));

echo $myHtml->out($out);