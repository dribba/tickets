<?php

/** The grid */
$header	= null;
$headers[] = __("Acciones", true);
$headers[] = __("Codigo", true);
$headers[] = __("Locacion", true);
$headers[] = __("Evento", true);

//$head = $this->MyHtml->tag('thead', $this->MyHtml->tableHeaders($headers));

$body = array();
$td = array();
for ($y = $data['axis']['y']; $y >= 1; $y--) {
	
	for ($x = 1; $x <= $data['axis']['x']; $x++) {
		foreach ($data['sits'] as $sit) {
			$sitImg = $this->MyHtml->image(
				'libre.gif',
				array(
					'class' => 'sit',
					'title' => __('Ver', true) . ' ' . $sit['Sit']['code'],
					'url' => array(
						'controller' 	=> 'sits',
						'action' 		=> 'view',
						$sit['Sit']['id']
					),
				)
			);
			if ($sit['Sit']['x'] == $x && $sit['Sit']['y'] == $y) {
				$td[] = $this->MyHtml->tag('td', $sitImg);
				$encontro = true;
			} else {
				$encontro = false;
			}
		}
		if (!$encontro && sizeof($td) < $x) {
			$td[] = $this->MyHtml->tag('td', '&nbsp;');
		}
	}
	$body[] = $this->MyHtml->tag('tr', $td);
	$td = null;
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
	
