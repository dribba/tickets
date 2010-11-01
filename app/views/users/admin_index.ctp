<?php


$this->set("title_for_layout", __("Listado de usuarios", true));


/** The grid */
$headers[] = __("Acciones", true);
$headers[] = __("Usuario / Documento", true);
$headers[] = __("Nombre completo", true);
$headers[] = __("Sexo", true);
$headers[] = __("Estado", true);

$head = $this->MyHtml->tag('thead', $this->MyHtml->tableHeaders($headers));

$body = array();
foreach ($data as $record) {
	$td = null;
	$actions = null;
	$actions[] = $this->MyHtml->image(
		'view.png',
		array(
			'class' => 'open_modal',
			'title' => __('Ver', true) . ' ' . $record['User']['full_name'],
			'url' => array(
				'controller' 	=> 'users',
				'action' 		=> 'view',
				$record['User']['id']
			),
		)
	);
	$actions[] = $this->MyHtml->image(
		'edit.png',
		array(
			'class' => 'open_modal',
			'title' => __('Editar', true) . ' ' . $record['User']['full_name'],
			'url' => array(
				'controller' 	=> 'users',
				'action' 		=> 'add',
				$record['User']['id']
			),
		)
	);

	$td[] = $this->MyHtml->tag('td', $actions);
	$td[] = $this->MyHtml->tag('td', $record['User']['username']);
	$td[] = $this->MyHtml->tag('td', $record['User']['full_name']);
	$td[] = $this->MyHtml->tag('td', $record['User']['sex']);
	$td[] = $this->MyHtml->tag('td', $record['User']['state']);
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


$filters = array('User.document', 'User.email', 'User.full_name', 'User.mobile_area', 'User.mobile_phone');
echo $this->element('content', array('content' => $content, 'filters' => $filters));

