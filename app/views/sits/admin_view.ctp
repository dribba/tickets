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

	$fields[__('Codigo', true)] = $data['Sit']['code'];
	$fields[__('Locacion', true)] = $data['Location']['name'];
	$fields[__('Evento', true)] = $data['Event']['name'];

	$out[] = $this->element('view', array('data' => $fields));

	echo $this->MyHtml->tag('div', $out, array('id' => ''));