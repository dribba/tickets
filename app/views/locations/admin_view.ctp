<?php

	$this->set('title_for_layout', __('Ver Ubicación', true));

	$links[] = $this->MyHtml->link(
		__('Pantalla Completa', true),
		array(
			'controller' 	=> 'locations',
			'action' 		=> 'view',
			$data['Location']['id'],
			true
		),
		array(
			'target'=> '_BLANK',
			'title' => __('Pantalla Completa', true),
			'class'	=> 'button primary'
		)
	);

	$links[] = $this->MyHtml->link(
		__('Agregar', true),
		array(
			'controller' 	=> 'locations',
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
			'controller' 	=> 'locations',
			'action' 		=> 'add',
			$data['Location']['id']
		),
		array(
			'title' => __('Editar', true),
			'class'	=> 'button primary'
		)
	);

	$links[] = $this->MyHtml->link(
		__('Eliminar', true),
		array(
			'controller' 	=> 'locations',
			'action' 		=> 'delete',
			$data['Location']['id']
		),
		array(
			'title' => __('Eliminar', true),
			'class'	=> 'button primary'
		),
		__('Eliminar ubicación?', true)
	);


	$fields[__('Nombre', true)] = $data['Location']['name'];
	$fields[__('Butacas', true)] = $data['Location']['sits'];

	$lis = array();
	foreach ($data['Price'] as $price) {
		$view = $this->MyHtml->image(
			'view.png',
			array(
				'class' => 'action',
				'title' => __('Ver', true),
				'url' => array(
					'controller' 	=> 'prices',
					'action' 		=> 'view',
					$price['id']
				),
			)
		);
		$edit = $this->MyHtml->image(
			'edit.png',
			array(
				'class' => 'action',
				'title' => __('Editar', true),
				'url' => array(
					'controller' 	=> 'prices',
					'action' 		=> 'add',
					$price['id']
				),
			)
		);
		$delete = $this->MyHtml->image(
			'delete.png',
			array(
				'class' => 'action',
				'title' => __('Eliminar', true),
				'url' => array(
					'controller' 	=> 'prices',
					'action' 		=> 'delete',
					$price['id']
				),
				'confirm'	=> __('Esta seguro que desea eliminar el precio?', true)
			)
		);
		$lis[] = $this->MyHtml->tag('li',
			sprintf('%s: $ %s %s %s %s', $price['type'], $price['price'], $view, $edit, $delete)
		);
	}
	$fields[__('Precios', true)] = $this->MyHtml->tag('ul', $lis);
	$fields[__('Ubicaciones', true)] = $this->element('table', array('data' => $data));
	
	echo $this->element('view',
		array(
			'data' 		=> $fields,
			'links' 	=> $links,
			'title' 	=> __('Detalle de la ubicación', true),
		)
	);