<div class="promotes view">
<h2><?php echo __('Promote'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($promote['Promote']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($promote['Promote']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($promote['Promote']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($promote['Promote']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($promote['Promote']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Begin'); ?></dt>
		<dd>
			<?php echo h($promote['Promote']['begin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End'); ?></dt>
		<dd>
			<?php echo h($promote['Promote']['end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($promote['Promote']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Create By'); ?></dt>
		<dd>
			<?php echo h($promote['Promote']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($promote['Promote']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Update By'); ?></dt>
		<dd>
			<?php echo h($promote['Promote']['updated_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($promote['Promote']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Promote'), array('action' => 'edit', $promote['Promote']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Promote'), array('action' => 'delete', $promote['Promote']['id']), array(), __('Are you sure you want to delete # %s?', $promote['Promote']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Promotes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promote'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Details'), array('controller' => 'order_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Detail'), array('controller' => 'order_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Order Details'); ?></h3>
	<?php if (!empty($promote['OrderDetail'])): ?>
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
	<?php foreach ($promote['OrderDetail'] as $orderDetail): ?>
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
	<h3><?php echo __('Related Orders'); ?></h3>
	<?php if (!empty($promote['Order'])): ?>
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
	<?php foreach ($promote['Order'] as $order): ?>
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
