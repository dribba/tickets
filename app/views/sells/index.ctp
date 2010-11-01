<?php
/** INDEX VIEW **/

	$this->set("title_for_layout", __("Historial de compras", true));
	$headers[] = __("Fecha de compra", true);
	$headers[] = __("Entrada", true);
	$headers[] = __("Butaca", true);
	$head = $this->MyHtml->tag('thead', $this->MyHtml->tableHeaders($headers));
	$body = null;
	foreach ($data as $record) {

		$body[] = array(
			$record["Sell"]["formated_date"],
			$record["Location"]["name"],
			$record["Location"]["name"]
		);
	}
	$out[] = $this->MyHtml->tag("div", $this->MyHtml->table($body, $headers), array("id" => "grid"));
	$out[] = $this->MyPaginator->getNavigator(false);

	$content = $this->MyHtml->tag('div',
		$this->MyHtml->tag('table', $head . $body),
		array('id' => 'grid')
	);
	echo $this->element('content', array('content' => $content));

