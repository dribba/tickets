<?php

$this->set('title_for_layout', __('Agregar evento', true));

$out[] = $this->MyForm->create('Event', array('class' => 'mainForm clear', 'id' => 'formEditor'));

$out[] = $this->MyHtml->tag(
	'p', 
	$this->MyHtml->tag('span', '* ', array('class' => 'star')) .
		__('Los campos marcados con asterisco son obligatorios', true),
	array('id' => 'asterisk')
);


$content[] = $this->MyHtml->tag('legend', __('Detalles del evento', true));

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
		'label' 	=> __('Nombre', true),
	)
);
$content[] = $this->MyForm->input('Event.site_id',
	array(
		'label' 	=> __('Sitio', true),
	)
);
$content[] = $this->MyForm->input('Event.state',
	array(
		'label' 	=> __('Estado', true),
		'options'	=> array('active' => __('Activo', true), 'closed' => __('Cerrado', true))
	)
);
$content[] = $this->MyForm->input('Event.start',
	array(
		'type'		=> 'text',
		'label' 	=> __('Fecha de inicio', true),
		'class'		=> 'datepicker',
		'help'		=> __('Fecha de inicio del evento<br /> Formato yyyy-mm-dd hh:mm:ss', true)
	)
);
$content[] = $this->MyForm->input('Event.end',
	array(
		'type'		=> 'text',
		'label' 	=> __('Fecha de cierre', true),
		'class'		=> 'datepicker',
		'help'		=> __('Fecha de finalización del evento<br /> Formato yyyy-mm-dd hh:mm:ss', true)
	)
);
$content[] = $this->MyForm->input('Event.comments',
	array(
		'label' 	=> __('Observaciones', true),
		'class'		=> 'area longest'
	)
);

$out[] = $this->MyHtml->tag('fieldset', $content, array('class' => 'clear'));


$out[] = $this->element("footer", array('link' => 'admin/events'));
$out[] = $this->MyForm->end();


$content = $this->MyHtml->tag('div', $out);

echo $this->element('add', array('content' => $content));