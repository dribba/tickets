<?php

	$this->set("title_for_layout", __("Ver ubicacion", true));
	$links[] = $this->MyHtml->link(
		__('Eliminar', true),
		array(
			'controller' 	=> 'locations',
			'action' 		=> 'delete',
			$data['Location']['id']
		),
		array(
			'title' => __('Eliminar', true),
			'class'	=> 'button primary'
		),
		__('Eliminar Locacion?', true)
	);

	$links[] = $this->MyHtml->link(
		__('Editar', true),
		array(
			'controller' 	=> 'locations',
			'action' 		=> 'add',
			$data['Location']['id']
		),
		array(
			'title' => __('Editar', true),
			'class'	=> 'button primary'
		)
	);

	$links[] = $this->MyHtml->link(
		__('Agregar', true),
		array(
			'controller' 	=> 'locations',
			'action' 		=> 'add',
		),
		array(
			'title' => __('Agregar', true),
			'class'	=> 'button primary'
		)
	);

	

	$fields[__('Nombre', true)] = $data['Location']['name'];
	
	echo $this->element('view',
		array('data' => $fields, 'links' => $links, 'title' => __('Detalle de la ubicacion', true))
	);