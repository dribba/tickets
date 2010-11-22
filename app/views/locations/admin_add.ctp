<?php

$this->set('title_for_layout', __('Agregar Ubicación', true));

$out[] = $this->MyForm->create('Location', array('class' => 'mainForm clear', 'id' => 'formEditor'));

$out[] = $this->MyHtml->tag(
	'p',
	$this->MyHtml->tag('span', '* ', array('class' => 'star')) .
		__('Los campos marcados con asterisco son obligatorios', true),
	array('id' => 'asterisk')
);

$content[] = $this->MyHtml->tag('legend', __('Detalles de la Ubicación', true));

if (!empty($id)) {
	$content[] = $this->MyForm->input('Location.id',
		array(
			'type' 	=> 'hidden',
			'value'	=> $id
		)
	);
}
$content[] = $this->MyForm->input('Location.site_id',
	array(
		'label' 	=> __('Sitio', true),
	)
);

$content[] = $this->MyForm->input('Location.name',
	array(
		'label' 	=> __('Nombre', true),
	)
);


$out[] = $this->MyHtml->tag('fieldset', $content, array('class' => 'clear'));


$out[] = $this->element('footer', array('link' => 'admin/locations'));
$out[] = $this->MyForm->end();


$content = $this->MyHtml->tag('div', $out);

echo $this->element('add', array('content' => $content));