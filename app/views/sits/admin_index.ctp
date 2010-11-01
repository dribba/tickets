<?php

$out[] = $this->MyHtml->tag('h2',
	__('Butacas', true),
	array('id' => 'tasks_title')
);
$this->set('title_for_layout', __('Listado de butacas', true));

$links = null;
$links[] = $this->MyHtml->link(
	__('Agregar Butaca', true),
	array(
		'controller'	=> 'sits',
		'action'		=> 'add',
	),
	array('class' => 'cancel', 'title' => __('Agregar Butaca', true))
);
echo $this->element('actions', array('links' => $links));

/** The grid */
$header	= null;
$headers[] = __('Acciones', true);
$headers[] = __('Ubicación', true);
$headers[] = __('Fila', true);
$headers[] = __('Columna', true);
$headers[] = __('Ícono', true);


$head = $this->MyHtml->tag('thead', $this->MyHtml->tableHeaders($headers));

$body = array();
foreach ($data as $record) {
	$td = null;
	$actions = null;
	$actions[] = $this->MyHtml->image(
		'view.png',
		array(
			'class' => 'open_modal',
			'title' => __('Ver', true) . ' ' . $record['Sit']['id'],
			'url' => array(
				'controller' 	=> 'sits',
				'action' 		=> 'view',
				$record['Sit']['id']
			),
		)
	);
	$actions[] = $this->MyHtml->image(
		'edit.png',
		array(
			'class' => 'open_modal',
			'title' => __('Editar', true) . ' ' . $record['Sit']['id'],
			'url' => array(
				'controller' 	=> 'sits',
				'action' 		=> 'add',
				$record['Sit']['id']
			),
		)
	);

	$td[] = $this->MyHtml->tag('td', $actions);
	$td[] = $this->MyHtml->tag('td', $record['Location']['name']);
	$td[] = $this->MyHtml->tag('td', $record['Sit']['row']);
	$td[] = $this->MyHtml->tag('td', $record['Sit']['col']);
	$td[] = $this->MyHtml->tag('td', $record['Sit']['icon']);
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
