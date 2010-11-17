<?php
	
	$this->set('title_for_layout', __('Listado de eventos', true));

	$menu[] = $this->MyHtml->link(
		__('Agregar Evento', true),
		array('admin' => true, 'controller' => 'events', 'action' => 'add'),
		array('class' => 'button primary')
	);

	/** The grid */
	$header	= null;
	$header[] = __('Acciones', true);
	$header[] = __('Nombre', true);
	$header[] = __('Sitio', true);
	$header[] = __('Fecha de Inicio', true);
	$header[] = __('Fecha de Fin', true);

	$head = $this->MyHtml->tag('thead', $this->MyHtml->tableHeaders($header));

	$body = array();
	foreach ($data as $record) {
		$td = null;
		$actions = null;
		$actions[] = $this->MyHtml->image(
			'view.png',
			array(
				'class' => 'open_modal',
				'title' => __('Ver', true) . ' ' . $record['Event']['name'],
				'url' => array(
					'controller' 	=> 'events',
					'action' 		=> 'view',
					$record['Event']['id']
				),
			)
		);
		$actions[] = $this->MyHtml->image(
			'edit.png',
			array(
				'class' => 'open_modal',
				'title' => __('Editar', true) . ' ' . $record['Event']['name'],
				'url' => array(
					'controller' 	=> 'events',
					'action' 		=> 'add',
					$record['Event']['id']
				),
			)
		);
		$actions[] = $this->MyHtml->image(
			'delete.png',
			array(
				'class' => 'open_modal',
				'title' => __('Eliminar', true) . ' ' . $record['Event']['name'],
				'url' => array(
					'controller' 	=> 'events',
					'action' 		=> 'delete',
					$record['Event']['id']
				),
				'confirm'	=> __('Esta seguro que desea eliminar el evento?', true),
			)
		);

		$td[] = $this->MyHtml->tag('td', $actions);
		$td[] = $this->MyHtml->tag('td', $record['Event']['name']);
		$td[] = $this->MyHtml->tag('td', $record['Site']['name']);
		$td[] = $this->MyHtml->tag('td', $record['Event']['formated_start']);
		$td[] = $this->MyHtml->tag('td', $record['Event']['formated_end']);
		$body[] = $this->MyHtml->tag('tr', $td);

	}

	if ($body != null) {
		$body = implode("\n", $body);
	} else {
		$body = '';
	}

	$content = $this->MyHtml->tag('div',
		$this->MyHtml->tag('table', $head . $body),
		array('id' => 'tableItems')
	);

	$filters = array(
		'Event.name'	=> array('label' => __('Nombre', true)),
		'Event.site_id' => array('label' => __('Sitio', true)),
		'Event.start'	=> array('label' => __('Fecha de inicio', true), 'type' => 'text', 'class' => 'datepicker-onlydate'),
		'Event.end'		=> array('label' => __('Fecha de fin', true), 'type' => 'text', 'class' => 'datepicker-onlydate'),
	);
	echo $this->element('content', array('menu' => $menu, 'content' => $content, 'filters' => $filters));
          