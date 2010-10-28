<?php
/** INDEX VIEW **/

$this->set("title_for_layout", __("Historial de compras", true));
$headers[] = __("Fecha de compra", true);
$headers[] = __("Entrada", true);
$headers[] = __("Butaca", true);

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
echo $this->MyHtml->tag("div", $out);
