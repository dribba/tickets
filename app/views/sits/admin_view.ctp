<?php

	$links[] = $this->MyHtml->link(
		__('Eliminar', true),
		array(
			'controller' 	=> 'sits',
			'action' 		=> 'delete',
			$data['Sit']['id']
		),
		array(
			'title' => __('Eliminar', true),
			'class'	=> 'cancel'
		),
		__('Eliminar butaca?', true)
	);

	$out[] = $this->element('actions',
		array('links' => $links)
	);

	$fields[__('Ubicación', true)] = $data['Location']['name'];
	$fields[__('Fila', true)] = $data['Sit']['row'];
	$fields[__('Columna', true)] = $data['Sit']['col'];
	$fields[__('Ícono', true)] = $data['Sit']['icon'];
	
	$out[] = $this->element('view', array('data' => $fields));

	echo $this->MyHtml->tag('div', $out, array('id' => ''));