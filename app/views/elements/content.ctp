<?php

	$message = explode('|', $this->Session->flash());
	if (!empty($message[0])) {
		$headerContent[] = $this->MyHtml->tag('div', $message[1], array('class' => 'message', 'id' => 'msg' . ucwords($message[0])));
	}

	$headerContent[] = $this->MyHtml->tag('h1', $title_for_layout);
	$buttons = array();
	if (!empty($menu)) {
		foreach ($menu as $button) {
			$buttons[] = $button;
		}
	}

	$headerContent[] = $this->MyHtml->tag('div', $buttons, array('id' => 'actions'));

	$mainContent[] = $this->MyHtml->tag('div', $headerContent, array('class' => 'clear', 'id' => 'head'));

	$mainContent[] = $content;

	$mainContent[] = $this->MyHtml->tag('div', $this->MyPaginator->getNavigator(false), array('class' => 'clear', 'id' => 'bottomOptions'));

	echo $this->MyHtml->tag('div', $mainContent, array('id' => 'main', 'class' => 'clear'));

	$sidebarContent[] = $this->MyHtml->tag('div', $this->MyHtml->tag('div', 'xxx', array('class' => 'sidebox clear', 'id' => 'boxFirst')));

	echo $this->MyHtml->tag('div', $sidebarContent, array('id' => 'sidebar', 'class' => ''));
          


		