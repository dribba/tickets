<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head profile="http://gmpg.org/xfn/11">
    <script type="text/javascript">
		var base_url = "<?php echo Router::url('/'); ?>";
	</script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>
      <?php echo $title_for_layout; ?>
    </title>
	 <?php
			echo $this->Html->css('skin/g');
			echo $this->Html->css('skin/l');
			echo $this->Html->css('skin/_sk/bk');
			echo $this->Html->css('skin/r');
			echo $this->Html->css('talleres');
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
						'base_url' => Router::url('/') . $prefix,
						'current_controller' => $this->params['controller'],
						'current_action' => $this->params['action']
				)
			);
      ?>
    <style type="text/css">
/*<![CDATA[*/
    div.c3 {display: block;}
    div.c2 {opacity: 0.85;}
    div.c1 {clear: both;}
    /*]]>*/
    </style>
  </head>
  <body>
    <div id="shadow">
      <div id="mainwrap">
        <div id="header">
          <!-- CATEGORY MENU -->
          <div id="nav2">
            <ul class="sf-menu sf-js-enabled sf-shadow">
              <li class="category_item">
                <a href="http://www.talleresdecordoba.com.ar/rdcs" id="home">Home</a>
              </li>
              <li class="cat-item cat-item-1">
                <a href="http://www.talleresdecordoba.com.ar/rdcs/category/ultimas-noticias/"
                title="Ver todas las entradas archivadas en Ultimas noticias">Ultimas noticias</a>
              </li>
            </ul>
          </div><!-- END CATEGORY MENU -->
          <div id="blogtitle">
            <h1>
              <a id="heading" href="http://www.talleresdecordoba.com.ar/rdcs/"><?php echo $this->MyHtml->image('blogtitle.png'); ?></a>
            </h1>
          </div>
          <!-- PAGE MENU -->
          <div id="top">
            <ul class="sf-menu sf-js-enabled sf-shadow">
              <?php

				$user = $this->Session->read('User');
				if (!empty($user)) {

					

					echo $this->MyHtml->tag('li',
						$this->MyHtml->link(__('Comprar entrada', true), array('controller' => 'sells', 'action' => 'sell'))
					);
					echo $this->MyHtml->tag('li',
						$this->MyHtml->link(__('Historial de compras', true), array('controller' => 'sells', 'action' => 'index'))
					);

					echo $this->MyHtml->tag('li',
						$this->MyHtml->link(__('Cambiar Contraseña', true), array('admin' => false, 'controller' => 'users', 'action' => 'change_password'))
					);

					echo $this->MyHtml->tag('li',
						$this->MyHtml->link(__('Salir', true), array('admin' => false, 'controller' => 'users', 'action' => 'logout'))
					);

				} else {
					echo $this->MyHtml->tag('li',
						$this->MyHtml->link(
							__('Recuperar contraseña', true),
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
            </ul><!-- END PAGE MENU -->
          </div>
        </div>
        <div class="c1"></div>
		<?php
				$message = explode('|', $this->Session->flash());
				if (!empty($message[0])) {
					echo $this->MyHtml->tag('div', $message[1], array('class' => 'message', 'id' => 'msg' . ucwords($message[0])));
				}
			?>
        <div id="contentwrap">
			
<!--          <div class="pbot post" id="post-20">
            <h2>
              <a href="http://www.talleresdecordoba.com.ar/rdcs/tarifas/" rel="bookmark" title=
              "Enlace permanente a Tarifas">Tarifas</a>
            </h2>
            <div class="meta"></div>
            <div class="entry"></div>
            <p class="postmetadata"></p>
          </div>-->
		  <?php echo $content_for_layout; ?>
		  <script type="text/javascript">
			var info = '<?php echo $info; ?>';
			<?php echo $this->Js->writeBuffer(); ?>
		  </script>
          <div class="navigation"></div>
        </div>
        <div class="in" id="sidebar2">
          <?php echo $this->MyHtml->image('sponsors.png'); ?>
        </div>
      </div>
    </div>
  </body>
</html>
