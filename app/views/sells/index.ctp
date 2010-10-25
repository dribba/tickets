<div class="sells index">
	<h2><?php __('Sells');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('location');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($sells as $sell):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $sell['Sell']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->MyHtml->link($sell['User']['id'], array('controller' => 'users', 'action' => 'view', $sell['User']['id'])); ?>
		</td>
		<td><?php echo $sell['Sell']['location']; ?>&nbsp;</td>
		<td><?php echo $sell['Sell']['created']; ?>&nbsp;</td>
		<td><?php echo $sell['Sell']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->MyHtml->link(__('View', true), array('action' => 'view', $sell['Sell']['id'])); ?>
			<?php echo $this->MyHtml->link(__('Edit', true), array('action' => 'edit', $sell['Sell']['id'])); ?>
			<?php echo $this->MyHtml->link(__('Delete', true), array('action' => 'delete', $sell['Sell']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sell['Sell']['id'])); ?>
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
		<li><?php echo $this->MyHtml->link(__('New Sell', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->MyHtml->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('List Events Sits', true), array('controller' => 'events_sits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New Events Sit', true), array('controller' => 'events_sits', 'action' => 'add')); ?> </li>
	</ul>
</div>