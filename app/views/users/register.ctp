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
$steps[1][] = $myForm->input('email',
	array(
		'label' 	=> __('Email', true)
	)
);
/*
$after = $myForm->input('mobile_phone',
	array(
		'before'	=> $myHtml->tag('span', '15', array('style' => 'float:left;')),
		'label' 	=> false,
		'div' 		=> false
	)
);
$steps[1][] = $myForm->input('mobile_area',
	array(
		'between'	=> $myHtml->tag('span', '0', array('style' => 'float:left;')),
		'after'		=> $after,
		'label' 	=> __('Celular', true)
	)
);
*/
$steps[1][] = $myForm->input('mobile_area',
	array(
		//'between'	=> $myHtml->tag('span', '0', array('style' => 'float:left;')),
		'label' 	=> __('Celular (area)', true),
		'after' 	=> __('Sin el 0', true)
	)
);
$steps[1][] = $myForm->input('mobile_phone',
	array(
		//'between'	=> $myHtml->tag('span', '15', array('style' => 'float:left;')),
		'label' 	=> __('Celular (número)', true),
		'after' 	=> __('Sin el 15', true)
	)
);
$steps[1][] = $myForm->input('mobile_company',
	array(
		'type'		=> 'radio',
		'options'	=> array(
			'3' 		=> 'Claro',
			'1' 		=> 'Movistar',
			'4' 		=> 'Personal'
		),
		'label' 	=> __('Compañia', true)
	)
);
$load = $this->MyHtml->tag('span', $this->MyHtml->image('load.gif') . __(' Cargando...', true));
$steps[1][] = $this->MyHtml->tag('div', $load, array('id' => 'load'));
$steps[1][] = $this->MyHtml->scriptBlock(
	'$(document).ready(function($) {
		$("#save").click(
			function() {
				$("#load").show();
			}
		);
	});'
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
				'class'		=> 'validation_data'
			)
		);

	}
}



$out[] = $myForm->input('step',
	array(
		'type' 		=> 'hidden',
		'value' 	=> $step,
	)
);
foreach ($steps[$step] as $field) {
	$out[] = $field;
}

//$out[] = $myForm->end(__('Siguiente', true));
$out[] = $this->element("footer", array('controller' => 'users', 'text' => __('Siguiente', true)));

echo $myHtml->out($out);