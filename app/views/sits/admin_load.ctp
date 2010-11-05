<?php

$this->set('title_for_layout', __('Importar desde Excel', true));

$out[] = $this->MyForm->create('Sit',
	array('class' => 'mainForm clear', 'id' => 'formEditor', 'type' => 'file')
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

$content[] = $this->MyForm->input('Sit.excel',
	array(
		'label' 	=> __('Archivo', true),
		'type'		=> 'file',
		'help'		=> __('Sólo archivos de tipo MS Excel<br/>(xls, xlsx)', true)
	)
);

$out[] = $this->MyHtml->tag('fieldset', $content, array('class' => 'clear'));


$out[] = $this->element('footer', array('link' => 'admin/sits'));
$out[] = $this->MyForm->end();

$content = $this->MyHtml->tag('div', $out);

echo $this->element('add', array('content' => $content));