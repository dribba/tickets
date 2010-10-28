<?php

$out[] = $this->MyHtml->tag('h2',
	__('Eventos', true),
	array('id' => 'tasks_title')
);
$this->set("title_for_layout", __("Listado de eventos", true));

$links = null;
$links[] = $this->MyHtml->link(
	__('Agregar Evento', true),
	array(
		'controller'	=> 'events',
		'action'		=> 'add',
	),
	array('class' => 'cancel', 'title' => __('Agregar Evento', true))
);
echo $this->element('actions', array('links' => $links));

/** The grid */
$header	= null;
$header[] = __('Acciones', true);
$header[] = __('Nombre', true);
$header[] = __('Comentario', true);
$header[] = __('Fecha de inicio', true);
$header[] = __('Fecha de cierre', true);

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
	$td[] = $this->MyHtml->tag('td', $record['Event']['comments']);
	$td[] = $this->MyHtml->tag('td', $record['Event']['formated_start']);
	$td[] = $this->MyHtml->tag('td', $record['Event']['formated_end']);

	$body[] = $this->MyHtml->tag('tr', $td);

}

if ($body != null) {
    $body = implode("\n", $body);
} else {
    $body = '';
}

$out[] = $this->MyHtml->tag('div',
	$this->MyHtml->tag('table', $head . $body),
	array('id' => 'grid')
);

$out[] = $this->MyPaginator->getNavigator(false);

echo implode("\n", $out);
echo $this->Js->writeBuffer();
