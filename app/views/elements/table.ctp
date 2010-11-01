<form action='https://argentina.dineromail.com/Shop/Shop_Ingreso.asp' method='post'>
<input type='hidden' name='NombreItem' value='Pagar'>
<input type='hidden' name='TipoMoneda' value='1'>
<input type='hidden' name='PrecioItem' value='100.00'>
<input type='hidden' name='E_Comercio' value='765202'>
<input type='hidden' name='NroItem' value='-'>
<input type='hidden' name='image_url' value='http://'>
<input type='hidden' name='DireccionExito' value='http://'>
<input type='hidden' name='DireccionFracaso' value='http://'>
<input type='hidden' name='DireccionEnvio' value='1'>
<input type='hidden' name='Mensaje' value='1'>
<input type='image' src='https://argentina.dineromail.com/imagenes/botones/pagar-medios_c.gif' border='0' name='submit' alt='Pagar con DineroMail'>
</form>



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
		alert("xxxcxz");
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
	
