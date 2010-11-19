<?php

$this->set('title_for_layout', __('Agregar sin numerar', true));

$out[] = $this->MyForm->create('Sit',
	array('class' => 'mainForm clear', 'id' => 'formEditor')
);

$out[] = $this->MyHtml->tag(
	'p',
	$this->MyHtml->tag('span', '* ', array('class' => 'star')) .
		__('Los campos marcados con asterisco son obligatorios', true),
	array('id' => 'asterisk')
);

$content[] = $this->MyHtml->tag('legend', __('Importar butacas desde archivo MS Excel', true));

$content[] = $this->MyForm->input('Sit.location_id',
	array(
		'label' 	=> __('Ubicación', true),
		'empty'		=> true
	)
);

$content[] = $this->MyForm->input('Sit.amount',
	array(
		'label' 	=> __('Cantidad', true),
	)
);

$out[] = $this->MyHtml->tag('fieldset', $content, array('class' => 'clear'));


$out[] = $this->element('footer', array('link' => 'admin/sits'));
$out[] = $this->MyForm->end();

$content = $this->MyHtml->tag('div', $out);

echo $this->element('add', array('content' => $content));