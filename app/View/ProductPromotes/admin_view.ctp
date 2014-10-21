<div class="productPromotes view">
<h2><?php echo __('Product Promote'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productPromote['ProductPromote']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productPromote['Product']['name'], array('controller' => 'products', 'action' => 'view', $productPromote['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Promote'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productPromote['Promote']['name'], array('controller' => 'promotes', 'action' => 'view', $productPromote['Promote']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($productPromote['ProductPromote']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Create By'); ?></dt>
		<dd>
			<?php echo h($productPromote['ProductPromote']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($productPromote['ProductPromote']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Update By'); ?></dt>
		<dd>
			<?php echo h($productPromote['ProductPromote']['updated_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Product Promote'), array('action' => 'edit', $productPromote['ProductPromote']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Promote'), array('action' => 'delete', $productPromote['ProductPromote']['id']), array(), __('Are you sure you want to delete # %s?', $productPromote['ProductPromote']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Promotes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Promote'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Promotes'), array('controller' => 'promotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promote'), array('controller' => 'promotes', 'action' => 'add')); ?> </li>
	</ul>
</div>
