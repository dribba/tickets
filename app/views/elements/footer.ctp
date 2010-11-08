<?php 
	
$out = null;

if (empty($text)) {
	$text = __('Guardar', true);
}

$out[] = $this->MyForm->submit($text, array('class' => 'button primary', 'id' => 'btnSubmit', 'div' => false));
//$out[] = $this->MyHtml->tag('span', $this->MyHtml->link(__('Cancelar', true), array('controller' => $controller, 'action' => 'index')), array('id' => 'btnCancel', 'class' => 'button secondary'));
$out[] = $this->MyForm->button(__('Cancelar', true), array('id' => 'btnCancel', 'class' => 'button secondary', 'type' => 'button', 'href' => $link));


$id = ((!empty($id)) ? $id : '');
echo $this->MyHtml->tag('div', $out, array('class' => 'formActions clear', 'id' => $id));