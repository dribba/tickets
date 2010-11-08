<div id="header">
	<div id="logo">
		<?php echo $this->MyHtml->image('logo.png') . "\n"; ?>
	</div>
	<div id="info">
		<div id="login_date">
			<div class="left"><?php echo date('d-m-Y'); ?></div>
			<div class="right"></div>
		</div>

		<div id="login_info">
			<?php
				echo $this->MyHtml->tag('div', User::get('/User/full_name'), 'top');
				echo $this->MyHtml->image('change_password.png');
				echo $this->MyHtml->tag('div', __('Last Login', true) . ': ' . User::get('/User/last_login'), 'bottom');
			?>
		</div>

		<div id="login_actions">
			<div class="left">

			</div>
			<div class="right">
				<?php echo $this->MyHtml->link(
					__('Exit', true),
					array(
						'controller' 	=> 'users',
						'action' 		=> 'logout'
					),
					array('class' => 'button'),
					__('Are you sure you want to leave the App?', true));
				?>
			</div>
		</div>
	</div><!--info-->
</div><!--header-->
