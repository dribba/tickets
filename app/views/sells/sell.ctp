<?php

$this->set('title_for_layout', __('Compra de entrada', true));


/**
############################################################################
# STEP 1
############################################################################
*/

if ($step == 1) {

	$steps[$step][] = $this->MyHtml->tag('legend', __('Seleccione un evento', true));

	$lis = array();
	if (!empty($events)) {
		foreach ($events as $event) {
			$lis[] = $this->MyHtml->tag('li',
				$this->MyHtml->image(
					empty($event['Event']['uuid_image'])?'logo.png':$event['Event']['uuid_image'],
					array(
						'class' 	=> 'event',
						'url'		=> array(
							'controller'	=> 'sells',
							'action'		=> 'sell',
							$step,
							'event' 		=> $event['Event']['id'],
							'site' 			=> $event['Event']['site_id'],
						),
					)
				) . $this->MyHtml->tag('div', $event['Event']['comments'])
			);
		}
	}

	$steps[$step][] = $this->MyHtml->tag('ul', $lis, array('class' => 'events'));
	$steps[$step][] = $this->MyForm->input('Sell.event_id',
		array(
			'type'		=> 'hidden'
		)
	);
	$steps[$step][] = $this->MyForm->input('Sell.site_id',
		array(
			'type'		=> 'hidden'
		)
	);

	$steps[$step][] = $this->MyHtml->scriptBlock(
		'$(document).ready(function($) {
			$(".event").hover(
				function() {
					$(this).addClass("border");
				},
				function() {
					$(this).removeClass("border");
				}
			);
		});'
	);

} // step 1



/**
############################################################################
# STEP 2
############################################################################
*/

if ($step == 2) {
	$steps[$step][] = $this->MyHtml->tag('legend', __('Seleccione ubicación', true));
	$steps[$step][] = $this->element('plane', array('href' => 'sells/sell/2/location:'));
} //step 2



/**
############################################################################
# STEP 3
############################################################################
*/
if ($step == 3) {
	$steps[$step][] = $this->MyHtml->tag('legend', __('Seleccione la butaca', true));
	$steps[$step][] = $this->requestAction(
		vsprintf('%s/%s/%s/%s',
			array(
				'controller'	=> 'locations',
				'action'		=> 'view',
				$sellData['Location']['id'],
				$sellData['event_id']
			)
		),
		array('return')
	);
} //step 3


