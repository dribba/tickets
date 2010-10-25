<div class="events form">
<?php echo $this->MyForm->create('Event');?>
	<fieldset>
 		<legend><?php __('Add Event'); ?></legend>
	<?php
		echo $this->MyForm->input('name');
		echo $this->MyForm->input('start');
		echo $this->MyForm->input('end');
		echo $this->MyForm->input('comments');
		echo $this->MyForm->input('Sit');
	?>
	</fieldset>
<?php echo $this->MyForm->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->MyHtml->link(__('List Events', true), array('action' => 'index'));?></li>
		<li><?php echo $this->MyHtml->link(__('List Sits', true), array('controller' => 'sits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New Sit', true), array('controller' => 'sits', 'action' => 'add')); ?> </li>
	</ul>
</div>