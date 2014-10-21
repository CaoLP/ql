<div class="orders form">
<?php echo $this->Form->create('Order'); ?>
	<fieldset>
		<legend><?php echo __('Add Order'); ?></legend>
	<?php
		echo $this->Form->input('customer_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('amount');
		echo $this->Form->input('ship');
		echo $this->Form->input('ship_increment_price');
		echo $this->Form->input('ship_name');
		echo $this->Form->input('ship_address');
		echo $this->Form->input('ship_address_alt');
		echo $this->Form->input('ship_district');
		echo $this->Form->input('ship_city');
		echo $this->Form->input('ship_phone');
		echo $this->Form->input('status');
		echo $this->Form->input('created_by');
		echo $this->Form->input('updated_by');
		echo $this->Form->input('promote_id');
		echo $this->Form->input('promote_value');
		echo $this->Form->input('promote_type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Orders'), array('action' => 'index')); ?></li>
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
