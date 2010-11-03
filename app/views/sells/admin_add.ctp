<?php

$this->set('title_for_layout', __('Venta', true));

$out[] = $this->MyForm->create('Sell',
	array('class' => 'mainForm clear', 'id' => 'formEditor')
);

$out[] = $this->MyHtml->tag(
	'p',
	$this->MyHtml->tag('span', '* ', array('class' => 'star')) .
		__('Los campos marcados con asterisco son obligatorios', true),
	array('id' => 'asterisk')
);

$content[] = $this->MyHtml->tag('legend', __('Detalles de la venta', true));

if (!empty($id)) {
	$content[] = $this->MyForm->input('Sell.id',
		array(
			'type' 	=> 'hidden',
			'value'	=> $id
		)
	);
}
$content[] = $this->MyForm->input('Sell.created',
	array(
		'label' 	=> __('Fecha de compra', true),
		'class'		=> 'datepicker',
		'type'		=> 'text'
	)
);

$content[] = $this->MyForm->input('Sell.user',
	array(
		'label' 	=> __('Usuario', true),
		'value'		=> $this->data['User']['full_name']
	)
);

$content[] = $this->MyForm->input('Sell.license_available',
	array(
		'label' 	=> __('Carnet disponible', true),
		'type'		=> 'select',
		'options'	=> array('Y' => __('Si', true), 'N' => __('No', true))
	)
);

$content[] = $this->MyForm->input('Sell.license_number',
	array(
		'label' 	=> __('Numero de carnet', true),
	)
);

$content[] = $this->MyForm->input('Sell.send',
	array(
		'label' 	=> __('Envio a domicilio', true),
		'type'		=> 'select',
		'options'	=> array('Y' => __('Si', true), 'N' => __('No', true))
	)
);

$content[] = $this->MyForm->input('Sell.street',
	array(
		'label' 	=> __('Direccion de envio', true),
	)
);

$content[] = $this->MyForm->input('Sell.horary',
	array(
		'label' 	=> __('Horario', true),
	)
);

$content[] = $this->MyForm->input('EventsSit.sit_id',
	array(
		'label' 	=> __('Butaca', true),
	)
);

$content[] = $this->MyForm->input('Location.name',
	array(
		'label' 	=> __('Sitio', true),
	)
);


$out[] = $this->MyHtml->tag('fieldset', $content, array('class' => 'clear'));


$out[] = $this->element("footer", array('link' => 'admin/sells'));
$out[] = $this->MyForm->end();

$content = $this->MyHtml->tag('div', $out);

echo $this->element('add', array('content' => $content));