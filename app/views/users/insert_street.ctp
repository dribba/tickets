<?php

$out[] = $this->MyForm->create("Wizard", array("class" => "ajax_form"));

$content[] = $this->MyForm->input('User.street',
	array(
		'label' 	=> __('Dirección', true),
		'type'		=> 'radio',
		'options'	=> array('Duarte Quiros 2727', 'Duarte Quiros 1570', 'Duarte Quiros 2330')
	)
);
$out[] = $this->MyHtml->tag('div', $content, array('id' => 'container'));
$out[] = $this->element("wizard_hidden_fields");

$out[] = $this->element("footer");
$out[] = $this->MyForm->end();

echo $myHtml->out($out);