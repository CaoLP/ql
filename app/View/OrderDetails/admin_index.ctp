<div class="orderDetails index">
	<h2><?php echo __('Order Details'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('order_id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('sku'); ?></th>
			<th><?php echo $this->Paginator->sort('qty'); ?></th>
			<th><?php echo $this->Paginator->sort('store_id'); ?></th>
			<th><?php echo $this->Paginator->sort('promote_id'); ?></th>
			<th><?php echo $this->Paginator->sort('promote_value'); ?></th>
			<th><?php echo $this->Paginator->sort('promote_type'); ?></th>
			<th><?php echo $this->Paginator->sort('product_options'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($orderDetails as $orderDetail): ?>
	<tr>
		<td><?php echo h($orderDetail['OrderDetail']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($orderDetail['Order']['id'], array('controller' => 'orders', 'action' => 'view', $orderDetail['Order']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($orderDetail['Product']['name'], array('controller' => 'products', 'action' => 'view', $orderDetail['Product']['id'])); ?>
		</td>
		<td><?php echo h($orderDetail['OrderDetail']['name']); ?>&nbsp;</td>
		<td><?php echo h($orderDetail['OrderDetail']['price']); ?>&nbsp;</td>
		<td><?php echo h($orderDetail['OrderDetail']['sku']); ?>&nbsp;</td>
		<td><?php echo h($orderDetail['OrderDetail']['qty']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($orderDetail['Store']['name'], array('controller' => 'stores', 'action' => 'view', $orderDetail['Store']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($orderDetail['Promote']['name'], array('controller' => 'promotes', 'action' => 'view', $orderDetail['Promote']['id'])); ?>
		</td>
		<td><?php echo h($orderDetail['OrderDetail']['promote_value']); ?>&nbsp;</td>
		<td><?php echo h($orderDetail['OrderDetail']['promote_type']); ?>&nbsp;</td>
		<td><?php echo h($orderDetail['OrderDetail']['product_options']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $orderDetail['OrderDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $orderDetail['OrderDetail']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $orderDetail['OrderDetail']['id']), array(), __('Are you sure you want to delete # %s?', $orderDetail['OrderDetail']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Order Detail'), array('action' => 'add')); ?></li>
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
