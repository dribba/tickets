<?php

$out[] = $session->flash('auth');
$out[] = $myForm->create('User', array('action' => 'login'));
$out[] = $myForm->input('username', array('label' => __('Documento', true)));
$out[] = $myForm->input('password', array('label' => __('Clave', true)));
$out[] = $myForm->end(__('Enter', true));

$out[] = $myHtml->link(
	__('Obtener clave', true),
	array('controller' => 'users', 'action' => 'forgot_password')
);
$out[] = $myHtml->link(
	__('Asociarse', true),
	array('controller' => 'users', 'action' => 'register')
);


echo $myHtml->out($out);