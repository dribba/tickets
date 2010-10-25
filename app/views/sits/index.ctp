<div class="sits index">
	<h2><?php __('Sits');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('location_id');?></th>
			<th><?php echo $this->Paginator->sort('event_id');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($sits as $sit):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $sit['Sit']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->MyHtml->link($sit['Location']['name'], array('controller' => 'locations', 'action' => 'view', $sit['Location']['id'])); ?>
		</td>
		<td><?php echo $sit['Sit']['event_id']; ?>&nbsp;</td>
		<td><?php echo $sit['Sit']['code']; ?>&nbsp;</td>
		<td><?php echo $sit['Sit']['created']; ?>&nbsp;</td>
		<td><?php echo $sit['Sit']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->MyHtml->link(__('View', true), array('action' => 'view', $sit['Sit']['id'])); ?>
			<?php echo $this->MyHtml->link(__('Edit', true), array('action' => 'edit', $sit['Sit']['id'])); ?>
			<?php echo $this->MyHtml->link(__('Delete', true), array('action' => 'delete', $sit['Sit']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sit['Sit']['id'])); ?>
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
		<li><?php echo $this->MyHtml->link(__('New Sit', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->MyHtml->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('List Events', true), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New Event', true), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>