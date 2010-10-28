<?php
/** INDEX VIEW **/
$this->set("title_for_layout", __("Felonies", true));
$headers[] = "&nbsp";
$headers[] = __("&nbsp;", true);
$headers[] = __("Open", true);
$headers[] = __("Type", true);
$headers[] = __("Comment", true);
$body = null;
foreach ($data as $record) {
    $image = $this->MyHtml->image("select.png", array("title" => (Set::check($record, "Felony.show")) ? __("View", true) . " " . $record["Felony"]["show"] : __("View", true) . " " . $record["Felony"]["Felony__show"], "alt" => (Set::check($record, "Felony.show")) ? $record["Felony"]["show"] : $record["Felony"]["Felony__show"], "url" => array("controller" => "felonies", "action" => "view", $record["Felony"]["id"],), "class" => "view_link one_to_many", "id" => "Felony",));
    $body[] = array($image, $record["Felony"]["matter_id"], $record["Felony"]["open"], $record["Felony"]["felonies_type_id"], $record["Felony"]["comments"]);
}
$out[] = $this->MyHtml->tag("div", $this->MyHtml->table($body, $headers), array("id" => "grid"));
echo $this->MyHtml->tag("div", $out);
