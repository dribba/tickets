<div class="eventsSits form">
<?php echo $this->MyForm->create('EventsSit');?>
	<fieldset>
 		<legend><?php __('Edit Events Sit'); ?></legend>
	<?php
		echo $this->MyForm->input('id');
		echo $this->MyForm->input('event_id');
		echo $this->MyForm->input('sit_id');
		echo $this->MyForm->input('state');
		echo $this->MyForm->input('sell_id');
	?>
	</fieldset>
<?php echo $this->MyForm->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->MyHtml->link(__('Delete', true), array('action' => 'delete', $this->MyForm->value('EventsSit.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->MyForm->value('EventsSit.id'))); ?></li>
		<li><?php echo $this->MyHtml->link(__('List Events Sits', true), array('action' => 'index'));?></li>
	</ul>
</div>