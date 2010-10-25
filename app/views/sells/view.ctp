<div class="sells view">
<h2><?php  __('Sell');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sell['Sell']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->MyHtml->link($sell['User']['id'], array('controller' => 'users', 'action' => 'view', $sell['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Location'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sell['Sell']['location']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sell['Sell']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sell['Sell']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->MyHtml->link(__('Edit Sell', true), array('action' => 'edit', $sell['Sell']['id'])); ?> </li>
		<li><?php echo $this->MyHtml->link(__('Delete Sell', true), array('action' => 'delete', $sell['Sell']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sell['Sell']['id'])); ?> </li>
		<li><?php echo $this->MyHtml->link(__('List Sells', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New Sell', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('List Events Sits', true), array('controller' => 'events_sits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New Events Sit', true), array('controller' => 'events_sits', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Events Sits');?></h3>
	<?php if (!empty($sell['EventsSit'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Event Id'); ?></th>
		<th><?php __('Sit Id'); ?></th>
		<th><?php __('State'); ?></th>
		<th><?php __('Sell Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($sell['EventsSit'] as $eventsSit):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $eventsSit['id'];?></td>
			<td><?php echo $eventsSit['event_id'];?></td>
			<td><?php echo $eventsSit['sit_id'];?></td>
			<td><?php echo $eventsSit['state'];?></td>
			<td><?php echo $eventsSit['sell_id'];?></td>
			<td><?php echo $eventsSit['created'];?></td>
			<td><?php echo $eventsSit['modified'];?></td>
			<td class="actions">
				<?php echo $this->MyHtml->link(__('View', true), array('controller' => 'events_sits', 'action' => 'view', $eventsSit['id'])); ?>
				<?php echo $this->MyHtml->link(__('Edit', true), array('controller' => 'events_sits', 'action' => 'edit', $eventsSit['id'])); ?>
				<?php echo $this->MyHtml->link(__('Delete', true), array('controller' => 'events_sits', 'action' => 'delete', $eventsSit['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $eventsSit['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->MyHtml->link(__('New Events Sit', true), array('controller' => 'events_sits', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
