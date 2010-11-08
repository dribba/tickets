
<!--<form action='https://argentina.dineromail.com/Shop/Shop_Ingreso.asp' method='post'>
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
-->


<?php

$body = array();

for ($x = 1; $x <= $data['limits']['lastRow']; $x++) {
	
	$td = null;

	for ($y = 1; $y <= $data['limits']['lastCol']; $y++) {

		if (!empty($data['sits'][$x][$y])) {
			$clase = ((strpos($data['sits'][$x][$y]['Sit']['icon'], 'blue') > 0) ? 'blue' : 'white');

			if (!empty($data['sits'][$x][$y]['Sell']['id'])) {
				$sitImg = $this->MyHtml->image('sit_occupied.gif',
					array(
						'title' => __('Vendido', true)
					)
				);
			} else {
				$sitImg = $this->MyHtml->image(
					$data['sits'][$x][$y]['Sit']['icon'],
					array(
						'class' => 'sit ' . $clase,
						'id'	=> $data['sits'][$x][$y]['Sit']['id'],
						'title' => __('Comprar', true),
						'url' => array(
							'controller' 	=> 'sells',
							'action' 		=> 'sell',
							2,
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
$wide = ((!empty($wide)) ? 'wide' : '');
echo $this->MyHtml->tag('div',
	$this->MyHtml->tag('table', $body),
	array('id' => 'grid-sits', 'class' => $wide)
);

if (!empty($wide) || empty($this->params['prefix'])) {
	echo $this->MyForm->create('Sell', array('action' => 'sell', 'class' => 'mainForm clear', 'id' => 'formEditor'));
	echo $this->MyForm->input('sits_ids', array('id' => 'sits_ids', 'type' => 'hidden'));
	echo $this->MyForm->input('step', array('type' => 'hidden', 'value' => 2));
	echo $this->element("footer", array('link' => 'sells/index', 'text' => __('Siguiente', true), 'id' => 'align-right'));
	if (!empty($wide)) {
		echo $this->element("footer", array('link' => 'sells/index', 'text' => __('Siguiente', true), 'id' => 'stepsNavigation'));
	}
}
echo $this->MyHtml->scriptBlock(
	'$(document).ready(function($) {
		$(".sit").click(
			function() {
				if(!$(this).hasClass("selected")) {
					$(this).addClass("selected");
					$(this).attr("src", $.path(base_url + "img/sit_selected.gif"));
				} else {
					$(this).removeClass("selected");
					if($(this).hasClass("blue")) {
						$(this).attr("src", $.path(base_url + "img/sit_blue.gif"));
					} else {
						$(this).attr("src", $.path(base_url + "img/sit_white.gif"));
					}
				}
				//alert($(".selected").length);
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
				$("#sits_ids").val(ids);
				if ($("#sits_ids").val() == "") {
					alert("Seleccione al menos una butaca");
					return false;
				}
			}
		);

	});', array('inline' => false)
);
	
