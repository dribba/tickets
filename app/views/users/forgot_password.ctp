<?php

$out[] = $this->MyForm->create('User', array('class' => ''));

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
		'label' 	=> __('Compañia', true)
	)
);

$out[] = $this->MyHtml->tag('div', $content, array('id' => 'container'));
$out[] = $this->element('footer', array('controller' => 'users', 'text' => __('Recuperar', true)));

echo $myHtml->out($out);