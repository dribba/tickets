<?php 


$filters[] = $this->MyForm->create(Inflector::Classify($this->name), array('class' => 'sideForm'));

foreach ($fields as $k => $v) {
	$v['class'] = ((!empty($v['class'])) ? $v['class'] : '') . ' full';
	if (is_array($v)) {
		$filters[] = $this->MyForm->input($k, $v);
	} else {
		$filters[] = $this->MyForm->input($v);
	}
}

$actions[] = $this->MyForm->submit(__('Buscar', true),
	array(
		'type' 		=> 'submit',
		'class' 	=> 'button primary',
		'div' 		=> false,
		'label' 	=> false
	)
);
$actions[] = $this->MyForm->submit(__('Limpiar', true),
	array(
		'type' 		=> 'reset',
		'class' 	=> 'button clearFilter primary',
		'div' 		=> false,
		'label' 	=> false
	)
);
$filters[] = $this->MyHtml->tag('div', $actions, 'action');
$filters[] = $this->MyForm->end();

echo $this->MyHtml->tag('div', $filters, array('id' => 'filters'));