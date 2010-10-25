<div class="sits form">
<?php echo $this->MyForm->create('Sit');?>
	<fieldset>
 		<legend><?php __('Add Sit'); ?></legend>
	<?php
		echo $this->MyForm->input('location_id');
		echo $this->MyForm->input('event_id');
		echo $this->MyForm->input('code');
		echo $this->MyForm->input('Event');
	?>
	</fieldset>
<?php echo $this->MyForm->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->MyHtml->link(__('List Sits', true), array('action' => 'index'));?></li>
		<li><?php echo $this->MyHtml->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('List Events', true), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New Event', true), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>