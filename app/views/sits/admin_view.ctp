<?php

	$this->set("title_for_layout", __("Ver butaca", true));

	$links[] = $this->MyHtml->link(
		__('Agregar', true),
		array(
			'controller' 	=> 'sits',
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
			'controller' 	=> 'sits',
			'action' 		=> 'add',
			$data['Sit']['id']
		),
		array(
			'title' => __('Editar', true),
			'class'	=> 'button primary'
		)
	);

	$links[] = $this->MyHtml->link(
		__('Eliminar', true),
		array(
			'controller' 	=> 'sits',
			'action' 		=> 'delete',
			$data['Sit']['id']
		),
		array(
			'title' => __('Eliminar', true),
			'class'	=> 'button primary'
		),
		__('Eliminar butaca?', true)
	);

	
	$fields[__('Codigo', true)] = $data['Sit']['code'];
	$fields[__('Ubicación', true)] = $data['Location']['name'];
	$fields[__('Fila', true)] = $data['Sit']['row'];
	$fields[__('Columna', true)] = $data['Sit']['col'];
	$fields[__('Estado', true)] = $data['Sit']['state'];
	$fields[__('Ícono', true)] = $data['Sit']['icon'];
	
	echo $this->element('view',
		array('data' => $fields, 'links' => $links, 'title' => __('Detalle de la butaca', true))
	);