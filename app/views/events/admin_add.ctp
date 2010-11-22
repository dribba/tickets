<?php

$this->set('title_for_layout', __('Agregar evento', true));

$out[] = $this->MyForm->create('Event', array('type' => 'file', 'class' => 'mainForm clear', 'id' => 'formEditor'));

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
		'empty'		=> true,
		'label' 	=> __('Sitio', true),
	)
);
$content[] = $this->MyForm->input('Event.location_id',
	array(
		'type'		=> 'select',
		'multiple'	=> true,
		'label' 	=> __('Ubicaciones', true),
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
$content[] = $this->MyForm->input('Event.image',
	array(
		'type'		=> 'file',
		'label' 	=> __('Imagen', true),
		'help'		=> __('Sólo archivos de tipo imagen<br/>(jpg, gif, png)', true)
	)
);
$content[] = $this->MyForm->input('Event.comments',
	array(
		'label' 	=> __('Observaciones', true),
		'class'		=> 'area longest'
	)
);

$out[] = $this->MyHtml->tag('fieldset', $content, array('class' => 'clear'));


$out[] = $this->element('footer', array('link' => 'admin/events'));
$out[] = $this->MyForm->end();


$content = $this->MyHtml->tag('div', $out);

echo $this->element('add', array('content' => $content));
$new = (empty($this->data['Event']['id']))?'true':'false';
echo $this->MyHtml->scriptBlock(
	'$(document).ready(function($) {

		var getLocations = function(siteId) {
			$.getJSON($.path("events/locations/" + siteId), function(data) {
				var options = "";
				$.each(data, function(i, option) {
					if (option.split("|").pop() == "selected" || ' . $new . ') {
						options += "<option selected value=\"" + i + "\">" + option + "</option>";
					} else {
						options += "<option value=\"" + i + "\">" + option + "</option>";
					}
				});
				$("#EventLocationId").html(options);
			});
		};

		$("#EventSiteId").change(function() {
			getLocations($(this).val());
		});
		getLocations($("#EventSiteId").val());

	});', array('inline' => false)
);