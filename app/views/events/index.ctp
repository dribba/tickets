<div class="events index">
	<h2><?php __('Events');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->MyPaginator->sort('id');?></th>
			<th><?php echo $this->MyPaginator->sort('name', __('Name', true));?></th>
			<th><?php echo $this->MyPaginator->sort('start', __('Start', true));?></th>
			<th><?php echo $this->MyPaginator->sort('end', __('End', true));?></th>
			<th><?php echo $this->MyPaginator->sort('comments', __('Comments', true));?></th>
			<th><?php echo $this->MyPaginator->sort('created', __('Created', true));?></th>
			<th><?php echo $this->MyPaginator->sort('modified', __('Modified', true));?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($events as $event):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $event['Event']['id']; ?>&nbsp;</td>
		<td><?php echo $event['Event']['name']; ?>&nbsp;</td>
		<td><?php echo $event['Event']['start']; ?>&nbsp;</td>
		<td><?php echo $event['Event']['end']; ?>&nbsp;</td>
		<td><?php echo $event['Event']['comments']; ?>&nbsp;</td>
		<td><?php echo $event['Event']['created']; ?>&nbsp;</td>
		<td><?php echo $event['Event']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->MyHtml->link(__('View', true), array('action' => 'view', $event['Event']['id'])); ?>
			<?php echo $this->MyHtml->link(__('Edit', true), array('action' => 'edit', $event['Event']['id'])); ?>
			<?php echo $this->MyHtml->link(__('Delete', true), array('action' => 'delete', $event['Event']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $event['Event']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->MyPaginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->MyPaginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->MyPaginator->numbers();?>
 |
		<?php echo $this->MyPaginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->MyHtml->link(__('New Event', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->MyHtml->link(__('List Sits', true), array('controller' => 'sits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New Sit', true), array('controller' => 'sits', 'action' => 'add')); ?> </li>
	</ul>
</div>