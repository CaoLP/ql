<div class="productOptions view">
<h2><?php echo __('Product Option'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productOption['ProductOption']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Option'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productOption['Option']['name'], array('controller' => 'options', 'action' => 'view', $productOption['Option']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productOption['Product']['name'], array('controller' => 'products', 'action' => 'view', $productOption['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price Increment'); ?></dt>
		<dd>
			<?php echo h($productOption['ProductOption']['price_increment']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Product Option'), array('action' => 'edit', $productOption['ProductOption']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Option'), array('action' => 'delete', $productOption['ProductOption']['id']), array(), __('Are you sure you want to delete # %s?', $productOption['ProductOption']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Options'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Option'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Options'), array('controller' => 'options', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Option'), array('controller' => 'options', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
