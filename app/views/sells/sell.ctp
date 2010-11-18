<?php

$this->set('title_for_layout', __('Compra de entrada', true));

$out[] = $this->MyForm->create('Sell', array('class' => 'mainForm clear', 'id' => 'formEditor'));

/**
############################################################################
# STEP 1
############################################################################
*/
$steps[1][] = $this->MyHtml->tag('legend', __('Seleccione un evento', true));
/*
$steps[1][] = $this->MyForm->input('Sell.event_id',
	array(
		'label' 	=> __('Evento', true)
	)
);
*/
if (!empty($events) && $step == 1) {
	$lis = array();
	foreach ($events as $event) {
		$lis[] = $this->MyHtml->tag('li',
			$this->MyHtml->image('event_' . $event['Event']['id'] . '.jpg',
				array(
					'class' 	=> 'event',
    				'event' 	=> $event['Event']['id'],
				)
			) . $this->MyHtml->tag('div', $event['Event']['comments'])
		);
	}
	$steps[1][] = $this->MyHtml->tag('ul', $lis, array('class' => 'events'));
}
$steps[1][] = $this->MyForm->input('Sell.event_id',
	array(
		'type'		=> 'hidden',
		'label' 	=> __('Evento', true)
	)
);

$steps[1][] = $this->MyHtml->scriptBlock(
	'$(document).ready(function($) {
		$(".event").hover(
			function() {
				$(this).addClass("border");
			},
			function() {
				$(this).removeClass("border");
			}
		);
		$(".event").bind("click", function() {

			$("#SellEventId").val($(this).attr("event"));
			$("#formEditor").submit();

		});
	});'
);



/**
############################################################################
# STEP 2
############################################################################
*/


$steps[2][] = $this->MyHtml->tag('legend', __('Seleccione ubicación', true));
$steps[2][] = $this->element('plane', array('wizard' => 'Yes', 'event_id' => (!empty($event_id) ? $event_id : '')));




