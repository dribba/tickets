
<?php

$this->set('title_for_layout', __('Listado de ubicaciones', true));

$menu[] = $this->MyHtml->link(
	__('Agregar Ubicación', true),
	array(
		'controller'	=> 'locations',
		'action'		=> 'add',
	),
	array('class' => 'button primary', 'title' => __('Agregar Ubicación', true))
);

$filters = array('Location.name');


/** The grid */
$header	= null;
$header[] = __('Acciones', true);
$header[] = __('Nombre', true);

$head = $this->MyHtml->tag('thead', $this->MyHtml->tableHeaders($header));

$body = array();
foreach ($data as $record) {
	$td = null;
	$actions = null;
	$actions[] = $this->MyHtml->image(
		'view.png',
		array(
			'class' => 'open_modal',
			'title' => __('Ver', true) . ' ' . $record['Location']['name'],
			'url' => array(
				'controller' 	=> 'locations',
				'action' 		=> 'view',
				$record['Location']['id']
			),
		)
	);
	$actions[] = $this->MyHtml->image(
		'edit.png',
		array(
			'class' => 'open_modal',
			'title' => __('Editar', true) . ' ' . $record['Location']['name'],
			'url' => array(
				'controller' 	=> 'locations',
				'action' 		=> 'add',
				$record['Location']['id']
			),
		)
	);

	$td[] = $this->MyHtml->tag('td', $actions);
	$td[] = $this->MyHtml->tag('td', $record['Location']['name']);

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