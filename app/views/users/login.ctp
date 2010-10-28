<div class="users form">
<?php echo $this->Form->create('User', array('action' => 'login'));?>
	<fieldset>
		<legend><?php __('Login'); ?></legend>
	<?php
		echo $this->MyForm->input('username', array('label' => __('Documento', true)));
		echo $this->MyForm->input('password', array('label' => __('Contraseña', true)));

	?>
	
	</fieldset>
<?php echo $this->Form->end(__('Ingresar', true));?>
</div>