<?php

	$links[] = $this->MyHtml->link(
		__('Eliminar', true),
		array(
			'controller' 	=> 'events',
			'action' 		=> 'delete',
			$data['Event']['id']
		),
		array(
			'title' => __('Eliminar', true),
			'class'	=> 'cancel'
		),
		__('Eliminar Evento?', true)
	);

	$out[] = $this->element('actions',
		array('links' => $links)
	);

	$fields[__('Nombre del evento', true)] = $data['Event']['name'];
	$fields[__('Comentarios', true)] = $data['Event']['comments'];
	$fields[__('Fecha de inicio', true)] = $data['Event']['formated_start'];
	$fields[__('Nombre de cierre', true)] = $data['Event']['formated_end'];

	echo $this->element('view', array('data' => $fields));

	echo $this->MyHtml->tag('div', $out, array('id' => ''));