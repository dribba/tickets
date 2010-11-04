<?php

	$this->set('title_for_layout', __('Ver Ubicación', true));

	$links[] = $this->MyHtml->link(
		__('Pantalla Completa', true),
		array(
			'controller' 	=> 'locations',
			'action' 		=> 'full_screen',
			$data['Location']['id']
		),
		array(
			'target'=> '_BLANK',
			'title' => __('Pantalla Completa', true),
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
		__('Eliminar ubicación?', true)
	);


	$fields[__('Nombre', true)] = $data['Location']['name'];
d($data);
	$fields[__('Precios', true)] = $data['Location']['name'];
	$fields[__('Ubicaciones', true)] = $this->element('table', array('data' => $data));
	
	echo $this->element('view',
		array(
			'data' 		=> $fields,
			'links' 	=> $links,
			'title' 	=> __('Detalle de la ubicación', true),
		)
	);

