<div class="stores view">
<h2><?php echo __('Store'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($store['Store']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($store['Store']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($store['Store']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($store['Store']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('District'); ?></dt>
		<dd>
			<?php echo h($store['Store']['district']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($store['Store']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($store['User']['id'], array('controller' => 'users', 'action' => 'view', $store['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($store['Store']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Create By'); ?></dt>
		<dd>
			<?php echo h($store['Store']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($store['Store']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Update By'); ?></dt>
		<dd>
			<?php echo h($store['Store']['updated_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($store['Store']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Store'), array('action' => 'edit', $store['Store']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Store'), array('action' => 'delete', $store['Store']['id']), array(), __('Are you sure you want to delete # %s?', $store['Store']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Stores'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Store'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Details'), array('controller' => 'order_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Detail'), array('controller' => 'order_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Warehouses'), array('controller' => 'warehouses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Warehouse'), array('controller' => 'warehouses', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Order Details'); ?></h3>
	<?php if (!empty($store['OrderDetail'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Order Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Sku'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Store Id'); ?></th>
		<th><?php echo __('Promote Id'); ?></th>
		<th><?php echo __('Promote Value'); ?></th>
		<th><?php echo __('Promote Type'); ?></th>
		<th><?php echo __('Product Options'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($store['OrderDetail'] as $orderDetail): ?>
		<tr>
			<td><?php echo $orderDetail['id']; ?></td>
			<td><?php echo $orderDetail['order_id']; ?></td>
			<td><?php echo $orderDetail['product_id']; ?></td>
			<td><?php echo $orderDetail['name']; ?></td>
			<td><?php echo $orderDetail['price']; ?></td>
			<td><?php echo $orderDetail['sku']; ?></td>
			<td><?php echo $orderDetail['qty']; ?></td>
			<td><?php echo $orderDetail['store_id']; ?></td>
			<td><?php echo $orderDetail['promote_id']; ?></td>
			<td><?php echo $orderDetail['promote_value']; ?></td>
			<td><?php echo $orderDetail['promote_type']; ?></td>
			<td><?php echo $orderDetail['product_options']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'order_details', 'action' => 'view', $orderDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'order_details', 'action' => 'edit', $orderDetail['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'order_details', 'action' => 'delete', $orderDetail['id']), array(), __('Are you sure you want to delete # %s?', $orderDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order Detail'), array('controller' => 'order_details', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($store['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Role'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Firstname'); ?></th>
		<th><?php echo __('Lastname'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Dictrict'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('Store Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($store['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['role']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td><?php echo $user['firstname']; ?></td>
			<td><?php echo $user['lastname']; ?></td>
			<td><?php echo $user['phone']; ?></td>
			<td><?php echo $user['address']; ?></td>
			<td><?php echo $user['dictrict']; ?></td>
			<td><?php echo $user['city']; ?></td>
			<td><?php echo $user['store_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), array(), __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Warehouses'); ?></h3>
	<?php if (!empty($store['Warehouse'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Store Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Create By'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Update By'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($store['Warehouse'] as $warehouse): ?>
		<tr>
			<td><?php echo $warehouse['id']; ?></td>
			<td><?php echo $warehouse['store_id']; ?></td>
			<td><?php echo $warehouse['product_id']; ?></td>
			<td><?php echo $warehouse['qty']; ?></td>
			<td><?php echo $warehouse['created']; ?></td>
			<td><?php echo $warehouse['created_by']; ?></td>
			<td><?php echo $warehouse['updated']; ?></td>
			<td><?php echo $warehouse['updated_by']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'warehouses', 'action' => 'view', $warehouse['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'warehouses', 'action' => 'edit', $warehouse['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'warehouses', 'action' => 'delete', $warehouse['id']), array(), __('Are you sure you want to delete # %s?', $warehouse['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Warehouse'), array('controller' => 'warehouses', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
