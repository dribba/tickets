<?php

$this->set('title_for_layout', __('Agregar evento', true));

$out[] = $this->MyForm->create('User', array('class' => 'mainForm clear', 'id' => 'formEditor'));

$out[] = $this->MyHtml->tag(
	'p',
	$this->MyHtml->tag('span', '* ', array('class' => 'star')) .
		__('Los campos marcados con asterisco son obligatorios', true),
	array('id' => 'asterisk')
);
$content[] = $this->MyHtml->tag('legend', __('Detalles del usuario', true));
if (!empty($id)) {
	$content[] = $this->MyForm->input('User.id',
		array(
			'type' 	=> 'hidden',
			'value'	=> $id
		)
	);
}
$content[] = $this->MyForm->input('User.full_name',
	array(
		'label' 	=> __('Nombre completo', true),
	)
);

$content[] = $this->MyForm->input('User.sex',
	array(
		'label' 	=> __('Sexo', true),
	)
);
$content[] = $this->MyForm->input('User.mobile_area',
	array(
		'type'		=> 'text',
		'label' 	=> __('Codigo de area', true),
	)
);
$content[] = $this->MyForm->input('User.mobile_phone',
	array(
		'type'		=> 'text',
		'label' 	=> __('Celular', true),
	)
);

$content[] = $this->MyForm->input('mobile_company',
	array(
		'type'		=> 'select',
		'options'	=> array(
			'3' 		=> 'Claro',
			'1' 		=> 'Movistar',
			'4' 		=> 'Personal',
		),
		'label' 	=> __('Compañia', true),
	)
);

$content[] = $this->MyForm->input('User.email',
	array(
		'type'		=> 'text',
		'label' 	=> __('Email', true),
	)
);

$out[] = $this->MyHtml->tag('fieldset', $content, array('class' => 'clear'));


$out[] = $this->element("footer", array('link' => 'admin/users'));
$out[] = $this->MyForm->end();


$content = $this->MyHtml->tag('div', $out);

echo $this->element('add', array('content' => $content));