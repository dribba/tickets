<?php 
	
$out = null;


$out[] = $this->MyForm->submit(__('Guardar', true), array('class' => 'action', 'id' => 'save', 'div' => false));
$out[] = $this->MyHtml->tag('span', $this->MyHtml->link(__('Cancelar', true), array('controller' => $controller, 'action' => 'index')), array('class' => 'cancel'));


echo $this->MyHtml->tag('div', $out, array('id' => 'footer'));	