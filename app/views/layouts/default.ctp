<html xmlns="http://www.w3.org/1999/xhtml" lang="en" dir="ltr">
  <head>
	<script type="text/javascript">
		var base_url = "<?php echo Router::url('/'); ?>";
	</script>
    <title>
      <?php echo $title_for_layout; ?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="" />
    <?php
		echo $this->Html->css('skin/g');
		echo $this->Html->css('skin/l');
		echo $this->Html->css('skin/_sk/bk');
		echo $this->Html->css('skin/r');
		//echo $this->Html->css('smoothness/jquery-ui-1.8.1.custom');
		echo $this->Html->css('anytime/anytimec');
		//echo $this->Html->css('app.generic');

		$jsFiles[] = 'jquery/jquery-1.4.3.min';
		//$jsFiles[] = 'jquery/jquery-ui-1.8.1.custom';
		$jsFiles[] = 'jquery/jquery.maphilight';
		$jsFiles[] = 'anytime/anytimec';
		$jsFiles[] = 'default';
		echo $this->Html->script($jsFiles);

		echo $scripts_for_layout;

		$prefix = ((!empty($this->params['prefix'])) ? $this->params['prefix'] . '/' : '');
		$info = json_encode(
			array(
				'base_url'				=> Router::url('/') . $prefix,
				'current_controller' 	=> $this->params['controller'],
				'current_action' 		=> $this->params['action']
			)
		);
		/*
		<script type='text/javascript'>
var loader= new Loader("#img-encabezado", {showProgress:true, showProgressText:true, textSize:15});
	loader.Start();
AnyTime.picker( "fecha",
      { format: "%d/%m/%Z", dayAbbreviations:["Dom","Lun","Mar","Mie","Jue","Vie","Sab"],labelDayOfMonth:"Dia",labelMonth:"Mes",firstDOW: 0,labelTitle: "Seleccionar fecha",monthAbbreviations:["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"] } );
  $("#hora").AnyTime_picker(
      { format: "%H:%i", labelTitle: "Hora",
        labelHour: "Hora", labelMinute: "Minuto" } );/*

	?>
    <meta charset="UTF-8" />
  </head>
  <body id="pageTable" class="withoutSubnav">
    <div id="wrapper">
      <div id="top">
        <div id="title" class="clear">
          <span class="name">TALLERES</span> | <span><?php echo __('ADMINISTRACIÓN', true); ?></span>
        </div>
        <div id="menu" class="clear">
          <ul>
            <?php

				$user = $this->Session->read('User');
				if (!empty($user)) {

					if ($user['User']['type'] == 'admin') {

						echo $this->MyHtml->tag('li',
							$this->MyHtml->link(
								__('Sitios', true),
								array('admin' => true, 'controller' => 'sites', 'action' => 'index')
							)
						);

						echo $this->MyHtml->tag('li',
							$this->MyHtml->link(
								__('Ubicaciones', true),
								array('admin' => true, 'controller' => 'locations', 'action' => 'index')
							)
						);

						echo $this->MyHtml->tag('li',
							$this->MyHtml->link(
								__('Butacas', true),
								array('admin' => true, 'controller' => 'sits', 'action' => 'index')
							)
						);

						echo $this->MyHtml->tag('li',
							$this->MyHtml->link(
								__('Eventos', true),
								array('admin' => true, 'controller' => 'events', 'action' => 'index')
							)
						);

						echo $this->MyHtml->tag('li',
							$this->MyHtml->link(
								__('Usuarios', true),
								array('admin' => true, 'controller' => 'users', 'action' => 'index')
							)
						);

					} else {

						echo $this->MyHtml->tag('li',
							$this->MyHtml->link(__('Comprar entrada', true), array('controller' => 'sells', 'action' => 'sell'))
						);

					}

					echo $this->MyHtml->tag('li',
						$this->MyHtml->link(__('Cambiar Contraseña', true), array('admin' => false, 'controller' => 'users', 'action' => 'change_password'))
					);

					
				} else {
					echo $this->MyHtml->tag('li',
						$this->MyHtml->link(
							__('Recuperar contrasena', true),
							array('admin' => false, 'controller' => 'users', 'action' => 'forgot_password')
						)
					);

					echo $this->MyHtml->tag('li',
						$this->MyHtml->link(
							__('Registrarse', true),
							array('admin' => false, 'controller' => 'users', 'action' => 'register')
						)
					);
				}
			?>
          </ul>
        </div>
        <div id="toolbar" class="clear">
          <p id="user">
            <?php
				echo __('Usuario: ', true) . '<a>' . User::get('/User/full_name') . '</a>';
			?>
          </p>
          <div id="buttons">
			<?php
				echo $this->MyHtml->link(
					__('Salir', true),
					array('admin' => false, 'controller' => 'users', 'action' => 'logout'),
					array('class' => 'button tool')
				);
			?>
          </div>
        </div>
      </div>
      <div id="content" class="clear">
        <?php echo $content_for_layout; ?>

      </div>

		<script type="text/javascript">
 			var info = '<?php echo $info; ?>';
			<?php echo $this->Js->writeBuffer(); ?>
		</script>

      <div id="push">

      </div>
    </div>
    <div id="footer">
      <div id="wrapFooter">
        <p id="copyright">
			&nbsp;
        </p>
        <p id="author">
			&nbsp;
        </p>
      </div>
    </div>
	<?php echo $this->element('sql_dump'); ?>
  </body>
</html>

