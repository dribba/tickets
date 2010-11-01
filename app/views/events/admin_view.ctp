<?php

	$this->set("title_for_layout", __("Ver evento", true));

	$links[] = $this->MyHtml->link(
		__('Eliminar', true),
		array(
			'controller' 	=> 'events',
			'action' 		=> 'delete',
			$data['Event']['id']
		),
		array(
			'title' => __('Eliminar', true),
			'class'	=> 'button primary'
		),
		__('Eliminar Evento?', true)
	);
	$links[] = $this->MyHtml->link(
		__('Editar', true),
		array(
			'controller' 	=> 'events',
			'action' 		=> 'add',
			$data['Event']['id']
		),
		array(
			'title' => __('Editar', true),
			'class'	=> 'button primary'
		)
	);
	$links[] = $this->MyHtml->link(
		__('Agregar', true),
		array(
			'controller' 	=> 'events',
			'action' 		=> 'add',
		),
		array(
			'title' => __('Agregar', true),
			'class'	=> 'button primary'
		)
	);

	

	$fields[__('Nombre del evento', true)] = $data['Event']['name'];
	$fields[__('Comentarios', true)] = $data['Event']['comments'];
	$fields[__('Fecha de inicio', true)] = $data['Event']['formated_start'];
	$fields[__('Nombre de cierre', true)] = $data['Event']['formated_end'];


	echo $this->element('view', 
		array('data' => $fields, 'links' => $links, 'title' => __('Detalle del evento', true))
	);