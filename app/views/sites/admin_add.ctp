<?php

$this->set('title_for_layout', __('Agregar sitio', true));

$out[] = $this->MyForm->create('Site', 
	array('class' => 'mainForm clear', 'id' => 'formEditor', 'type' => 'file')
);

$out[] = $this->MyHtml->tag(
	'p',
	$this->MyHtml->tag('span', '* ', array('class' => 'star')) .
		__('Los campos marcados con asterisco son obligatorios', true),
	array('id' => 'asterisk')
);

$content[] = $this->MyHtml->tag('legend', __('Detalles del sitio', true));

if (!empty($id)) {
	$content[] = $this->MyForm->input('Site.id',
		array(
			'type' 	=> 'hidden',
			'value'	=> $id
		)
	);
}
$content[] = $this->MyForm->input('Site.name',
	array(
		'label' 	=> __('Nombre', true),
	)
);

$content[] = $this->MyForm->input('Site.plane',
	array(
		'label' 	=> __('Plano', true),
		'type'		=> 'file',
		'help'		=> __('Solo archivos del tipo imagen<br>(jpg, jpeg, png)', true)
	)
);

$out[] = $this->MyHtml->tag('fieldset', $content, array('class' => 'clear'));


$out[] = $this->element("footer", array('link' => 'admin/sites'));
$out[] = $this->MyForm->end();

$content = $this->MyHtml->tag('div', $out);

echo $this->element('add', array('content' => $content));