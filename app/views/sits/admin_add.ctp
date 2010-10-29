<?php

$out[] = $this->MyForm->create("Sit", array("class" => "ajax_form"));
if (!empty($id)) {
	$content[] = $this->MyForm->input('Sit.id',
		array(
			'type' 	=> 'hidden',
			'value'	=> $id
		)
	);
}
$content[] = $this->MyForm->input('Sit.code',
	array(
		'label' 	=> __('Codigo', true),
	)
);
$content[] = $this->MyForm->input('Sit.location_id',
	array(
		'label' 	=> __('Locacion', true),
	)
);
$content[] = $this->MyForm->input('Sit.x',
	array(
		'label' 	=> __('Posicion eje X', true),
	)
);
$content[] = $this->MyForm->input('Sit.y',
	array(
		'label' 	=> __('Posicion eje Y', true),
	)
);

$out[] = $this->MyHtml->tag('div', $content, array('id' => 'container'));


$out[] = $this->element("footer", array('controller' => 'sits'));
$out[] = $this->MyForm->end();

echo $myHtml->out($out);