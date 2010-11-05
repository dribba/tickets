<?php
/** INDEX VIEW **/

	$this->set('title_for_layout', __('Historial de compras', true));

	
	/** The grid */
	$header	= null;
	$headers[] = __('Fecha de compra', true);
	$headers[] = __('Evento', true);
	$headers[] = __('Ubicacion', true);
	$headers[] = __('Cantidad de butacas', true);
	$headers[] = __('Butacas', true);
	$headers[] = __('Precio Unitario', true);
	$headers[] = __('Precio Total', true);

	$head = $this->MyHtml->tag('thead', $this->MyHtml->tableHeaders($headers));
	
	$body = array();
	foreach ($data as $record) {
		$td = null;
		$sits = Set::combine($record['EventsSit'], '{n}.Sit.id', '{n}.code');
		$td[] = $this->MyHtml->tag('td', $record['Sell']['formated_date']);
		$td[] = $this->MyHtml->tag('td', $record['EventsSit'][0]['Event']['name']);
		$td[] = $this->MyHtml->tag('td', $record['EventsSit'][0]['Sit']['Location']['name']);
		$td[] = $this->MyHtml->tag('td', sizeof($record['EventsSit']));
		$td[] = $this->MyHtml->tag('td', implode(', ', $sits));
		$td[] = $this->MyHtml->tag('td', 'a');
		$td[] = $this->MyHtml->tag('td', $record['Sell']['total']);
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


