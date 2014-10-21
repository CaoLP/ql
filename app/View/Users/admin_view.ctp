<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($user['User']['role']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Firstname'); ?></dt>
		<dd>
			<?php echo h($user['User']['firstname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lastname'); ?></dt>
		<dd>
			<?php echo h($user['User']['lastname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($user['User']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($user['User']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dictrict'); ?></dt>
		<dd>
			<?php echo h($user['User']['dictrict']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($user['User']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Store'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Store']['name'], array('controller' => 'stores', 'action' => 'view', $user['Store']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stores'), array('controller' => 'stores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Store'), array('controller' => 'stores', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Orders'); ?></h3>
	<?php if (!empty($user['Order'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Customer Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th><?php echo __('Ship'); ?></th>
		<th><?php echo __('Ship Increment Price'); ?></th>
		<th><?php echo __('Ship Name'); ?></th>
		<th><?php echo __('Ship Address'); ?></th>
		<th><?php echo __('Ship Address Alt'); ?></th>
		<th><?php echo __('Ship District'); ?></th>
		<th><?php echo __('Ship City'); ?></th>
		<th><?php echo __('Ship Phone'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Create By'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Update By'); ?></th>
		<th><?php echo __('Promote Id'); ?></th>
		<th><?php echo __('Promote Value'); ?></th>
		<th><?php echo __('Promote Type'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Order'] as $order): ?>
		<tr>
			<td><?php echo $order['id']; ?></td>
			<td><?php echo $order['customer_id']; ?></td>
			<td><?php echo $order['user_id']; ?></td>
			<td><?php echo $order['amount']; ?></td>
			<td><?php echo $order['ship']; ?></td>
			<td><?php echo $order['ship_increment_price']; ?></td>
			<td><?php echo $order['ship_name']; ?></td>
			<td><?php echo $order['ship_address']; ?></td>
			<td><?php echo $order['ship_address_alt']; ?></td>
			<td><?php echo $order['ship_district']; ?></td>
			<td><?php echo $order['ship_city']; ?></td>
			<td><?php echo $order['ship_phone']; ?></td>
			<td><?php echo $order['status']; ?></td>
			<td><?php echo $order['created']; ?></td>
			<td><?php echo $order['created_by']; ?></td>
			<td><?php echo $order['updated']; ?></td>
			<td><?php echo $order['updated_by']; ?></td>
			<td><?php echo $order['promote_id']; ?></td>
			<td><?php echo $order['promote_value']; ?></td>
			<td><?php echo $order['promote_type']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'orders', 'action' => 'view', $order['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'orders', 'action' => 'edit', $order['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'orders', 'action' => 'delete', $order['id']), array(), __('Are you sure you want to delete # %s?', $order['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
