<?php

$body = array();

for ($x = 1; $x <= $data['limits']['lastRow']; $x++) {
	
	$td = null;

	for ($y = 1; $y <= $data['limits']['lastCol']; $y++) {

		if (!empty($data['sits'][$x][$y])) {

			if ($data['sits'][$x][$y]['Sit']['state'] != 'En venta') {
				$sitImg = $this->MyHtml->image('sit_occupied.gif',
					array(
						'title' => __('Vendido', true)
					)
				);
			} else {
				$sitImg = $this->MyHtml->image(
					$data['sits'][$x][$y]['Sit']['icon'],
					array(
						'id'	=> $data['sits'][$x][$y]['Sit']['id'],
						'title' => $data['sits'][$x][$y]['Sit']['code'],
						'class'	=> 'sit cursor',
					)
				);
			}
			$td[] = $this->MyHtml->tag('td', $sitImg);

		} else {
			$td[] = $this->MyHtml->tag('td', '&nbsp;');
		}
	}
	$body[] = $this->MyHtml->tag('tr', $td);
}
$wide = ((!empty($wide)) ? 'wide' : '');
echo $this->MyHtml->tag('div',
	$this->MyHtml->tag('table', $body),
	array('id' => 'grid-sits', 'class' => $wide)
);
echo $this->MyHtml->tag('div', __('Escenario', true), array('class' => 'scenary'));

/*
if (!empty($wide) || empty($this->params['prefix'])) {
	echo $this->MyForm->create('Sell', array('action' => 'sell', 'class' => 'mainForm clear', 'id' => 'formEditor'));
	echo $this->MyForm->input('sits_ids', array('id' => 'sits_ids', 'type' => 'hidden'));
	echo $this->MyForm->input('step', array('type' => 'hidden', 'value' => 2));
	echo $this->element("footer", array('link' => 'sells/index', 'text' => __('Siguiente', true)));
}
*/
echo $this->MyHtml->scriptBlock(
	'$(document).ready(function($) {
		$(".sit").click(
			function() {
				if(!$(this).hasClass("selected")) {
					$(this).addClass("selected");
					$(this).attr("prev_src", $(this).attr("src"));
					$(this).attr("src", $.path(base_url + "img/sit_selected.gif"));
				} else {
					$(this).removeClass("selected");
					$(this).attr("src", $(this).attr("prev_src"));
				}
				return false;
			}
		);
		var ids = new Array();
		$(".btnSubmit").click(
			function() {
				$(".selected").each(
					function() {
						ids.push($(this).attr("id"));
					}
				);

				if (ids.lenght == 0) {
					alert("Seleccione al menos una butaca");
					return false;
				} else {
					ids.join("|")
					location.replace($.path("sells/sell/3/sits:" + ids.join("|")));
				}

				return false;
			}
		);

	});', array('inline' => false)
);