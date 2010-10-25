<div class="users index">
	<h2><?php __('Users');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->MyPaginator->sort('id');?></th>
			<th><?php echo $this->MyPaginator->sort('username');?></th>
			<th><?php echo $this->MyPaginator->sort('password');?></th>
			<th><?php echo $this->MyPaginator->sort('last_login');?></th>
			<th><?php echo $this->MyPaginator->sort('full_name');?></th>
			<th><?php echo $this->MyPaginator->sort('email');?></th>
			<th><?php echo $this->MyPaginator->sort('type');?></th>
			<th><?php echo $this->MyPaginator->sort('created');?></th>
			<th><?php echo $this->MyPaginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($data as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $user['User']['id']; ?>&nbsp;</td>
		<td><?php echo $user['User']['username']; ?>&nbsp;</td>
		<td><?php echo $user['User']['password']; ?>&nbsp;</td>
		<td><?php echo $user['User']['last_login']; ?>&nbsp;</td>
		<td><?php echo $user['User']['full_name']; ?>&nbsp;</td>
		<td><?php echo $user['User']['email']; ?>&nbsp;</td>
		<td><?php echo $user['User']['type']; ?>&nbsp;</td>
		<td><?php echo $user['User']['created']; ?>&nbsp;</td>
		<td><?php echo $user['User']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->MyHtml->link(__('View', true), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->MyHtml->link(__('Edit', true), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->MyHtml->link(__('Delete', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?>
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
		<li><?php echo $this->MyHtml->link(__('New User', true), array('action' => 'add')); ?></li>
	</ul>
</div>