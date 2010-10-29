<?php 
	
$out = null;

if (empty($text)) {
	$text = __('Guardar', true);
}

$out[] = $this->MyForm->submit($text, array('class' => 'action', 'id' => 'save', 'div' => false));
$out[] = $this->MyHtml->tag('span', $this->MyHtml->link(__('Cancelar', true), array('controller' => $controller, 'action' => 'index')), array('class' => 'cancel'));


echo $this->MyHtml->tag('div', $out, array('id' => 'footer'));	