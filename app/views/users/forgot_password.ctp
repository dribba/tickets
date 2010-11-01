<?php

$this->set('title_for_layout', __('Recuperar contrasena', true));

$out[] = $this->MyForm->create('User', array('class' => 'mainForm clear', 'id' => 'formEditor'));

$content[] = $this->MyForm->input('document', array('label' => __('Documento', true)));
$content[] = $myForm->input('mobile_area',
	array(
		//'between'	=> $myHtml->tag('span', '0', array('style' => 'float:left;')),
		'label' 	=> __('Celular (area)', true),
		'after' 	=> __('Sin el 0', true)
	)
);
$content[] = $myForm->input('mobile_phone',
	array(
		//'between'	=> $myHtml->tag('span', '15', array('style' => 'float:left;')),
		'label' 	=> __('Celular (número)', true),
		'after' 	=> __('Sin el 15', true)
	)
);
$content[] = $myForm->input('mobile_company',
	array(
		'type'		=> 'radio',
		'options'	=> array(
			'3' 		=> 'Claro',
			'1' 		=> 'Movistar',
			'4' 		=> 'Personal'
		),
		'label' 	=> __('Compañia', true),
		'div'		=> 'No'
	)
);

$out[] = $this->MyHtml->tag('fieldset', $content, array('class' => 'clear'));


$out[] = $this->element("footer", array('link' => 'users/login', 'text' => __('Recuperar', true)));
$out[] = $this->MyForm->end();

$content = $this->MyHtml->tag('div', $out);

echo $this->element('add', array('content' => $content));