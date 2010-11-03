<?php


	$headerContent[] = $this->MyHtml->tag('h1', ((!empty($title_for_layout)) ? $title_for_layout : '&nbsp;'));

	$mainContent[] = $this->MyHtml->tag('div', $headerContent, array('class' => 'clear', 'id' => 'head'));

	$fields = array();
	
	foreach($data as $field => $value) {
		$fields[] = $this->MyHtml->tag('dt',
			$field
		);
		$fields[] = $this->MyHtml->tag('dd',
			((empty($value)) ? '&nbsp;' : $value)
		);
	}

	//$legend = $this->MyHtml->tag('legend', $this->MyHtml->tag('span', __('Detalles del evento')));

	$mainContent[] = $this->MyHtml->tag('fieldset', '<legend><span>' . $title . '</span></legend>' . $this->MyHtml->tag('dl', $fields, array('class' => 'view')), array('class' => 'clear mainForm'));

	$extraContent = ((!empty($extraContent)) ? $extraContent : array());
	
	$mainContent = array_merge($mainContent, $extraContent);

	echo $this->MyHtml->tag('div', $mainContent, array('id' => 'main', 'class' => 'clear'));

	$sideContent[] = $this->MyHtml->tag('h1', __('Acciones', true));

	$sideContent[] = $this->MyHtml->tag('div', $links, array('class' => 'boxContent clear'));



	$sidebarContent[] = $this->MyHtml->tag('div', $this->MyHtml->tag('div', $sideContent, array('class' => 'sidebox clear', 'id' => 'boxFirst')));

	echo $this->MyHtml->tag('div', $sidebarContent, array('id' => 'sidebar', 'class' => ''));

	