<?php
$this->set('title_for_layout', __('Cambiar Contraseña', true));
$out[] = $this->MyForm->create('User', array('class' => 'mainForm clear', 'id' => 'formEditor'));
$content[] = $this->MyHtml->tag('legend', __('Nueva Contraseña', true));
if (empty($id)) {
	$content[] = $this->MyForm->input(
			'current', array('label' => __('Contraseña Actual', true), 'type' => 'password')
	);
	$link = 'sells/index';
} else {
	$content[] = $this->MyForm->input(
		'id',
		array('type' => 'hidden', 'value' => $id)
	);
	$link = 'admin/users';
}

$content[] = $this->MyForm->input(
		'new_password',
		array('label' => __('Contraseña Nueva', true), 'type' => 'password')
);
$content[] = $this->MyForm->input(
		'retype_password',
		array('label' => __('Re-ingrese', true), 'type' => 'password')
);

$out[] = $this->MyHtml->tag('fieldset', $content, array('class' => 'clear'));

$out[] = $this->element('footer', array('link' => $link));

$out[] = $this->MyForm->end();

$content = $this->MyHtml->tag('div', $out);

echo $this->element('add', array('content' => $content));