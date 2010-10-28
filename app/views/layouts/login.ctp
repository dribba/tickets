<html>
<head>

	<title><?php __('Login'); ?></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<?php 
		echo $this->Html->css('smoothness/jquery-ui-1.8.1.custom');
		echo $this->Html->css('app.login') . "\n"; 


		$jsFiles[] = 'jquery/jquery-1.4.2';
		$jsFiles[] = 'jquery/jquery-ui-1.8.1.custom';

		$jsFiles[] = 'default';
		$jsFiles[] = 'dialogs';
		echo $this->Html->script($jsFiles);

		
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

	<div id="page">

		<div id="login">
				
				<div id="content_for_layout">
					<?php echo $content_for_layout; ?>
				</div>
				<div id="links">
				<?php
				$links = null;
				$links[] = $this->MyHtml->link(
					__('Recuperar contraseña', true),
					array('user' => false, 'controller' => 'users', 'action' => 'forgot_password'),
					array('class' => 'open_modal')
				);
				echo $this->element('actions', array('links' => $links));
				$links = null;
				$links[] = $this->MyHtml->link(
					__('Asociarse', true),
					array('user' => false, 'controller' => 'wizards', 'action' => 'wizard', 'insert_document'),
					array('class' => 'open_modal')
				);
				echo $this->element('actions', array('links' => $links));
				

				?>
				</div>
		</div>
	</div>
	
	<script type="text/javascript">
	
		var info = '" . <?php echo $info; ?> . "';
		$(document).ready(function($) {
			
				/* Show flash message comming straight out from the controller */
				var flashMessage = '<?php echo str_replace("'", "\'", $this->Session->flash()); ?>';
				if (flashMessage != '') {
					var flashMessageData = flashMessage.split('|');
					if (flashMessageData[0] == 'SUCCESS') {
						dialogs.showSuccess(flashMessageData[1]);
					} else if (flashMessageData[0] == 'ERROR') {
						dialogs.showError(flashMessageData[1]);
					}
				}
				
		}); //$(document).ready
	</script>
		
	<?php echo $scripts_for_layout; ?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>