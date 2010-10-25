<div class="eventsSits index">
	<h2><?php __('Events Sits');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('event_id');?></th>
			<th><?php echo $this->Paginator->sort('sit_id');?></th>
			<th><?php echo $this->Paginator->sort('state');?></th>
			<th><?php echo $this->Paginator->sort('sell_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($eventsSits as $eventsSit):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $eventsSit['EventsSit']['id']; ?>&nbsp;</td>
		<td><?php echo $eventsSit['EventsSit']['event_id']; ?>&nbsp;</td>
		<td><?php echo $eventsSit['EventsSit']['sit_id']; ?>&nbsp;</td>
		<td><?php echo $eventsSit['EventsSit']['state']; ?>&nbsp;</td>
		<td><?php echo $eventsSit['EventsSit']['sell_id']; ?>&nbsp;</td>
		<td><?php echo $eventsSit['EventsSit']['created']; ?>&nbsp;</td>
		<td><?php echo $eventsSit['EventsSit']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->MyHtml->link(__('View', true), array('action' => 'view', $eventsSit['EventsSit']['id'])); ?>
			<?php echo $this->MyHtml->link(__('Edit', true), array('action' => 'edit', $eventsSit['EventsSit']['id'])); ?>
			<?php echo $this->MyHtml->link(__('Delete', true), array('action' => 'delete', $eventsSit['EventsSit']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $eventsSit['EventsSit']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->MyHtml->link(__('New Events Sit', true), array('action' => 'add')); ?></li>
	</ul>
</div>