<?php

$out[] = $this->MyForm->create("Wizard", array("class" => "ajax_form"));

$content[] = $this->MyForm->input('User.full_name',
	array(
		'label' 	=> __('Nombre Completo', true),
		'disabled' 	=> true)
);
$content[] = $this->MyForm->input('User.document',
	array(
		'label' 	=> __('Documento', true),
		'disabled' 	=> true)
);
$content[] = $this->MyForm->input('User.sex',
	array(
		'options' 	=> array('F' => __('Femenino', true), 'M' => __('Masculino', true)),
		'label' 	=> __('Sex', true),
		'disabled' 	=> true
	)
);
$content[] = $this->MyForm->input('User.email', array('label' => __('Email', true)));
$content[] = $this->MyForm->input('User.birthday', array('label' => __('Fecha de Nacimiento', true)));

$mobile[] = $this->MyHtml->tag('legend', __('Mobile phone', true));
$mobile[] = $this->MyForm->input('User.phone_area', array('label' => __('Cod. Area: 0', true)));
$mobile[] = $this->MyForm->input('User.phone_number', array('label' => __('Numero: 15', true)));

$content[] = $this->MyHtml->tag('div', $this->MyHtml->tag('fieldset', $mobile), array('class' => 'input'));


$out[] = $this->MyHtml->tag('div', $content, array('id' => 'container'));
$out[] = $this->element("wizard_hidden_fields");

$out[] = $this->element("footer");
$out[] = $this->MyForm->end();

echo $myHtml->out($out);