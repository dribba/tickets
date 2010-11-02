<?php
/** INDEX VIEW **/

	$this->set("title_for_layout", __("Historial de compras", true));


	/** The grid */
	$header	= null;
	$headers[] = __("Fecha de compra", true);
	$headers[] = __("Entrada", true);
	$headers[] = __("Butaca", true);

	$head = $this->MyHtml->tag('thead', $this->MyHtml->tableHeaders($headers));
	
	$body = array();
	foreach ($data as $record) {
		$td = null;
		
		$td[] = $this->MyHtml->tag('td', $record["Sell"]["formated_date"]);
		$td[] = $this->MyHtml->tag('td', $record["Location"]["name"]);
		$td[] = $this->MyHtml->tag('td', $record["Location"]["name"]);
		$body[] = $this->MyHtml->tag('tr', $td);

	}

	if ($body != null) {
		$body = implode("\n", $body);
	} else {
		$body = '';
	}

	$content = $this->MyHtml->tag('div',
		$this->MyHtml->tag('table', $head . $body),
		array('id' => 'grid')
	);

	echo $this->element('content', array('content' => $content));


