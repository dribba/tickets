<div class="users form">
<?php echo $this->MyForm->create('User');?>
	<fieldset>
 		<legend><?php __('Edit User'); ?></legend>
	<?php
		echo $this->MyForm->input('id');
		echo $this->MyForm->input('username');
		echo $this->MyForm->input('password');
		echo $this->MyForm->input('last_login');
		echo $this->MyForm->input('full_name');
		echo $this->MyForm->input('email');
		echo $this->MyForm->input('type');
	?>
	</fieldset>
<?php echo $this->MyForm->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->MyHtml->link(__('Delete', true), array('action' => 'delete', $this->MyForm->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->MyForm->value('User.id'))); ?></li>
		<li><?php echo $this->MyHtml->link(__('List Users', true), array('action' => 'index'));?></li>
	</ul>
</div>