<?php

$this->set('title_for_layout', __('Listado de Ubicaciones', true));

$menu[] = $this->MyHtml->link(
	__('Agregar Ubicación', true),
	array(
		'controller'	=> 'locations',
		'action'		=> 'add',
	),
	array('class' => 'button primary', 'title' => __('Agregar Ubicación', true))
);

$filters = array(
	'Location.name'		=> array('label' => __('Nombre', true)),
	'Location.site_id'	=> array('label' => __('Sitio', true))
);


/** The grid */
$header	= null;
$header[] = __('Acciones', true);
$header[] = __('Sitio', true);
$header[] = __('Nombre', true);
$header[] = __('Butacas', true);

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
		$actions[] = $this->MyHtml->image(
			'delete.png',
			array(
				'class' => 'open_modal',
				'title' => __('Eliminar', true) . ' ' . $record['Location']['id'],
				'url' => array(
					'controller' 	=> 'locations',
					'action' 		=> 'delete',
					$record['Location']['id']
				),
				'confirm'	=> __('Esta seguro que desea eliminar la ubicación?', true),
			)
		);


		$td[] = $this->MyHtml->tag('td', $actions);
		$td[] = $this->MyHtml->tag('td', $record['Site']['name']);
		$td[] = $this->MyHtml->tag('td', $record['Location']['name']);
		$td[] = $this->MyHtml->tag('td', $record['Location']['sits']);

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