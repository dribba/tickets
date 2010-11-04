<?php

	$headerContent[] = $this->MyHtml->tag('h1', $title_for_layout);

	$mainContent[] = $this->MyHtml->tag('div', $headerContent, array('class' => 'clear', 'id' => 'head'));

	$mainContent[] = $content;

	//$mainContent[] = $this->MyHtml->tag('div', 'paginacion', array('class' => 'clear', 'id' => 'bottomOptions'));

	echo $this->MyHtml->tag('div', $mainContent, array('id' => 'main', 'class' => 'clear'));

	$sidebarContent[] = $this->MyHtml->tag('div', $this->MyHtml->tag('div', '', array('class' => 'sidebox clear', 'id' => 'boxFirst')));

	echo $this->MyHtml->tag('div', $sidebarContent, array('id' => 'sidebar', 'class' => ''));
          


		