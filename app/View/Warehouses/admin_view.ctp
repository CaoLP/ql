<div class="warehouses view">
<h2><?php echo __('Warehouse'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($warehouse['Warehouse']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Store'); ?></dt>
		<dd>
			<?php echo $this->Html->link($warehouse['Store']['name'], array('controller' => 'stores', 'action' => 'view', $warehouse['Store']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($warehouse['Product']['name'], array('controller' => 'products', 'action' => 'view', $warehouse['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Qty'); ?></dt>
		<dd>
			<?php echo h($warehouse['Warehouse']['qty']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($warehouse['Warehouse']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Create By'); ?></dt>
		<dd>
			<?php echo h($warehouse['Warehouse']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($warehouse['Warehouse']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Update By'); ?></dt>
		<dd>
			<?php echo h($warehouse['Warehouse']['updated_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Warehouse'), array('action' => 'edit', $warehouse['Warehouse']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Warehouse'), array('action' => 'delete', $warehouse['Warehouse']['id']), array(), __('Are you sure you want to delete # %s?', $warehouse['Warehouse']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Warehouses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Warehouse'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stores'), array('controller' => 'stores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Store'), array('controller' => 'stores', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
