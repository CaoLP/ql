<div class="productOptions form">
<?php echo $this->Form->create('ProductOption'); ?>
	<fieldset>
		<legend><?php echo __('Edit Product Option'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('option_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('price_increment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ProductOption.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('ProductOption.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Product Options'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Options'), array('controller' => 'options', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Option'), array('controller' => 'options', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
