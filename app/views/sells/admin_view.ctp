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


	$fields[__('Fecha de compra', true)] = $data['Sell']['formated_date'];
	$fields[__('Usuario', true)] = $data['User']['full_name'];
	$fields[__('Carnet disponible', true)] = $data['Sell']['license_available'];
	if ($data['Sell']['license_available'] == 'Y') {
		$fields[__('Numero de carnet', true)] = $data['Sell']['license_number'];
	}
	if ($data['Sell']['send'] == 'Y') {
		$fields[__('Envio a domicilio', true)] = $data['Sell']['send'];
		$fields[__('Direccion de envio', true)] = $data['Sell']['street'];
		$fields[__('Horario', true)] = $data['Sell']['horary'];
	}
	$fields[__('Evento', true)] = $data['SellsDetail'][0]['EventsSit']['Event']['name'];
	//$fields[__('Sitio', true)] = $data['Location']['name'];
	$fields[__('Ubicacion', true)] = $data['SellsDetail'][0]['EventsSit']['Sit']['Location']['name'];

	//$sits = Set::combine($data['SellsDetail'], '{n}.EventsSit.Sit.id', '{n}.EventsSit.Sit.code');
	$fields[__('Butacas', true)] = count($data['SellsDetail']);

	$fields[__('Precio unitario', true)] = $data['SellsDetail'][0]['price'];
	$fields[__('Total', true)] = $data['Sell']['total'];
	

	echo $this->element('view',
		array(
			'data' 		=> $fields,
			'links' 	=> $links,
			'title' 	=> __('Detalle de la venta', true),
		)
	);