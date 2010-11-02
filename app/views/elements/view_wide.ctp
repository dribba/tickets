<?php


	$headerContent[] = $this->MyHtml->tag('h1', ((!empty($title_for_layout)) ? $title_for_layout : '&nbsp;'));

	$mainContent[] = $this->MyHtml->tag('div', $headerContent, array('class' => 'clear wide', 'id' => 'head'));

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

	$mainContent[] = $this->MyHtml->tag('fieldset', '<legend class="wide"><span>' . $title . '</span></legend>' . $this->MyHtml->tag('dl', $fields, array('class' => 'view')), array('class' => 'clear mainForm'));


	echo $this->MyHtml->tag('div', $mainContent, array('id' => 'main', 'class' => 'clear wide'));

	