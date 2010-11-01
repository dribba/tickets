<?php
$this->set('title_for_layout', __('Cambiar contrasena', true));
$out[] = $this->MyForm->create('User', array('class' => 'mainForm clear', 'id' => 'formEditor'));
$content[] = $this->MyHtml->tag('legend', __('Contrasena nueva', true));
if (empty($id)) {
	$content[] = $this->MyForm->input(
			'current', array('label' => __('Contrasena actual', true), 'type' => 'password')
	);
} else {
	$content[] = $this->MyForm->input(
		'id',
		array('type' => 'hidden', 'value' => $id)
	);
}

$content[] = $this->MyForm->input(
		'new_password',
		array('label' => __('Contrasena nueva', true), 'type' => 'password')
);
$content[] = $this->MyForm->input(
		'retype_password',
		array('label' => __('Re ingrese la contrasena', true), 'type' => 'password')
);

$out[] = $this->MyHtml->tag('fieldset', $content, array('class' => 'clear'));

$out[] = $this->element('footer', array('link' => 'admin/users'));

$out[] = $this->MyForm->end();

$content = $this->MyHtml->tag('div', $out);

echo $this->element('add', array('content' => $content));