<div class="orders view">
<h2><?php echo __('Order'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($order['Order']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['Customer']['id'], array('controller' => 'customers', 'action' => 'view', $order['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['User']['id'], array('controller' => 'users', 'action' => 'view', $order['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($order['Order']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ship'); ?></dt>
		<dd>
			<?php echo h($order['Order']['ship']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ship Increment Price'); ?></dt>
		<dd>
			<?php echo h($order['Order']['ship_increment_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ship Name'); ?></dt>
		<dd>
			<?php echo h($order['Order']['ship_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ship Address'); ?></dt>
		<dd>
			<?php echo h($order['Order']['ship_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ship Address Alt'); ?></dt>
		<dd>
			<?php echo h($order['Order']['ship_address_alt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ship District'); ?></dt>
		<dd>
			<?php echo h($order['Order']['ship_district']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ship City'); ?></dt>
		<dd>
			<?php echo h($order['Order']['ship_city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ship Phone'); ?></dt>
		<dd>
			<?php echo h($order['Order']['ship_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($order['Order']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($order['Order']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Create By'); ?></dt>
		<dd>
			<?php echo h($order['Order']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($order['Order']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Update By'); ?></dt>
		<dd>
			<?php echo h($order['Order']['updated_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Promote'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['Promote']['name'], array('controller' => 'promotes', 'action' => 'view', $order['Promote']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Promote Value'); ?></dt>
		<dd>
			<?php echo h($order['Order']['promote_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Promote Type'); ?></dt>
		<dd>
			<?php echo h($order['Order']['promote_type']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order'), array('action' => 'edit', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Order'), array('action' => 'delete', $order['Order']['id']), array(), __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Promotes'), array('controller' => 'promotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promote'), array('controller' => 'promotes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Details'), array('controller' => 'order_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Detail'), array('controller' => 'order_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Order Details'); ?></h3>
	<?php if (!empty($order['OrderDetail'])): ?>
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
	<?php foreach ($order['OrderDetail'] as $orderDetail): ?>
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
