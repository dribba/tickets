<?php

$this->set('title_for_layout', __('Registro de usuario', true));

$out[] = $this->MyForm->create('User', array('action' => 'register', 'class' => 'mainForm clear', 'id' => 'formEditor'));
$out[] = $this->MyHtml->tag(
	'p',
	$this->MyHtml->tag('span', '* ', array('class' => 'star')) .
		__('Los campos marcados con asterisco son obligatorios', true),
	array('id' => 'asterisk')
);

$content[] = $this->MyHtml->tag('legend', __('Detalles del usuario', true));
/**
############################################################################
# STEP 1
############################################################################
*/
$steps[1][] = $this->MyForm->input('document',
	array(
		'label' 	=> __('Documento', true),
	)
);
$steps[1][] = $this->MyForm->input('sex',
	array(
		'options' 	=> array('M' => __('Masculino', true), 'F' => __('Femenino', true)),
		'label' 	=> __('Sex', true)
	)
);
$steps[1][] = $this->MyForm->input('email',
	array(
		'label' 	=> __('Email', true)
	)
);
/*
$after = $this->MyForm->input('mobile_phone',
	array(
		'before'	=> $myHtml->tag('span', '15', array('style' => 'float:left;')),
		'label' 	=> false,
		'div' 		=> false
	)
);
$steps[1][] = $this->MyForm->input('mobile_area',
	array(
		'between'	=> $myHtml->tag('span', '0', array('style' => 'float:left;')),
		'after'		=> $after,
		'label' 	=> __('Celular', true)
	)
);
*/
$steps[1][] = $this->MyForm->input('mobile_area',
	array(
		//'between'	=> $myHtml->tag('span', '0', array('style' => 'float:left;')),
		'label' 	=> __('Celular (area)', true),
		'after' 	=> __('Sin el 0', true)
	)
);
$steps[1][] = $this->MyForm->input('mobile_phone',
	array(
		//'between'	=> $myHtml->tag('span', '15', array('style' => 'float:left;')),
		'label' 	=> __('Celular (número)', true),
		'after' 	=> __('Sin el 15', true)
	)
);
$steps[1][] = $this->MyForm->input('mobile_company',
	array(
		'type'		=> 'radio',
		'options'	=> array(
			'3' 		=> 'Claro',
			'1' 		=> 'Movistar',
			'4' 		=> 'Personal',
		),
		'div'		=> 'No',
		'label' 	=> __('Compañia', true),
	)
);

$load = $this->MyHtml->tag('span', $this->MyHtml->image('load.gif') . __(' Cargando...', true));
$steps[1][] = $this->MyHtml->tag('div', $load, array('id' => 'load'));
$steps[1][] = $this->MyHtml->scriptBlock(
	'$(document).ready(function($) {
		$("#btnSubmit").click(
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