<?php

$out[] = $this->MyForm->create("Location", array("class" => "ajax_form"));
if (!empty($id)) {
	$content[] = $this->MyForm->input('Location.id',
		array(
			'type' 	=> 'hidden',
			'value'	=> $id
		)
	);
}
$content[] = $this->MyForm->input('Location.name',
	array(
		'label' 	=> __('Nombre', true),
	)
);
$out[] = $this->MyHtml->tag('div', $content, array('id' => 'container'));


$out[] = $this->element("footer", array('controller' => 'events'));
$out[] = $this->MyForm->end();

echo implode("\n", $out);