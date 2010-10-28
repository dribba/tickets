<?php

$out[] = $this->MyForm->create('User', array('class' => ''));

$content[] = $this->MyForm->input('username', array('label' => __('Documento', true)));


$mobile[] = $this->MyHtml->tag('legend', __('Mobile phone', true));
$mobile[] = $this->MyForm->input('User.phone_area', array('label' => __('Cod. Area: 0', true)));
$mobile[] = $this->MyForm->input('User.phone_number', array('label' => __('Numero: 15', true)));

$content[] = $this->MyHtml->tag('div', $this->MyHtml->tag('fieldset', $mobile), array('class' => 'input'));

$out[] = $this->MyHtml->tag('div', $content, array('id' => 'container'));
$out[] = $this->element("footer");

echo $myHtml->out($out);