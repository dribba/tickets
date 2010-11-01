<?php


	$this->set('title_for_layout', __('Listado de sitios', true));

	$menu[] = $this->MyHtml->link(
		__('Agregar Sitio', true),
		array(
			'controller'	=> 'sites',
			'action'		=> 'add',
		),
		array('class' => 'button primary', 'title' => __('Agregar Sitio', true))
	);
	

	/** The grid */
	$header	= null;
	$headers[] = __('Acciones', true);
	$headers[] = __('Nombre', true);

	$head = $this->MyHtml->tag('thead', $this->MyHtml->tableHeaders($headers));

	$body = array();
	foreach ($data as $record) {
		$td = null;
		$actions = null;
		$actions[] = $this->MyHtml->image(
			'view.png',
			array(
				'class' => 'open_modal',
				'title' => __('Ver', true) . ' ' . $record['Site']['id'],
				'url' => array(
					'controller' 	=> 'sites',
					'action' 		=> 'view',
					$record['Site']['id']
				),
			)
		);
		$actions[] = $this->MyHtml->image(
			'edit.png',
			array(
				'class' => 'open_modal',
				'title' => __('Editar', true) . ' ' . $record['Site']['id'],
				'url' => array(
					'controller' 	=> 'sites',
					'action' 		=> 'add',
					$record['Site']['id']
				),
			)
		);

		$td[] = $this->MyHtml->tag('td', $actions);
		$td[] = $this->MyHtml->tag('td', $record['Site']['name']);
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

	echo $this->element('content', array('menu' => $menu, 'content' => $content));
