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

		$jsFiles[] = 'jquery/jquery-1.4.3.min';
		$jsFiles[] = 'jquery/jquery-ui-1.8.1.custom';
		$jsFiles[] = 'default';
		echo $this->Html->script($jsFiles);

		echo $scripts_for_layout;

		$info = json_encode(
			array(
				'base_url'				=> Router::url('/'),
				'current_controller' 	=> $this->params['controller'],
				'current_action' 		=> $this->params['action']
			)
		);

	?>
    <meta charset="UTF-8" />
  </head>
  <body id="pageTable" class="withoutSubnav">
    <div id="wrapper">
      <div id="top">
        <div id="title" class="clear">
          <a href="#"><?php echo __('TALLERES', true); ?></a> <span>| <?php echo __('ADMINISTRACION', true); ?></span>
        </div>
        <div id="menu" class="clear">
          <ul>
            <?php

				$user = $this->Session->read('User');
				if (!empty($user)) {

					if ($user['User']['type'] == 'admin') {

						echo $this->MyHtml->tag('li',
							$this->MyHtml->link(
								__('Eventos', true),
								array('admin' => true, 'controller' => 'events', 'action' => 'index')
							)
						);

						echo $this->MyHtml->tag('li',
							$this->MyHtml->link(
								__('Locaciones', true),
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
						$this->MyHtml->link(__('Cambiar contrasena', true), array('admin' => false, 'controller' => 'users', 'action' => 'change_password'))
					);

					echo $this->MyHtml->tag('li',
						$this->MyHtml->link(__('Salir', true), array('controller' => 'users', 'action' => 'logout', 'admin' => false))
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
            <?php echo __('Usuario: ', true); ?> <a href="#"><?php echo User::get('/User/full_name');?></a>
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
  </body>
</html>
