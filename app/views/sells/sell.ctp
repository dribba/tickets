<?php

$this->set('title_for_layout', __('Compra de entrada', true));

$out[] = $this->MyForm->create('Sell', array('class' => 'mainForm clear', 'id' => 'formEditor'));
//$out[] = $this->MyHtml->tag(
//	'p',
//	$this->MyHtml->tag('span', '* ', array('class' => 'star')) .
//		__('Los campos marcados con asterisco son obligatorios', true),
//	array('id' => 'asterisk')
//);

//$content[] = $this->MyHtml->tag('legend', __('Seleccione ubicacion', true));
/**
############################################################################
# STEP 1
############################################################################
*/
$steps[1][] = $this->MyHtml->tag('legend', __('Seleccione ubicacion', true));
$steps[1][] = $this->element('plane', array('wizard' => 'Yes'));


/**
############################################################################
# STEP 2
############################################################################
*/
if ($step == 2) {

	$steps[2][] = $this->MyHtml->tag('legend', __('Detalles de la compra', true));
	$steps[2][] = $this->MyForm->input('Sell.sit_id',
		array(
			'type' 		=> 'hidden',
			'value' 	=> $sit,
		)
	);
	$steps[2][] = $this->MyForm->input('Sell.license_available',
		array(
			'options' 	=> array('Y' => __('Si', true), 'N' => __('No', true)),
			'label' 	=> __('Dispone de carnet', true)
		)
	);
	$steps[2][] = $this->MyForm->input('Sell.license_number',
		array(
			'label' 	=> __('Numero de carnet', true)
		)
	);
	
	$street[] = $this->MyHtml->tag('div',
		'Envio a domicilio, costo $20',
		array('class' => 'clear field')
	);
	$street[] = $this->MyHtml->tag('div',
		'Retirar en sede, costo $15',
		array('class' => 'clear field')
	);
	$street[] = $this->MyForm->input('Sell.send',
		array(
			'options' 	=> array('Y' => __('Si', true), 'N' => __('No', true)),
			'label' 	=> __('Enviar a domicilio', true)
		)
	);
	$street[] = $this->MyForm->input('Sell.street',
		array(
			'label' 	=> __('Direccion de envio', true)
		)
	);
	$street[] = $this->MyForm->input('Sell.horary',
		array(
			'label' 	=> __('Horario de envio', true)
		)
	);
	$steps[2][] = $this->MyHtml->tag('div',
		$street,
		array('id' => 'street')
	);


	$steps[2][] = $this->MyHtml->scriptBlock(
		'$(document).ready(function($) {
			$("#SellLicenseAvailable").click(
				function() {
					if ($(this).val() == "N") {
						$("#street").show();
						$("#SellLicenseNumber").parent().hide();
					} else {
						$("#street").hide();
						$("#SellLicenseNumber").parent().show();
					}
				}
			);
		});'
	);
}

/**
############################################################################
# STEP 3
############################################################################
*/
if ($step == 3) {

	$steps[3][] = $this->MyHtml->tag('legend', __('Opciones de pago', true));
	$steps[3][] = "<form action='https://argentina.dineromail.com/Shop/Shop_Ingreso.asp' method='post'>
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
					</form>";

}


$out[] = $this->MyForm->input('step',
	array(
		'type' 		=> 'hidden',
		'value' 	=> $step,
	)
);
foreach ($steps[$step] as $field) {
	$content[] = $field;
}



$out[] = $this->MyHtml->tag('fieldset', $content, array('class' => 'clear'));


//$out[] = $this->MyForm->end(__('Siguiente', true));
if ($step == 2) {
	$out[] = $this->element("footer", array('link' => 'sells/index', 'text' => __('Siguiente', true)));
}
$mainContent = $this->MyHtml->tag('div', $out);

echo $this->element('add', array('content' => $mainContent));