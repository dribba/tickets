<?php

	$links[] = $this->MyHtml->link(
		__('Eliminar', true),
		array(
			'controller' 	=> 'users',
			'action' 		=> 'delete',
			$data['User']['id']
		),
		array(
			'title' => __('Eliminar', true),
			'class'	=> 'cancel'
		),
		__('Eliminar socio?', true)
	);

	$out[] = $this->element('actions',
		array('links' => $links)
	);

	$fields[__('Usuario / Documento', true)] = $data['User']['username'];
	$fields[__('Nombre completo', true)] = $data['User']['full_name'];
	$fields[__('Sexo', true)] = $data['User']['sex'];
	$fields[__('Estado', true)] = $data['User']['state'];
	$fields[__('Email', true)] = $data['User']['email'];
	$fields[__('Celular', true)] = $data['User']['mobile_phone'];
	$fields[__('Fecha de alta', true)] = $data['User']['formated_created'];

	$out[] = $this->element('view', array('data' => $fields));

	echo $this->MyHtml->tag('div', $out, array('id' => ''));