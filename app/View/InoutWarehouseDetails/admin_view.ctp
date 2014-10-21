<div class="inoutWarehouseDetails view">
<h2><?php echo __('Inout Warehouse Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($inoutWarehouseDetail['InoutWarehouseDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inout Warehouse'); ?></dt>
		<dd>
			<?php echo $this->Html->link($inoutWarehouseDetail['InoutWarehouse']['id'], array('controller' => 'inout_warehouses', 'action' => 'view', $inoutWarehouseDetail['InoutWarehouse']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($inoutWarehouseDetail['Product']['name'], array('controller' => 'products', 'action' => 'view', $inoutWarehouseDetail['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($inoutWarehouseDetail['InoutWarehouseDetail']['note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Qty'); ?></dt>
		<dd>
			<?php echo h($inoutWarehouseDetail['InoutWarehouseDetail']['qty']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($inoutWarehouseDetail['InoutWarehouseDetail']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tax'); ?></dt>
		<dd>
			<?php echo h($inoutWarehouseDetail['InoutWarehouseDetail']['tax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total'); ?></dt>
		<dd>
			<?php echo h($inoutWarehouseDetail['InoutWarehouseDetail']['total']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Inout Warehouse Detail'), array('action' => 'edit', $inoutWarehouseDetail['InoutWarehouseDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Inout Warehouse Detail'), array('action' => 'delete', $inoutWarehouseDetail['InoutWarehouseDetail']['id']), array(), __('Are you sure you want to delete # %s?', $inoutWarehouseDetail['InoutWarehouseDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Inout Warehouse Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inout Warehouse Detail'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inout Warehouses'), array('controller' => 'inout_warehouses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inout Warehouse'), array('controller' => 'inout_warehouses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
