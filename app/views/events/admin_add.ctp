<?php

$out[] = $this->MyForm->create("Event", array("class" => "ajax_form"));
if (!empty($id)) {
	$content[] = $this->MyForm->input('Event.id',
		array(
			'type' 	=> 'hidden',
			'value'	=> $id
		)
	);
}
$content[] = $this->MyForm->input('Event.name',
	array(
		'label' 	=> __('Nombre del evento', true),
	)
);

$content[] = $this->MyForm->input('Event.comments',
	array(
		'label' 	=> __('Comentario', true),
	)
);
$content[] = $this->MyForm->input('Event.start',
	array(
		'type'		=> 'text',
		'label' 	=> __('Fecha de inicio', true),
		'class'		=> 'datepicker'
	)
);
$content[] = $this->MyForm->input('Event.end',
	array(
		'type'		=> 'text',
		'label' 	=> __('Fecha de cierre', true),
		'class'		=> 'datepicker'
	)
);

$out[] = $this->MyHtml->tag('div', $content, array('id' => 'container'));


$out[] = $this->element("footer", array('controller' => 'events'));
$out[] = $this->MyForm->end();

echo implode("\n", $out);