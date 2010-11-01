<?php

	$this->set("title_for_layout", __("Ver usuario", true));

	$links[] = $this->MyHtml->link(
		__('Eliminar', true),
		array(
			'controller' 	=> 'users',
			'action' 		=> 'delete',
			$data['User']['id']
		),
		array(
			'title' => __('Eliminar', true),
			'class'	=> 'button primary'
		),
		__('Eliminar socio?', true)
	);

	$links[] = $this->MyHtml->link(
		__('Editar', true),
		array(
			'controller' 	=> 'users',
			'action' 		=> 'add',
			$data['User']['id']
		),
		array(
			'title' => __('Eliminar', true),
			'class'	=> 'button primary'
		)
	);

	$links[] = $this->MyHtml->link(
		__('Cambiar contrasena', true),
		array(
			'controller' 	=> 'users',
			'action' 		=> 'change_password',
			$data['User']['id']
		),
		array(
			'title' => __('Cambiar contrasena', true),
			'class'	=> 'button primary'
		)
	);

	

	$fields[__('Usuario / Documento', true)] = $data['User']['username'];
	$fields[__('Nombre completo', true)] = $data['User']['full_name'];
	$fields[__('Sexo', true)] = $data['User']['sex'];
	$fields[__('Estado', true)] = $data['User']['state'];
	$fields[__('Email', true)] = $data['User']['email'];
	$fields[__('Celular', true)] = $data['User']['mobile_phone'];
	$fields[__('Fecha de alta', true)] = $data['User']['formated_created'];

	$out[] = $this->element('view', array('data' => $fields));

	echo $this->element('view',
		array('data' => $fields, 'links' => $links, 'title' => __('Detalle del usuario', true))
	);