<?php

	$headerContent[] = $this->MyHtml->tag('h1', $title_for_layout);

	if (!empty($menu)) {
		foreach ($menu as $button) {
			$buttons[] = $button;
		}
	}

	$headerContent[] = $this->MyHtml->tag('div', $buttons, array('id' => 'actions'));

	$mainContent[] = $this->MyHtml->tag('div', $headerContent, array('class' => 'clear', 'id' => 'head'));

	$mainContent[] = $content;

	$maintContent[] = $this->MyHtml->tag('div', $this->MyPaginator->getNavigator(false), array('class' => 'clear', 'id' => 'bottomOptions'));

	$sidebar[] = $this->MyHtml->tag('div', $this->MyHtml->tag('div', 'a', array('class' => 'sidebox clear', 'id' => 'boxFirst')));

	echo $this->MyHtml->tag('div', $mainContent, array('id' => 'main', 'class' => 'clear'));

	
          


		