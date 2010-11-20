<?php

$this->set('title_for_layout', __('Agregar butaca', true));

$out[] = $this->MyForm->create('Sit', array('class' => 'mainForm clear', 'id' => 'formEditor'));

$out[] = $this->MyHtml->tag(
	'p',
	$this->MyHtml->tag('span', '* ', array('class' => 'star')) .
		__('Los campos marcados con asterisco son obligatorios', true),
	array('id' => 'asterisk')
);

$content[] = $this->MyHtml->tag('legend', __('Detalles del evento', true));

if (!empty($id)) {
	$content[] = $this->MyForm->input('Sit.id',
		array(
			'type' 	=> 'hidden',
			'value'	=> $id
		)
	);
}
$content[] = $this->MyForm->input('Sit.code',
	array(
		'label' 	=> __('Codigo', true),
	)
);
$content[] = $this->MyForm->input('Sit.location_id',
	array(
		'label' 	=> __('Ubicación', true),
	)
);
$content[] = $this->MyForm->input('Sit.row',
	array(
		'label' 	=> __('Posicion eje X', true),
	)
);
$content[] = $this->MyForm->input('Sit.col',
	array(
		'label' 	=> __('Posicion eje Y', true),
	)
);
$content[] = $this->MyForm->input('Sit.state',
	array(
		'options'	=> array('En venta' => 'En venta', 'Bloqueado' => 'Bloqueado'),
		'label' 	=> __('Estado', true),
	)
);

$out[] = $this->MyHtml->tag('fieldset', $content, array('class' => 'clear'));


$out[] = $this->element("footer", array('link' => 'admin/sits'));
$out[] = $this->MyForm->end();

$content = $this->MyHtml->tag('div', $out);

echo $this->element('add', array('content' => $content));