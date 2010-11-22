<?php

$this->set('title_for_layout', __('Listado de Precios', true));

$menu[] = $this->MyHtml->link(
	__('Agregar Precio', true),
	array(
		'controller'	=> 'prices',
		'action'		=> 'add',
	),
	array('class' => 'button primary', 'title' => __('Agregar Precio', true))
);

$filters = array(
	'Price.type'		=> array('label' => __('Tipo', true)),
	'Price.location_id'	=> array('label' => __('Ubicación', true)),
	'Price.event_id'	=> array('label' => __('Evento', true))
);


/** The grid */
$header	= null;
$header[] = __('Acciones', true);
$header[] = __('Evento', true);
$header[] = __('Ubicación', true);
$header[] = __('Tipo', true);
$header[] = __('Precio', true);

$head = $this->MyHtml->tag('thead', $this->MyHtml->tableHeaders($header));

	$body = array();
	foreach ($data as $record) {
		$td = null;
		$actions = null;
		$actions[] = $this->MyHtml->image(
			'view.png',
			array(
				'class' => 'open_modal',
				'title' => __('Ver', true),
				'url' => array(
					'controller' 	=> 'prices',
					'action' 		=> 'view',
					$record['Price']['id']
				),
			)
		);
		$actions[] = $this->MyHtml->image(
			'edit.png',
			array(
				'class' => 'open_modal',
				'title' => __('Editar', true),
				'url' => array(
					'controller' 	=> 'prices',
					'action' 		=> 'add',
					$record['Price']['id']
				),
			)
		);
		$actions[] = $this->MyHtml->image(
			'delete.png',
			array(
				'class' => 'open_modal',
				'title' => __('Eliminar', true),
				'url' => array(
					'controller' 	=> 'prices',
					'action' 		=> 'delete',
					$record['Price']['id']
				),
				'confirm'	=> __('Esta seguro que desea eliminar el precio?', true),
			)
		);


		$td[] = $this->MyHtml->tag('td', $actions);
		$td[] = $this->MyHtml->tag('td', $record['Event']['name']);
		$td[] = $this->MyHtml->tag('td', $record['Location']['name']);
		$td[] = $this->MyHtml->tag('td', $record['Price']['type']);
		$td[] = $this->MyHtml->tag('td', '$ ' . $record['Price']['price']);

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
echo $this->element('content', array('menu' => $menu, 'content' => $content, 'filters' => $filters));