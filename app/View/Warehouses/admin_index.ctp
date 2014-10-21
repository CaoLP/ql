<div class="warehouses index">
	<h2><?php echo __('Warehouses'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('store_id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('qty'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_by'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th><?php echo $this->Paginator->sort('updated_by'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($warehouses as $warehouse): ?>
	<tr>
		<td><?php echo h($warehouse['Warehouse']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($warehouse['Store']['name'], array('controller' => 'stores', 'action' => 'view', $warehouse['Store']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($warehouse['Product']['name'], array('controller' => 'products', 'action' => 'view', $warehouse['Product']['id'])); ?>
		</td>
		<td><?php echo h($warehouse['Warehouse']['qty']); ?>&nbsp;</td>
		<td><?php echo h($warehouse['Warehouse']['created']); ?>&nbsp;</td>
		<td><?php echo h($warehouse['Warehouse']['created_by']); ?>&nbsp;</td>
		<td><?php echo h($warehouse['Warehouse']['updated']); ?>&nbsp;</td>
		<td><?php echo h($warehouse['Warehouse']['updated_by']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $warehouse['Warehouse']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $warehouse['Warehouse']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $warehouse['Warehouse']['id']), array(), __('Are you sure you want to delete # %s?', $warehouse['Warehouse']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Warehouse'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Stores'), array('controller' => 'stores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Store'), array('controller' => 'stores', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
