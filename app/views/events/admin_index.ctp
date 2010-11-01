<?php
	
	$this->set("title_for_layout", __("Listado de eventos", true));

	$menu[] = $this->MyHtml->link(
		__('Agregar Evento', true),
		array('admin' => true, 'controller' => 'events', 'action' => 'add'),
		array('class' => 'button primary')
	);

	/** The grid */
	$header	= null;
	$header[] = __('Acciones', true);
	$header[] = __('Nombre', true);
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

		$td[] = $this->MyHtml->tag('td', $actions);
		$td[] = $this->MyHtml->tag('td', $record['Event']['name']);
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

	echo $this->element('content', array('menu' => $menu, 'content' => $content));
          