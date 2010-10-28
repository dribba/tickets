<html>
<head>

	<title><?php __('User'); ?></title>

	<?php
		echo $this->Html->css('smoothness/jquery-ui-1.8.1.custom');
		echo $this->Html->css('app.generic') . "\n";
		echo $this->Html->css('app.subject') . "\n";
		//echo $this->Html->css('app.user.jquery-ui/jquery-ui-1.8.2.custom');


		$jsFiles[] = 'jquery/jquery-1.4.2';
		$jsFiles[] = 'jquery/jquery-ui-1.8.1.custom';


		$jsFiles[] = 'default';
		$jsFiles[] = 'dialogs';
		$jsFiles[] = 'modals';
		
		echo $this->Html->script($jsFiles);

	?>
	
</head>
<body>

	<div id="page">

		<?php

		//echo $this->element('header', array('user' => $user));

		?>

		<div id="actions_bar">
			<div class="left">
				<?php
				$links = null;
				$links[] = $this->MyHtml->link(
					__('Obtener clave', true),
					array('controller' => 'users', 'action' => 'forgot_password'),
					array('title' => __('Obtener clave', true), 'class' => 'open_modal')
				);
				echo $this->element('actions', array('links' => $links));

				$links = null;
				$links[] = $this->MyHtml->link(
					__('Asociarse', true),
					array('controller' => 'wizards', 'action' => 'wizard', 'insert_document'),
					array('title' => __('Asociarse', true), 'class' => 'open_modal')
				);
				echo $this->element('actions', array('links' => $links));


				?>

				
			</div> <!-- left div-->

			<div class="right">

			</div> <!-- right div-->

		</div> <!-- actions_bar-->

		<div id="content_ext">
			<div id="content_for_layout">
				<div id="content">
					<?php echo $content_for_layout; ?>
				</div>
			</div>
		</div>

 	</div><!--page-->

	
	<script type="text/javascript">
	
		$(document).ready(function($) {

			/** Show flash message comming straight out from the controller */
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