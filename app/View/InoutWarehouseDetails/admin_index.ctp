<div class="inoutWarehouseDetails index">
	<h2><?php echo __('Inout Warehouse Details'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('inout_warehouse_id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('note'); ?></th>
			<th><?php echo $this->Paginator->sort('qty'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('tax'); ?></th>
			<th><?php echo $this->Paginator->sort('total'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($inoutWarehouseDetails as $inoutWarehouseDetail): ?>
	<tr>
		<td><?php echo h($inoutWarehouseDetail['InoutWarehouseDetail']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($inoutWarehouseDetail['InoutWarehouse']['id'], array('controller' => 'inout_warehouses', 'action' => 'view', $inoutWarehouseDetail['InoutWarehouse']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($inoutWarehouseDetail['Product']['name'], array('controller' => 'products', 'action' => 'view', $inoutWarehouseDetail['Product']['id'])); ?>
		</td>
		<td><?php echo h($inoutWarehouseDetail['InoutWarehouseDetail']['note']); ?>&nbsp;</td>
		<td><?php echo h($inoutWarehouseDetail['InoutWarehouseDetail']['qty']); ?>&nbsp;</td>
		<td><?php echo h($inoutWarehouseDetail['InoutWarehouseDetail']['price']); ?>&nbsp;</td>
		<td><?php echo h($inoutWarehouseDetail['InoutWarehouseDetail']['tax']); ?>&nbsp;</td>
		<td><?php echo h($inoutWarehouseDetail['InoutWarehouseDetail']['total']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $inoutWarehouseDetail['InoutWarehouseDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $inoutWarehouseDetail['InoutWarehouseDetail']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $inoutWarehouseDetail['InoutWarehouseDetail']['id']), array(), __('Are you sure you want to delete # %s?', $inoutWarehouseDetail['InoutWarehouseDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Inout Warehouse Detail'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Inout Warehouses'), array('controller' => 'inout_warehouses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inout Warehouse'), array('controller' => 'inout_warehouses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
