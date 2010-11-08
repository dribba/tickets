<?php


	$this->set('title_for_layout', __('Listado de ventas', true));

	
	$filters = array(
		'User.full_name'			=> array('label' => __('Nombre', true)),
		'Sell.created'				=> array(
			'type' => 'text', 'class' => 'datepicker-onlydate', 'label' => 'Fecha de compra'
		),
		'Sell.license_available'	=> array(
			'label' => __('Carnet disponible', true),
			'type' => 'select',
			'options' => array('Y' => __('Si', true), 'N' => __('No', true))
		),
		'Sell.license_number'		=> array('label' => __('Numero de carnet', true)),
		'Sell.send'	=> array(
			'label' => __('Envio a domicilio', true),
			'type' => 'select',
			'options' => array('Y' => __('Si', true), 'N' => __('No', true))
		)
	);
	
	/** The grid */
	$header	= null;
	$headers[] = __('Acciones', true);
	$headers[] = __('Fecha', true);
	$headers[] = __('Usuario', true);
	$headers[] = __('Carnet', true);
	$headers[] = __('Enviar', true);
	$headers[] = __('Total', true);

	$head = $this->MyHtml->tag('thead', $this->MyHtml->tableHeaders($headers));

	$body = array();
	foreach ($data as $record) {
		$td = null;
		$actions = null;
		$actions[] = $this->MyHtml->image(
			'view.png',
			array(
				'class' => 'open_modal',
				'title' => __('Ver', true) . ' ' . $record['Sell']['id'],
				'url' => array(
					'controller' 	=> 'sells',
					'action' 		=> 'view',
					$record['Sell']['id']
				),
			)
		);
		$actions[] = $this->MyHtml->image(
			'edit.png',
			array(
				'class' => 'open_modal',
				'title' => __('Editar', true) . ' ' . $record['Sell']['id'],
				'url' => array(
					'controller' 	=> 'sells',
					'action' 		=> 'add',
					$record['Sell']['id']
				),
			)
		);
		$actions[] = $this->MyHtml->image(
			'delete.png',
			array(
				'class' => 'open_modal',
				'title' => __('Eliminar', true) . ' ' . $record['Sell']['formated_date'],
				'url' => array(
					'controller' 	=> 'sells',
					'action' 		=> 'delete',
					$record['Sell']['id']
				),
			)
		);

		$td[] = $this->MyHtml->tag('td', $actions);
		$td[] = $this->MyHtml->tag('td', $record['Sell']['formated_date']);
		$td[] = $this->MyHtml->tag('td', $record['User']['full_name']);
		$td[] = $this->MyHtml->tag('td', $record['Sell']['license_available']);
		$td[] = $this->MyHtml->tag('td', $record['Sell']['send']);
		$td[] = $this->MyHtml->tag('td', $record['Sell']['total']);
		$body[] = $this->MyHtml->tag('tr', $td);

	}

	if ($body != null) {
		$body = implode("\n", $body);
	} else {
		$body = '';
	}

	$content = $this->MyHtml->tag('div',
		$this->MyHtml->tag('table', $head . $body),
		array('id' => 'grid')
	);


	echo $this->element('content',
		array(
			'content'			=> $content,
			'filters'			=> $filters,
		)
	);