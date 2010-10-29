<div class="users">
<?php
	echo $this->Form->create('User', array('action' => 'login'));
?>
	<fieldset>
		<legend><?php __('Ingresar'); ?></legend>
	<?php
		echo $this->MyForm->input('username', array('label' => __('Username', true), 'div' => 'field'));
		echo $this->MyForm->input('password', array('label' => __('Password', true), 'div' => 'field'));
	?>
	</fieldset>
<?php

	echo $this->MyHtml->tag('div',
		$this->MyForm->submit(
			__('Ingresar', true),
			array('class' => 'button primary', 'id' => 'save', 'div' => false)
		),
		array('id' => 'loginActions')
	);


	$this->Form->end();
?>
</div>