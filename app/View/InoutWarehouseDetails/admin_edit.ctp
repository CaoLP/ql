<div class="inoutWarehouseDetails form">
<?php echo $this->Form->create('InoutWarehouseDetail'); ?>
	<fieldset>
		<legend><?php echo __('Edit Inout Warehouse Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('inout_warehouse_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('note');
		echo $this->Form->input('qty');
		echo $this->Form->input('price');
		echo $this->Form->input('tax');
		echo $this->Form->input('total');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('InoutWarehouseDetail.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('InoutWarehouseDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Inout Warehouse Details'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Inout Warehouses'), array('controller' => 'inout_warehouses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inout Warehouse'), array('controller' => 'inout_warehouses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
