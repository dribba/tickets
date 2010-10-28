<?php

$out[] = $this->MyForm->create("Sell", array("class" => "ajax_form"));

$content[] = $this->MyForm->input('Sell.location',
	array(
		'label' 	=> __('Entrada', true),
		'default'	=> 3
	)
);
$content[] = $this->MyForm->input('Sell.sit_id',
	array(
		'label' 	=> __('Butaca', true)
	)
);
$content[] = $this->MyForm->input('Sell.carnet',
	array(
		'options' 	=> array('Y' => __('Si', true), 'N' => __('No', true)),
		'default' 	=> 'N',
		'label' 	=> 'Posee carnet'
	)
);
$content[] = $this->MyForm->input('Sell.number', array('label' => __('Numero de carnet', true)));

$street[] = $this->MyForm->input('Sell.street', array('label' => __('Direccion de entrega', true)));
$street[] = $this->MyForm->input('Sell.horario', array('label' => __('Horario de entrega', true)));
$street[] = $this->MyHtml->tag('label', __('Costo con envio a domicilio $20', true));
$street[] = $this->MyHtml->tag('label', __('Costo retirando en sede $15', true));
$street[] = $this->MyForm->input('Sell.send',
	array(
		'options' 	=> array('Y' => __('Si', true), 'N' => __('No', true)),
		'default' => 'Y',
		'label' => 'Enviar a domicilio'
	)
);

$content[] = $this->MyHtml->tag('div', $street, array('id' => 'street'));
$content[] = $this->MyForm->input('Sell.option',
	array(
		'options' 	=> array('rapipago' => __('Rapi Pago', true), 'pagofacil' => __('Pago Facil', true), 'tarjeta' => __('Tarjeta de credito', true)),
		'default' => 'rapipago',
		'label' => 'Opciones de pago'
	)
);

$out[] = $this->MyHtml->tag('div', $content, array('id' => 'container'));


$out[] = $this->element("footer");
$out[] = $this->MyForm->end();

echo $myHtml->out($out);

echo $this->MyHtml->scriptBlock(
	'$(document).ready(function($) {
		checkCombo();
		$("#SellLocation").change(function() {
			if ($(this).val() == 1) {
				$("#SellSitId").parent().hide();
			} else {
				$("#SellSitId").parent().show();
			}
		});
		$("#SellCarnet").change(function() {
			checkCombo();
		});
		function checkCombo() {
			if ($("#SellCarnet").val() == "N") {
				$("#SellNumber").parent().hide();
				$("#street").show();
			} else {
				$("#SellNumber").parent().show();
				$("#street").hide();
			}
		}

	});'
);