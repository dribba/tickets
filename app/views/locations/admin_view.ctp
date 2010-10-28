<?php

	$links[] = $this->MyHtml->link(
		__('Eliminar', true),
		array(
			'controller' 	=> 'locations',
			'action' 		=> 'delete',
			$data['Location']['id']
		),
		array(
			'title' => __('Eliminar', true),
			'class'	=> 'cancel'
		),
		__('Eliminar Locacion?', true)
	);

	$out[] = $this->element('actions',
		array('links' => $links)
	);

	$fields[__('Nombre', true)] = $data['Location']['name'];
	
	echo $this->element('view', array('data' => $fields));

	echo $this->MyHtml->tag('div', $out, array('id' => ''));