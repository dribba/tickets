<?php

	$this->set('title_for_layout', __('Ver sitio', true));

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

	$lis = array();
	foreach ($data['Location'] as $location) {
		$view = $this->MyHtml->image(
			'view.png',
			array(
				'class' => 'action',
				'title' => __('Ver', true),
				'url' => array(
					'controller' 	=> 'locations',
					'action' 		=> 'view',
					$location['id']
				),
			)
		);
		$edit = $this->MyHtml->image(
			'edit.png',
			array(
				'class' => 'action',
				'title' => __('Editar', true),
				'url' => array(
					'controller' 	=> 'locations',
					'action' 		=> 'add',
					$location['id']
				),
			)
		);
		$delete = $this->MyHtml->image(
			'delete.png',
			array(
				'class' => 'action',
				'title' => __('Eliminar', true),
				'url' => array(
					'controller' 	=> 'locations',
					'action' 		=> 'delete',
					$location['id']
				),
				'confirm'	=> __('Esta seguro que desea eliminar la ubicación?', true),
			)
		);
		$lis[] = $this->MyHtml->tag('li',
			sprintf('%s %s %s %s', $location['name'], $view, $edit, $delete)
		);

	}

	$fields[__('Nombre', true)] = $data['Site']['name'];
	$fields[__('Ubicaciones', true)] = $this->MyHtml->tag('ul', $lis);
	$fields[__('Esquema', true)] = $this->element('plane', array('data' => $data));

	echo $this->element('view',
		array(
			'data' 		=> $fields,
			'links' 	=> $links,
			'title' 	=> __('Detalle del sitio', true),
		)
	);