<?php

	$this->set('title_for_layout', __('Ver sitio', true));

	$links[] = $this->MyHtml->link(
		__('Eliminar', true),
		array(
			'controller' 	=> 'sites',
			'action' 		=> 'delete',
			$data['Site']['id']
		),
		array(
			'title' => __('Eliminar', true),
			'class'	=> 'button primary'
		),
		__('Eliminar sitio?', true)
	);

	$links[] = $this->MyHtml->link(
		__('Editar', true),
		array(
			'controller' 	=> 'sites',
			'action' 		=> 'add',
			$data['Site']['id']
		),
		array(
			'title' => __('Editar', true),
			'class'	=> 'button primary'
		)
	);

	$links[] = $this->MyHtml->link(
		__('Agregar', true),
		array(
			'controller' 	=> 'sites',
			'action' 		=> 'add',
		),
		array(
			'title' => __('Agregar', true),
			'class'	=> 'button primary'
		)
	);


	$fields[__('Nombre', true)] = $data['Site']['name'];
	$fields[__('Plano', true)] = $this->element('plane', array('data' => $data));
/*
	if (!empty($data['Site']['plane'])) {
		$imageInfo = explode('|', $data['Site']['plane']);
		$fields[__('Plano', true)] = $this->MyHtml->image(
			'../files/' . $imageInfo[0]
		);
	}
*/

	echo $this->element('view',
		array(
			'data' 		=> $fields,
			'links' 	=> $links,
			'title' 	=> __('Detalle del sitio', true),
		)
	);