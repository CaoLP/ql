<div class="productPromotes form">
<?php echo $this->Form->create('ProductPromote'); ?>
	<fieldset>
		<legend><?php echo __('Edit Product Promote'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('promote_id');
		echo $this->Form->input('created_by');
		echo $this->Form->input('updated_by');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ProductPromote.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('ProductPromote.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Product Promotes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Promotes'), array('controller' => 'promotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promote'), array('controller' => 'promotes', 'action' => 'add')); ?> </li>
	</ul>
</div>