/**
############################################################################
# STEP 3
############################################################################
*/
if ($step == 3) {

	$steps[3][] = $this->MyHtml->tag('legend', __('Detalles de la compra', true));
	$steps[3][] = $this->MyForm->input('Sell.license_available',
		array(
			'options' 	=> array('Y' => __('Si', true), 'N' => __('No', true)),
			'label' 	=> __('Dispone de carnet', true)
		)
	);

	
	$types[] = $this->MyHtml->tag('label', __('Tipo de carnet', true));
	$types[] = $this->MyHtml->image('nuevo.png', array('class' => 'cursor'));
	$types[] = $this->MyHtml->image('viejo.png', array('id' => 'antiguo', 'class' => 'cursor'));

	$steps[3][] = $this->MyHtml->tag('div', $types, array('id' => 'card_type', 'class' => 'field clear'));
	$steps[3][] = $this->MyForm->input('Sell.license_number',
		array(
			'label' 	=> __('Numero de carnet', true)
		)
	);
	
	$street[] = $this->MyHtml->tag('div',
		__('Envio a domicilio, costo $20', true),
		array('class' => 'clear field')
	);
	$street[] = $this->MyHtml->tag('div',
		__('Retirar en sede, costo $15', true),
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
	$steps[3][] = $this->MyHtml->tag('div',
		$street,
		array('id' => 'street')
	);


	$steps[3][] = $this->MyHtml->scriptBlock(
		'$(document).ready(function($) {
			$("#antiguo").click(
				function() {
					alert("' . __("Debe renovar su carnet de socio", true) . '");
					$("#SellLicenseAvailable").val("N");
					hideCardData();
				}
			);
			$(".cursor").click(
				function() {
					$(".cursor").css("border", "none");
					$(this).css("border", "2px solid #ccc");
				}
			);
			$("#SellLicenseAvailable").change(
				function() {
					if ($(this).val() == "N") {
						hideCardData();
					} else {
						$("#card_type").show();
						$("#street").hide();
						$("#SellLicenseNumber").parent().show();
					}
				}
			);
			function hideCardData() {
				$("#street").show();
				$("#SellLicenseNumber").parent().hide();
				$("#card_type").hide();
			}
			$("#btnSubmit").click(
				function() {
					
					if (!$("#SellTos").is(":checked")) {
						alert("Para continuar, debe aceptar los terminos y condiciones de compra");
						return false;
					}
				}
			);
			$("#SellSend").change(
				function() {
					$("#SellStreet").parent().toggle();
					$("#SellHorary").parent().toggle();
				}
			);

		});'
	);
	$steps[3][] = $this->MyHtml->tag('legend', __('Terminos y condiciones de compra', true));
	$steps[3][] = $this->MyHtml->tag('div', __('Acepto los Terminos y Condiciones de compra de …..........


Las Entradas son vendidas por "…................" (Empresa) en su carácter de mandatario, en nombre y representación de la Sala Teatral (Vendedor). El Vendedor es responsable del servicio, función o espectáculo o evento a realizarse, y define las condiciones de venta en todos los casos.


La Empresa no se responsabiliza por la suspensión o cancelación de la función, espectáculo o evento a realizarse, por cualquier causa, incluso las que respondan a caso fortuito o fuerza mayor. Si la fecha de un evento variara por alguna circunstancia las Entradas serán válidas para la fecha definitiva que fije el Vendedor. La Empresa no realiza ningún tipo de cambio, reintegro o devolución, las entradas adquiridas en boletería serán devueltas por el Vendedor. En tal caso el Vendedor, tendrá un plazo de 90 días desde la fecha estipulada del evento para la devolución del importe. La restitución será efectuada por el Vendedor en las condiciones, plazos y por las vías que él fije. Cada Entrada adquirida por ….......... a través de cualquiera de sus canales de venta está sujeta a un cargo por servicio, adicional al precio de la Entrada. La concreción de la compra está sujeta a la autorización de Empresa emisora de la Tarjeta de Crédito. El sistema de venta online ofrece localidades con el criterio del mejor lugar disponible al momento de realizar su compra y de acuerdo al sector seleccionado, entendiendo por tal a la ubicación más cercana al escenario y al pasillo central.



El Vendedor se reserva el derecho de agregar, quitar o sustituir artistas, variando los programas, precios y ubicaciones, así como la capacidad del auditorio. El Vendedor se reserva el derecho de admisión. En caso de llegar a la sala luego de comenzada la función, el espectador deberá aguardar al intervalo para poder ocupar su ubicación. Al ingresar a la sala el público estará sujeto a ser registrado conforme las disposiciones en vigor. En caso de negarse a dicho registro, no se admitirá la entrada al recinto. No será permitido el ingreso de cámaras de fotografía, grabadores, filmadoras, y cualesquiera otros dispositivos electrónicos digitales, ópticos y/o analógicos que permitan registrar imágenes y/o sonidos sobre cualquier soporte, pudiendo las mismas ser retiradas del lugar y destruido su contenido. El Vendedor solicita apagar todo equipo de radio llamada o teléfono celular antes del acceso a la sala.



El servicio de envío a domicilio es opcional y tiene un cargo adicional al del servicio de venta. Las Entradas son entregadas al titular de la tarjeta de crédito con la que se realizó la compra, quien deberá acreditarse mediante la presentación de su DNI, o bien al portador del email de confirmación de compra quien deberá presentar una fotocopia del DNI del titular de la tarjeta de crédito que realizó la compra. En caso de recibir sus Entradas en su domicilio recuerde guardarlas en un lugar seguro lejos del calor, humedad o de la luz solar. Plateanet no se responsabiliza por la integridad física de las Entradas ni realiza su reposición en caso de pérdida, robo o daño. Las Entradas no podrán ser utilizadas en ningún caso para su reventa y/o aplicación comercial o de promoción alguna sin previa autorización por escrito del Vendedor. Adopte los recaudos necesarios a fin asegurarse que su entrada sea auténtica, ya que de lo contrario podrá ser objeto de una acción judicial. Al momento de registrarse en nuestro sitio web, el usuario acepta que …......... envíe a su casilla de correo electrónico newsletters con promociones periódicas, hasta que el usuario indique lo contrario desuscribiéndose desde dicho email o destildando la opción en la pestaña “MIS DATOS” del panel de control del usuario.



La Empresa se encuentra inscripta dentro del régimen especial de emisión y almacenamiento electrónico de comprobantes en los términos provistos por las resoluciones generales Nº1361, sus modificatorias y complementarias, y Nº2177, con fecha de inscripción en el registro 01/10/2009. ', true), array('class' => 'tos'));

	$steps[3][] = $this->MyForm->input('Sell.tos',
		array(
			'label' 	=> __('Acepto los terminos y condiciones de compra', true),
   			'type'		=> 'checkbox',
			'checked' 	=> 1, 
			'div'		=> 'checkTos clear field'
		)
	);


}


/**
############################################################################
# STEP 4
############################################################################
*/
if ($step == 4) {

	$steps[4][] = $this->MyHtml->tag('legend', __('Resumen de la compra', true));
	$resume[] = $this->MyHtml->tag('dt',
		__('Ubicacion', true),
		array('class' => '')
	);
	$resume[] = $this->MyHtml->tag('dd',
		$data[0]['Location']['name'],
		array('class' => '')
	);
	
	foreach ($data as $sit) {
		$resume[] = $this->MyHtml->tag('dt',
			__('Butaca numero', true),
			array('class' => '')
		);
		$resume[] = $this->MyHtml->tag('dd',
			$sit['Sit']['code'],
			array('class' => '')
		);
	}

	$resume[] = $this->MyHtml->tag('dt',
		__('Precio unitario', true),
		array('class' => '')
	);
	$resume[] = $this->MyHtml->tag('dd',
		__('$', true) . $price,
		array('class' => '')
	);
	$resume[] = $this->MyHtml->tag('dt',
		__('Precio total', true),
		array('class' => '')
	);
	$resume[] = $this->MyHtml->tag('dd',
		__('$', true) . $price * sizeof($data),
		array('class' => '')
	);
	$sellData = $this->Session->read('sellData');
	$priceLicense = 0;
	if ($sellData['license_available'] == 'N') {
		$priceLicense = (($sellData['send'] == 'Y') ? '20' : '15');
	}
	if ($sellData['license_available'] == 'N') {
		$resume[] = $this->MyHtml->tag('dt',
			__('Costo del carnet', true),
			array('class' => '')
		);
		$resume[] = $this->MyHtml->tag('dd',
			__('$', true) . $priceLicense,
			array('class' => '')
		);
	}

	$total = ($price * sizeof($data)) + $priceLicense;
	$steps[4][] = $this->MyForm->input('Sell.total',
		array(
			'type' 		=> 'hidden',
			'value' 	=> $total,
		)
	);
	$steps[4][] = $this->MyForm->input('Sell.price',
		array(
			'type' 		=> 'hidden',
			'value' 	=> $price,
		)
	);
	$steps[4][] = $this->MyHtml->tag('dl', $resume, array('class' => 'view'));
	$steps[4][] = $this->MyHtml->tag('div',
		__('Costo total a pagar: $', true) . $total,
		array('class' => 'clear field alert')
	);
}

/**
############################################################################
# STEP 5
############################################################################
*/
if ($step == 5) {

	$steps[5][] = $this->MyHtml->tag('legend', __('Opciones de pago', true));
	$steps[5][] = "<form action='https://argentina.dineromail.com/Shop/Shop_Ingreso.asp' method='post'>
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


$next = false;
if ($step >= 3 && $step <= 4) {
	$next = true;
}
$out[] = $this->element('footer',
	array('link' => 'sells/index', 'text' => __('Siguiente', true), 'next' => $next)
);

$mainContent = $this->MyHtml->tag('div', $out, array('class' => 'position-relative'));

echo $this->element('add', array('content' => $mainContent));