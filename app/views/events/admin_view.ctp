<?php

	$this->set('title_for_layout', __('Ver evento', true));

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
	$fields[__('Sitio', true)] = $data['Site']['name'];
	$fields[__('Estado', true)] = 
		(($data['Event']['state'] == 'active') ? __('Activo', true) : __('Cerrado', true));
	
	$fields[__('Fecha de inicio', true)] = $data['Event']['formated_start'];
	$fields[__('Fecha de cierre', true)] = $data['Event']['formated_end'];

	$fields[__('Imagen', true)] = $this->MyHtml->image($data['Event']['image']);

	$fields[__('Observaciones', true)] = $data['Event']['comments'];


	foreach ($data['Site']['Location'] as $location) {

		$statContent = null;
		$statContent[] = $this->MyHtml->tag('legend', $location['name']);

		$statContent[] = $this->MyHtml->image(
			array(
				'controller' 	=> 'events',
				'action' 		=> 'stat',
				$data['Event']['id'],
				$location['id']
			)
		);

		$extra[] = $this->MyHtml->tag('fieldset', $statContent, array('class' => 'clear mainForm'));
	}
	
	$side[] = $this->MyHtml->tag('dt', __('Total de ventas', true));
	$side[] = $this->MyHtml->tag('dd', $stat['total_sells']);
	$side[] = $this->MyHtml->tag('dt', __('Cant. Butacas', true));
	$side[] = $this->MyHtml->tag('dd', $stat['amount_sits_selled']);
	$side[] = $this->MyHtml->tag('dt', __('Recaudacion', true));
	$side[] = $this->MyHtml->tag('dd', $stat['total']);

	$extraSideContent['title'] = __('Estadística diaria', true);
	$extraSideContent['data'] = $this->MyHtml->tag('dl', $side, array('class' => 'clear'));

	echo $this->element('view', 
		array(
			'extraContent'		=> $extra,
			'data'				=> $fields,
			'links'				=> $links,
			'title'				=> __('Detalle del evento', true),
			'extraSideContent'	=> $extraSideContent
		)
	);