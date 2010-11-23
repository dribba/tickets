<?php

	$this->set('title_for_layout', $data['Location']['name'] . ' - ' . __('Compra de entrada', true));

	$fields[] = $this->element('table', array('data' => $data, 'wide' => 'Yes'));
	
	echo $this->element('view_wide',
		array(
			'data' 		=> $fields,
			'title' 	=> __('Seleccione una butaca', true),
		)
	);

