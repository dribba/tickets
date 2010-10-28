<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('smoothness/jquery-ui-1.8.1.custom');

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
</head>
<body>
	<div id="main-container">
		<div id="header">
			<h1>
				<?php

				$user = $this->Session->read('User');
				if (!empty($user)) {

					if ($user['User']['type'] == 'admin') {

						echo $this->MyHtml->link(
							__('Eventos', true),
							array('admin' => true, 'controller' => 'events', 'action' => 'index')
						);

						echo $this->MyHtml->link(
							__('Locaciones', true),
							array('admin' => true, 'controller' => 'locations', 'action' => 'index')
						);

						echo $this->MyHtml->link(
							__('Butacas', true),
							array('admin' => true, 'controller' => 'sits', 'action' => 'index')
						);

						echo $this->MyHtml->link(
							__('Socios', true),
							array('admin' => true, 'controller' => 'users', 'action' => 'index')
						);

					} else {

						echo $this->MyHtml->link(__('Comprar entrada', true), array('controller' => 'sells', 'action' => 'sell'));

					}

					echo $this->MyHtml->link(__('Cambiar contrasena', true), array('admin' => false, 'controller' => 'users', 'action' => 'change_password'));

					echo $this->MyHtml->link(__('Salir', true), array('controller' => 'users', 'action' => 'logout', 'admin' => false));
				} else {
					echo $this->MyHtml->link(
						__('Recuperar contrasena', true),
						array('admin' => false, 'controller' => 'users', 'action' => 'forgot_password')
					);

					echo $this->MyHtml->link(
						__('Registrarse', true),
						array('admin' => false, 'controller' => 'users', 'action' => 'add')
					);
				}
				?>
			</h1>
		</div>
		<div id="content">

			<?php
				
				$message = explode('|', $this->Session->flash());
				if (!empty($message[0])) {
					echo $this->MyHtml->tag('div', $message[1], array('class' => 'message ' . $message[0]));
				}
			?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>

	<script type="text/javascript">
		var info = '<?php echo $info; ?>';
	</script>

</body>
</html>