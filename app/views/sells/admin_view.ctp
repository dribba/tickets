<?php

	$this->set('title_for_layout', __('Venta', true));

	$links[] = $this->MyHtml->link(
		__('Editar', true),
		array(
			'controller' 	=> 'sells',
			'action' 		=> 'add',
			$data['Sell']['id']
		),
		array(
			'title' => __('Editar', true),
			'class'	=> 'button primary'
		)
	);

	$links[] = $this->MyHtml->link(
		__('Eliminar', true),
		array(
			'controller' 	=> 'sells',
			'action' 		=> 'delete',
			$data['Sell']['id']
		),
		array(
			'title' => __('Eliminar', true),
			'class'	=> 'button primary'
		),
		__('Eliminar venta?', true)
	);



	$fields[__('Fecha de compra', true)] = $data['Sell']['formated_date'];
	$fields[__('Usuario', true)] = $data['User']['full_name'];
	$fields[__('Carnet disponible', true)] = $data['Sell']['license_available'];
	$fields[__('Numero de carnet', true)] = $data['Sell']['license_number'];
	$fields[__('Envio a domicilio', true)] = $data['Sell']['send'];
	$fields[__('Direccion de envio', true)] = $data['Sell']['street'];
	$fields[__('Horario', true)] = $data['Sell']['horary'];
	$fields[__('Butaca', true)] = $data['EventsSit'][0]['sit_id'];
	$fields[__('Ubicacion', true)] = $data['Location']['name'];
	$fields[__('Sitio', true)] = $data['Location']['name'];

	

	echo $this->element('view',
		array(
			'data' 		=> $fields,
			'links' 	=> $links,
			'title' 	=> __('Detalle de la venta', true),
		)
	);