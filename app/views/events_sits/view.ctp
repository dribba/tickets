<div class="eventsSits view">
<h2><?php  __('Events Sit');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $eventsSit['EventsSit']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Event Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $eventsSit['EventsSit']['event_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sit Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $eventsSit['EventsSit']['sit_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('State'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $eventsSit['EventsSit']['state']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sell Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $eventsSit['EventsSit']['sell_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $eventsSit['EventsSit']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $eventsSit['EventsSit']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->MyHtml->link(__('Edit Events Sit', true), array('action' => 'edit', $eventsSit['EventsSit']['id'])); ?> </li>
		<li><?php echo $this->MyHtml->link(__('Delete Events Sit', true), array('action' => 'delete', $eventsSit['EventsSit']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $eventsSit['EventsSit']['id'])); ?> </li>
		<li><?php echo $this->MyHtml->link(__('List Events Sits', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->MyHtml->link(__('New Events Sit', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