/**
############################################################################
# STEP 4
############################################################################
*/
if ($step == 4) {

	$steps[$step][] = $this->MyHtml->tag('legend', __('Detalles de la compra', true));

	$steps[$step][] = $this->MyForm->create('Sell',
		array(
			'action' 	=> 'sell/4',
			'class' 	=> 'mainForm clear',
			'id' 		=> 'formEditor'
		)
	);

	$steps[$step][] = $this->MyForm->input('Sell.license_available',
		array(
			'options' 	=> array(__('Si', true) => __('Si', true), __('No', true) => __('No', true)),
			'label' 	=> __('Dispone de carnet', true)
		)
	);

	
	$types[] = $this->MyHtml->tag('label', __('Qué carnet?', true));
	$types[] = $this->MyHtml->image('nuevo.png', array('class' => 'cursor'));
	$types[] = $this->MyHtml->image('viejo.png', array('id' => 'antiguo', 'class' => 'cursor'));

	$steps[$step][] = $this->MyHtml->tag('div', $types, array('id' => 'card_type', 'class' => 'field clear'));
	$steps[$step][] = $this->MyForm->input('Sell.license_number',
		array(
			'label' 	=> __('Número de carnet', true)
		)
	);
	
	$street[] = $this->MyHtml->tag('div',
		__('Envio a domicilio, costo $ 20', true),
		array('class' => 'clear field')
	);
	$street[] = $this->MyHtml->tag('div',
		__('Retira en la sede, costo $ 15', true),
		array('class' => 'clear field')
	);
	$street[] = $this->MyForm->input('Sell.send',
		array(
			'options' 	=> array(__('Si', true) => __('Si', true), __('No', true) => __('No', true)),
			'default'	=> __('No', true),
			'label' 	=> __('Enviar a domicilio', true)
		)
	);
	$street[] = $this->MyForm->input('Sell.street',
		array(
			'label' 	=> __('Dirección de envio', true)
		)
	);
	$street[] = $this->MyForm->input('Sell.horary',
		array(
			'label' 	=> __('Horario de envio', true)
		)
	);
	$steps[$step][] = $this->MyHtml->tag('div',
		$street,
		array('id' => 'street')
	);


	$steps[$step][] = $this->MyHtml->scriptBlock(
		'$(document).ready(function($) {

			$("#antiguo").click(
				function() {
					alert("' . __("Debe renovar su carnet de socio", true) . '");
					$("#SellLicenseAvailable").val("No");
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
					if ($(this).val() == "No") {
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

			$("#formEditor").submit(
				function() {
					
					if (!$("#SellTos").is(":checked")) {
						alert("Para continuar, debe aceptar los terminos y condiciones de compra");
						return false;
					}

					if ($("#SellLicenseAvailable").val() == "Si" && $("#SellLicenseNumber").val() == "") {
						alert("Para continuar, debe ingresar el número de su carnet");
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
	$steps[$step][] = $this->MyHtml->tag('legend', __('Terminos y condiciones de compra', true));
	$steps[$step][] = $this->MyHtml->tag('div', __('Acepto los Terminos y Condiciones de compra de …..........


Las Entradas son vendidas por "…................" (Empresa) en su carácter de mandatario, en nombre y representación de la Sala Teatral (Vendedor). El Vendedor es responsable del servicio, función o espectáculo o evento a realizarse, y define las condiciones de venta en todos los casos.


La Empresa no se responsabiliza por la suspensión o cancelación de la función, espectáculo o evento a realizarse, por cualquier causa, incluso las que respondan a caso fortuito o fuerza mayor. Si la fecha de un evento variara por alguna circunstancia las Entradas serán válidas para la fecha definitiva que fije el Vendedor. La Empresa no realiza ningún tipo de cambio, reintegro o devolución, las entradas adquiridas en boletería serán devueltas por el Vendedor. En tal caso el Vendedor, tendrá un plazo de 90 días desde la fecha estipulada del evento para la devolución del importe. La restitución será efectuada por el Vendedor en las condiciones, plazos y por las vías que él fije. Cada Entrada adquirida por ….......... a través de cualquiera de sus canales de venta está sujeta a un cargo por servicio, adicional al precio de la Entrada. La concreción de la compra está sujeta a la autorización de Empresa emisora de la Tarjeta de Crédito. El sistema de venta online ofrece localidades con el criterio del mejor lugar disponible al momento de realizar su compra y de acuerdo al sector seleccionado, entendiendo por tal a la ubicación más cercana al escenario y al pasillo central.



El Vendedor se reserva el derecho de agregar, quitar o sustituir artistas, variando los programas, precios y ubicaciones, así como la capacidad del auditorio. El Vendedor se reserva el derecho de admisión. En caso de llegar a la sala luego de comenzada la función, el espectador deberá aguardar al intervalo para poder ocupar su ubicación. Al ingresar a la sala el público estará sujeto a ser registrado conforme las disposiciones en vigor. En caso de negarse a dicho registro, no se admitirá la entrada al recinto. No será permitido el ingreso de cámaras de fotografía, grabadores, filmadoras, y cualesquiera otros dispositivos electrónicos digitales, ópticos y/o analógicos que permitan registrar imágenes y/o sonidos sobre cualquier soporte, pudiendo las mismas ser retiradas del lugar y destruido su contenido. El Vendedor solicita apagar todo equipo de radio llamada o teléfono celular antes del acceso a la sala.



El servicio de envío a domicilio es opcional y tiene un cargo adicional al del servicio de venta. Las Entradas son entregadas al titular de la tarjeta de crédito con la que se realizó la compra, quien deberá acreditarse mediante la presentación de su DNI, o bien al portador del email de confirmación de compra quien deberá presentar una fotocopia del DNI del titular de la tarjeta de crédito que realizó la compra. En caso de recibir sus Entradas en su domicilio recuerde guardarlas en un lugar seguro lejos del calor, humedad o de la luz solar. Plateanet no se responsabiliza por la integridad física de las Entradas ni realiza su reposición en caso de pérdida, robo o daño. Las Entradas no podrán ser utilizadas en ningún caso para su reventa y/o aplicación comercial o de promoción alguna sin previa autorización por escrito del Vendedor. Adopte los recaudos necesarios a fin asegurarse que su entrada sea auténtica, ya que de lo contrario podrá ser objeto de una acción judicial. Al momento de registrarse en nuestro sitio web, el usuario acepta que …......... envíe a su casilla de correo electrónico newsletters con promociones periódicas, hasta que el usuario indique lo contrario desuscribiéndose desde dicho email o destildando la opción en la pestaña “MIS DATOS” del panel de control del usuario.



La Empresa se encuentra inscripta dentro del régimen especial de emisión y almacenamiento electrónico de comprobantes en los términos provistos por las resoluciones generales Nº1361, sus modificatorias y complementarias, y Nº2177, con fecha de inscripción en el registro 01/10/2009. ', true),
		array('class' => 'tos')
	);

	$steps[$step][] = $this->MyForm->input('Sell.tos',
		array(
			'label' 	=> __('Acepto los terminos y condiciones de compra', true),
   			'type'		=> 'checkbox',
			'checked' 	=> 1, 
			'div'		=> 'checkTos clear field'
		)
	);

} // step 4


/**
############################################################################
# STEP 5
############################################################################
*/
if ($step == 5) {

	$steps[$step][] = $this->MyHtml->tag('legend', __('Resumen de la compra', true));
	$resume[] = $this->MyHtml->tag('dt',
		__('Ubicación', true)
	);

	$resume[] = $this->MyHtml->tag('dd',
		$sellData['Location']['name']
	);

	foreach ($sellData['sits'] as $sit) {

		$resume[] = $this->MyHtml->tag('dt',
			__('Butaca número', true)
		);
		$resume[] = $this->MyHtml->tag('dd',
			sprintf('%s ---> $ %s', $sit['Sit']['code'], $sit['Sit']['price'])
		);
	}

	$resume[] = $this->MyHtml->tag('dt',
		__('Sub-Total', true)
	);

	$resume[] = $this->MyHtml->tag('dd',
		'$ ' . $sellData['sub_total']
	);

	if ($sellData['license_available'] == 'No') {
		$resume[] = $this->MyHtml->tag('dt',
			__('Costo del carnet', true)
		);
		$resume[] = $this->MyHtml->tag('dd',
			'$ ' . $sellData['license_price']
		);
	}

	$steps[$step][] = $this->MyHtml->tag('dl', $resume, array('class' => 'view'));
	$steps[$step][] = $this->MyHtml->tag('div',
		'<br/><br/>' . __('Costo total a pagar: $ ', true) . $sellData['total'],
		array('class' => 'clear field alert')
	);


	$data['NombreItem'] = 'entrada';
	$data['TipoMoneda'] = '1';
	$data['PrecioItem'] = $sellData['total'];
	$data['E_Comercio'] = '765202';
	$data['NroItem'] = 'xxxxxxxxxxxxxxxxxxxxx';
	$data['image_url'] = '';
	$data['DireccionExito'] = 'x';
	$data['DireccionFracaso'] = 'x';
	$data['DireccionEnvio'] = '0';
	$data['Mensaje'] = '1';

	$data['MediosPago'] = '4,5,6,14,15,16,17,18';
	$payments[] = $this->MyHtml->tag('li',
		$this->MyHtml->link($this->MyHtml->image('payment_credit_card.png', array('title' => __('Tarjeta de Crédito', true))), vsprintf('https://argentina.dineromail.com/Shop/Shop_Ingreso.asp?NombreItem=%s&TipoMoneda=%s&PrecioItem=%s&E_Comercio=%s&NroItem=%s&image_url=%s&DireccionExito=%s&DireccionFracaso=%s&DireccionEnvio=%s&Mensaje=%s&MediosPago=%s', $data), array('target' => '_BLANK', 'class' => 'payment', 'payment' => 'card', 'escape' => false))
	);
	$data['MediosPago'] = '18,2';
	$payments[] = $this->MyHtml->tag('li',
		$this->MyHtml->link($this->MyHtml->image('payment_cash.png', array('title' => __('Pago Facil / Rapi-Pago', true))), vsprintf('https://argentina.dineromail.com/Shop/Shop_Ingreso.asp?NombreItem=%s&TipoMoneda=%s&PrecioItem=%s&E_Comercio=%s&NroItem=%s&image_url=%s&DireccionExito=%s&DireccionFracaso=%s&DireccionEnvio=%s&Mensaje=%s&MediosPago=%s', $data), array('target' => '_BLANK', 'class' => 'payment', 'payment' => 'cash', 'escape' => false))
	);
	$data['MediosPago'] = '18,13';
	$payments[] = $this->MyHtml->tag('li',
		$this->MyHtml->link($this->MyHtml->image('payment_transfer.png', array('title' => __('Transferencia Bancaria', true))), vsprintf('https://argentina.dineromail.com/Shop/Shop_Ingreso.asp?NombreItem=%s&TipoMoneda=%s&PrecioItem=%s&E_Comercio=%s&NroItem=%s&image_url=%s&DireccionExito=%s&DireccionFracaso=%s&DireccionEnvio=%s&Mensaje=%s&MediosPago=%s', $data), array('target' => '_BLANK', 'class' => 'payment', 'payment' => 'transfer', 'escape' => false))
	);
	$steps[$step][] = '<br/><br/>';
	$r[] = $this->MyHtml->tag('dt', 'Pagar con:');
	$r[] = $this->MyHtml->tag('dd', $this->MyHtml->tag('ul', $payments));
	$steps[$step][] = $this->MyHtml->tag('dl', $r, array('class' => 'view'));

	$steps[$step][] = $this->MyHtml->scriptBlock(
		'$(document).ready(function($) {
			$(".payment").click(
				function() {
					$.ajax({
						url: $.path("sells/sell/5/payment:" + $(".payment").attr("payment")),
						success: function(data) {
							//console.log(data);
						}
					});
				}
			);
		});'
	);


}


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