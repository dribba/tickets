<?php

$out[] = $this->MyForm->create("Wizard", array("class" => "ajax_form"));

$content[] = $this->MyForm->input('User.document',
	array(
		'label' 	=> __('Documento', true)
	)
);


$out[] = $this->MyHtml->tag('div', $content, array('id' => 'container'));
$out[] = $this->element("wizard_hidden_fields");


$out[] = $this->element("footer");


echo $myHtml->out($out);