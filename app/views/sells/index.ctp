<?php
/** INDEX VIEW **/

	$this->set('title_for_layout', __('Historial de compras', true));

	
	/** The grid */
	$header	= null;
	$headers[] = __('Estado', true);
	$headers[] = __('Compra', true);
	$headers[] = __('Evento', true);
	$headers[] = __('Fecha', true);
	//$headers[] = __('Ubicación', true);
	$headers[] = __('Butacas', true);
	$headers[] = __('Total', true);

	$head = $this->MyHtml->tag('thead', $this->MyHtml->tableHeaders($headers));
	
	$body = array();
	foreach ($data as $record) {

		$td = null;
		//$sits = Set::combine($record['SellsDetail'], '{n}.EventsSit.Sit.id', '{n}.EventsSit.Sit.code');
		$td[] = $this->MyHtml->tag('td', $record['Sell']['state']);
		$td[] = $this->MyHtml->tag('td', $record['Sell']['formated_date']);
		$td[] = $this->MyHtml->tag('td', $record['Event']['name']);
		$td[] = $this->MyHtml->tag('td', $record['Event']['formated_short_start']);
		//$td[] = $this->MyHtml->tag('td', $record['SellsDetail'][0]['EventsSit']['Sit']['Location']['name']);
		$td[] = $this->MyHtml->tag('td', count($record['SellsDetail']));
		//$td[] = $this->MyHtml->tag('td', implode(', ', $sits));
		//$td[] = $this->MyHtml->tag('td', $record['SellsDetail'][0]['price']);
		$td[] = $this->MyHtml->tag('td', '$ ' . $record['Sell']['total']);
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


