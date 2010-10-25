<?php

$out[] = $myForm->create('User', array('action' => 'login'));

$out[] = $myForm->input('full_name',
	array(
		'label' 	=> __('Nombre Completo', true),
		'disabled' 	=> true)
);
$out[] = $myForm->input('document',
	array(
		'label' 	=> __('Documento', true),
		'disabled' 	=> true)
);
$out[] = $myForm->input('sex',
	array(
		'options' 	=> array('F' => __('Femenino', true), 'M' => __('Masculino', true)),
		'label' 	=> __('Sex', true),
		'disabled' 	=> true
	)
);
$out[] = $myForm->input('birthday', array('label' => __('Fecha de Nacimiento', true)));
$out[] = $myForm->input('mobile_phone', array('label' => __('Celular', true)));

$out[] = $myForm->end(__('Enviar', true));

echo $myHtml->out($out);