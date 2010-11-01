<?php

/** The grid */
$header	= null;
$headers[] = __('Acciones', true);
$headers[] = __('Codigo', true);
$headers[] = __('Locacion', true);
$headers[] = __('Evento', true);

//$head = $this->MyHtml->tag('thead', $this->MyHtml->tableHeaders($headers));

$body = array();
$td = array();
//d($data);
//for ($y = $data['axis']['y']; $y >= 1; $y--) {


for ($x = 1; $x <= $data['limits']['lastRow']; $x++) {
	
	$td = null;

	for ($y = 1; $y <= $data['limits']['lastCol']; $y++) {

		if (!empty($data['sits'][$x][$y])) {

			if (!empty($data['sits'][$x][$y]['Sell']['id'])) {
				$sitImg = $this->MyHtml->image('sit_occupied.gif',
					array('title' => __('Vendido', true))
				);
			} else {
				$sitImg = $this->MyHtml->image(
					$data['sits'][$x][$y]['Sit']['icon'],
					array(
						'class' => 'sit',
						'title' => __('Comprar', true),
						'url' => array(
							'controller' 	=> 'sits',
							'action' 		=> 'view',
							$data['sits'][$x][$y]['Sit']['id']
						),
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

if ($body != null) {
    $body = implode("\n", $body);
} else {
    $body = '';
}

echo $this->MyHtml->tag('div',
	$this->MyHtml->tag('table', $body),
	array('id' => 'grid-sits')
);

echo $this->MyHtml->scriptBlock(
	'$(document).ready(function($) {
		$(".sit").hover(
			function() {
				$(this).attr("src", $.path(base_url + "img/ocupado.gif"));
			},
			function() {
				if(!$(this).hasClass("clicked")) {
					$(this).attr("src", $.path(base_url + "img/libre.gif"));
				}
			}
		);

		$(".sit").click(
			function() {
				if($(this).hasClass("clicked")) {
					$(this).attr("src", $.path(base_url + "img/libre.gif"));
					$(this).removeClass("clicked");
				} else {
					$(this).attr("src", $.path(base_url + "img/ocupado.gif"));
					$(this).addClass("clicked");
				}
				return false;
			}
		);
	});', array('inline' => false)
);
	
