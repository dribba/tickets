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
	foreach ($data['Price'] as $price) {
		$edit = $this->MyHtml->image(
			'edit.png',
			array(
				'class' => 'open_modal',
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
				'class' => 'open_modal',
				'title' => __('Eliminar', true),
				'url' => array(
					'controller' 	=> 'prices',
					'action' 		=> 'delete',
					$price['id']
				),
			)
		);
		$prices[] = $this->MyHtml->tag('div',
			sprintf('%s: %s %s %s', $price['type'], $price['price'], $edit, $delete)
		);
	}
	$fields[__('Precios', true)] = $this->MyHtml->tag('div', $prices);
	$fields[__('Ubicaciones', true)] = $this->element('table', array('data' => $data));
	
	echo $this->element('view',
		array(
			'data' 		=> $fields,
			'links' 	=> $links,
			'title' 	=> __('Detalle de la ubicación', true),
		)
	);

