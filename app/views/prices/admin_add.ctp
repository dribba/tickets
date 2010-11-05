<?php

$this->set('title_for_layout', __('Agregar Precio', true));

$out[] = $this->MyForm->create('Price', array('class' => 'mainForm clear', 'id' => 'formEditor'));

$out[] = $this->MyHtml->tag(
	'p',
	$this->MyHtml->tag('span', '* ', array('class' => 'star')) .
		__('Los campos marcados con asterisco son obligatorios', true),
	array('id' => 'asterisk')
);

$content[] = $this->MyHtml->tag('legend', __('Detalles del Precio', true));

if (!empty($id)) {
	$content[] = $this->MyForm->input('Price.id',
		array(
			'type' 	=> 'hidden',
			'value'	=> $id
		)
	);
}
$content[] = $this->MyForm->input('Price.event_id',
	array(
		'label' 	=> __('Evento', true),
	)
);
$content[] = $this->MyForm->input('Price.location_id',
	array(
		'label' 	=> __('Ubicación', true),
	)
);
$content[] = $this->MyForm->input('Price.type',
	array(
		'label' 	=> __('Tipo', true),
		'options'	=> array(
			'Mayor' 		=> 'Mayor',
			'Dama' 			=> 'Dama',
			'Jubilado' 		=> 'Jubilado',
			'Cadete Mayor' 	=> 'Cadete Mayor',
			'Cadete Menor' 	=> 'Cadete Menor',
		)
	)
);
$content[] = $this->MyForm->input('Price.price',
	array(
		'label' 	=> __('Precio', true),
	)
);


$out[] = $this->MyHtml->tag('fieldset', $content, array('class' => 'clear'));


$out[] = $this->element('footer', array('link' => 'admin/prices'));
$out[] = $this->MyForm->end();


$content = $this->MyHtml->tag('div', $out);

echo $this->element('add', array('content' => $content));