<?php

	$this->set('title_for_layout', $data['Location']['name'] . ' - ' . __('Compra de entrada', true));

	$links[] = $this->MyHtml->link(
		__('Pantalla Completa', true),
		array(
			'admin'			=> false,
			'controller' 	=> 'locations',
			'action' 		=> 'view',
			$data['Location']['id'],
			true
		),
		array(
			'title' => __('Pantalla Completa', true),
			'class'	=> 'button primary'
		)
	);
	
	$fields[] = $this->element('table', array('data' => $data, 'wide' => 'Yes'));
	
	echo $this->element('view_wide',
		array(
			'data' 		=> $fields,
			'title' 	=> __('Seleccione una butaca', true),
			'links'		=> $links
		)
	);

