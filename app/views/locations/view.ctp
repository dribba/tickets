<div class="locations view">
<h2><?php  __('Location');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $location['Location']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $location['Location']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $location['Location']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $location['Location']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->MyHtml->link(__('Edit Location', true), array('action' => 'edit', $location['Location']['id'])); ?> </li>
		<li><?php echo $this->MyHtml->link(__('Delete Location', true), array('action' => 'delete', $location['Location']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $location['Location']['id'])); ?> </li>
		<li><?php echo $this->MyHtml->link(__('List Locations', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New Location', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('List Sits', true), array('controller' => 'sits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New Sit', true), array('controller' => 'sits', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Sits');?></h3>
	<?php if (!empty($location['Sit'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Location Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($location['Sit'] as $sit):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $sit['id'];?></td>
			<td><?php echo $sit['location_id'];?></td>
			<td><?php echo $sit['created'];?></td>
			<td><?php echo $sit['modified'];?></td>
			<td class="actions">
				<?php echo $this->MyHtml->link(__('View', true), array('controller' => 'sits', 'action' => 'view', $sit['id'])); ?>
				<?php echo $this->MyHtml->link(__('Edit', true), array('controller' => 'sits', 'action' => 'edit', $sit['id'])); ?>
				<?php echo $this->MyHtml->link(__('Delete', true), array('controller' => 'sits', 'action' => 'delete', $sit['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sit['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->MyHtml->link(__('New Sit', true), array('controller' => 'sits', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
