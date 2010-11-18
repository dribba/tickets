<?php 
	
$out = null;

if (empty($text)) {
	$text = __('Guardar', true);
}

if (!isset($next)) {
	$next = true;
}
if (!isset($cancel)) {
	$cancel = true;
}

if ($cancel) {
	$out[] = $this->MyForm->button(__('Cancelar', true), array('class' => 'btnCancel button secondary', 'type' => 'button', 'href' => $link));
}
if ($next) {
	$out[] = $this->MyForm->submit($text, array('class' => 'button primary btnSubmit', 'div' => false));
}


echo $this->MyHtml->tag('div',
	$out,
	array(
		'class' => 'formActions clear',
		'id' 	=> 'align-right'
	)
);