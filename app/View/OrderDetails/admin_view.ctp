<div class="orderDetails view">
<h2><?php echo __('Order Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($orderDetail['OrderDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderDetail['Order']['id'], array('controller' => 'orders', 'action' => 'view', $orderDetail['Order']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderDetail['Product']['name'], array('controller' => 'products', 'action' => 'view', $orderDetail['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($orderDetail['OrderDetail']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($orderDetail['OrderDetail']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sku'); ?></dt>
		<dd>
			<?php echo h($orderDetail['OrderDetail']['sku']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Qty'); ?></dt>
		<dd>
			<?php echo h($orderDetail['OrderDetail']['qty']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Store'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderDetail['Store']['name'], array('controller' => 'stores', 'action' => 'view', $orderDetail['Store']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Promote'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderDetail['Promote']['name'], array('controller' => 'promotes', 'action' => 'view', $orderDetail['Promote']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Promote Value'); ?></dt>
		<dd>
			<?php echo h($orderDetail['OrderDetail']['promote_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Promote Type'); ?></dt>
		<dd>
			<?php echo h($orderDetail['OrderDetail']['promote_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Options'); ?></dt>
		<dd>
			<?php echo h($orderDetail['OrderDetail']['product_options']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order Detail'), array('action' => 'edit', $orderDetail['OrderDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Order Detail'), array('action' => 'delete', $orderDetail['OrderDetail']['id']), array(), __('Are you sure you want to delete # %s?', $orderDetail['OrderDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Detail'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stores'), array('controller' => 'stores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Store'), array('controller' => 'stores', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Promotes'), array('controller' => 'promotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promote'), array('controller' => 'promotes', 'action' => 'add')); ?> </li>
	</ul>
</div>
