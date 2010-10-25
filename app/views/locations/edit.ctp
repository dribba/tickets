<div class="locations form">
<?php echo $this->MyForm->create('Location');?>
	<fieldset>
 		<legend><?php __('Edit Location'); ?></legend>
	<?php
		echo $this->MyForm->input('id');
		echo $this->MyForm->input('name');
	?>
	</fieldset>
<?php echo $this->MyForm->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->MyHtml->link(__('Delete', true), array('action' => 'delete', $this->MyForm->value('Location.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->MyForm->value('Location.id'))); ?></li>
		<li><?php echo $this->MyHtml->link(__('List Locations', true), array('action' => 'index'));?></li>
		<li><?php echo $this->MyHtml->link(__('List Sits', true), array('controller' => 'sits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New Sit', true), array('controller' => 'sits', 'action' => 'add')); ?> </li>
	</ul>
</div>