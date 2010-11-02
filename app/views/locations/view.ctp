<?php

	$this->set('title_for_layout', __('Compra de entrada', true));

	$fields[__('Ubicaciones', true)] = $this->element('table', array('data' => $data, 'wide' => 'Yes'));
	
	echo $this->element('view_wide',
		array(
			'data' 		=> $fields,
			'title' 	=> __('Seleccione una butaca', true),
		)
	);

