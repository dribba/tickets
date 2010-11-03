<?php

	$this->set("title_for_layout", __("Ver evento", true));

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

	

	

	$fields[__('Nombre del evento', true)] = $data['Event']['name'];
	$fields[__('Observaciones', true)] = $data['Event']['comments'];
	$fields[__('Fecha de inicio', true)] = $data['Event']['formated_start'];
	$fields[__('Nombre de cierre', true)] = $data['Event']['formated_end'];

	$fields[__('Sitio', true)] = $data['stats'][0]['Site']['name'];
	
	foreach ($data['stats'] as $stat) {
		$statContent = null;
		$statContent[] = $this->MyHtml->tag('legend', $stat['Location']['name']);

		$percentSelled = ($stat['Location']['total_selled_sits'] * 100) / $stat['Location']['total_sits'];
		$percentFree = ($stat['Location']['total_free_sits'] * 100) / $stat['Location']['total_sits'];
		$statContent[] = $this->MyHtml->tag('img', '', array('src' => Router::url('stat')));
		$extra[] = $this->MyHtml->tag('fieldset', $statContent, array('class' => 'clear mainForm'));
	}

	echo $this->element('view', 
		array('extraContent' => $extra, 'data' => $fields, 'links' => $links, 'title' => __('Detalle del evento', true))
	);
	