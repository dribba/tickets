<?php

$out[] = $this->MyForm->create("User", array("class" => "ajax_form"));
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
$content[] = $this->MyForm->input('User.mobile_phone',
	array(
		'type'		=> 'text',
		'label' 	=> __('Celular', true),
	)
);

$content[] = $this->MyForm->input('User.email',
	array(
		'type'		=> 'text',
		'label' 	=> __('Email', true),
	)
);

$out[] = $this->MyHtml->tag('div', $content, array('id' => 'container'));


$out[] = $this->element("footer", array('controller' => 'users'));
$out[] = $this->MyForm->end();

echo $myHtml->out($out);