<div class="sells form">
<?php echo $this->MyForm->create('Sell');?>
	<fieldset>
 		<legend><?php __('Edit Sell'); ?></legend>
	<?php
		echo $this->MyForm->input('id');
		echo $this->MyForm->input('user_id');
		echo $this->MyForm->input('location');
	?>
	</fieldset>
<?php echo $this->MyForm->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->MyHtml->link(__('Delete', true), array('action' => 'delete', $this->MyForm->value('Sell.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->MyForm->value('Sell.id'))); ?></li>
		<li><?php echo $this->MyHtml->link(__('List Sells', true), array('action' => 'index'));?></li>
		<li><?php echo $this->MyHtml->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('List Events Sits', true), array('controller' => 'events_sits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New Events Sit', true), array('controller' => 'events_sits', 'action' => 'add')); ?> </li>
	</ul>
</div>