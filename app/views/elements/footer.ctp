<?php 
	
$out = null;

if (empty($text)) {
	$text = __('Guardar', true);
}

$id = ((!empty($id)) ? $id : '');

if ($id == 'align-right') {
	$out[] = $this->MyForm->button(__('Cancelar', true), array('class' => 'btnCancel button secondary', 'type' => 'button', 'href' => $link));
	$out[] = $this->MyForm->submit($text, array('class' => 'button primary btnSubmit', 'div' => false));
} else {
	$out[] = $this->MyForm->submit($text, array('class' => 'button primary btnSubmit', 'div' => false));
	//$out[] = $this->MyHtml->tag('span', $this->MyHtml->link(__('Cancelar', true), array('controller' => $controller, 'action' => 'index')), array('id' => 'btnCancel', 'class' => 'button secondary'));
	$out[] = $this->MyForm->button(__('Cancelar', true), array('class' => 'btnCancel button secondary', 'type' => 'button', 'href' => $link));
}


echo $this->MyHtml->tag('div', $out, array('class' => 'formActions clear', 'id' => $id));