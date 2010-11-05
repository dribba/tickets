<?php

	$out[] = $this->MyHtml->tag('div',
		__('Ingrese su usuario y contrasena', true),
		array('class' => 'message clear', 'id' => 'msgInfo')
	);

	$out[] = $this->MyHtml->tag('h2',
		__('Iniciar sesion', true)
	);


	$out[] = $this->Form->create('User', array('action' => 'login'));

	
	$content[] = $this->MyHtml->tag('legend', __('Ingresar', true));
	
	$content[] = $this->MyForm->input('username', array('label' => __('Username', true), 'div' => 'field'));
	$content[] = $this->MyForm->input('password', array('label' => __('Password', true), 'div' => 'field'));
	
	$content[] = $this->MyHtml->tag('div',
		$this->MyForm->submit(
			__('Ingresar', true),
			array('class' => 'button primary', 'id' => 'save', 'div' => false)
		),
		array('id' => 'loginActions')
	);

	$out[] = $this->MyHtml->tag('fieldset', $content);

	$out[] = $this->Form->end();

	echo $this->MyHtml->tag('div', 
		$this->MyHtml->tag('div', $out, array('class' => 'users')),
		array('id' => 'login')
	);
