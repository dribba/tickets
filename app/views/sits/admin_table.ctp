<?php

$out[] = $this->MyHtml->tag('h2',
	__('Butacas', true),
	array('id' => 'tasks_title')
);
$this->set("title_for_layout", __("Listado de butacas", true));

echo $this->element('table', array('data' => $data));





echo $this->Js->writeBuffer();
