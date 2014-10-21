<div class="orderDetails form">
<?php echo $this->Form->create('OrderDetail'); ?>
	<fieldset>
		<legend><?php echo __('Add Order Detail'); ?></legend>
	<?php
		echo $this->Form->input('order_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('name');
		echo $this->Form->input('price');
		echo $this->Form->input('sku');
		echo $this->Form->input('qty');
		echo $this->Form->input('store_id');
		echo $this->Form->input('promote_id');
		echo $this->Form->input('promote_value');
		echo $this->Form->input('promote_type');
		echo $this->Form->input('product_options');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Order Details'), array('action' => 'index')); ?></li>
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
