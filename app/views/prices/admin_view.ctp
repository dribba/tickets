<?php

	$this->set('title_for_layout', __('Ver Precio', true));

	$links[] = $this->MyHtml->link(
		__('Agregar', true),
		array(
			'controller' 	=> 'prices',
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
			'controller' 	=> 'prices',
			'action' 		=> 'add',
			$data['Price']['id']
		),
		array(
			'title' => __('Editar', true),
			'class'	=> 'button primary'
		)
	);

	$links[] = $this->MyHtml->link(
		__('Eliminar', true),
		array(
			'controller' 	=> 'prices',
			'action' 		=> 'delete',
			$data['Price']['id']
		),
		array(
			'title' => __('Eliminar', true),
			'class'	=> 'button primary'
		),
		__('Eliminar precio?', true)
	);


	$fields[__('Evento', true)] = $data['Event']['name'];
	$fields[__('Ubicación', true)] = $data['Location']['name'];
	$fields[__('Tipo', true)] = $data['Price']['type'];
	$fields[__('Precio', true)] = $data['Price']['price'];
	
	echo $this->element('view',
		array(
			'data' 		=> $fields,
			'links' 	=> $links,
			'title' 	=> __('Detalle de la ubicación', true),
		)
	);

