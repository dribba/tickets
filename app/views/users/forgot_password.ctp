<?php

$out[] = $myForm->create('User', array('action' => 'forgot_password'));

$out[] = $myForm->input('username', array('label' => __('Documento', true)));
$out[] = $myForm->input('mobile_phone', array('label' => __('Celular', true)));

$out[] = $myForm->end(__('Obtener clave', true));

echo $myHtml->out($out);