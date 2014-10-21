<div class="productPromotes index">
	<h2><?php echo __('Product Promotes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('promote_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_by'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th><?php echo $this->Paginator->sort('updated_by'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($productPromotes as $productPromote): ?>
	<tr>
		<td><?php echo h($productPromote['ProductPromote']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($productPromote['Product']['name'], array('controller' => 'products', 'action' => 'view', $productPromote['Product']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($productPromote['Promote']['name'], array('controller' => 'promotes', 'action' => 'view', $productPromote['Promote']['id'])); ?>
		</td>
		<td><?php echo h($productPromote['ProductPromote']['created']); ?>&nbsp;</td>
		<td><?php echo h($productPromote['ProductPromote']['created_by']); ?>&nbsp;</td>
		<td><?php echo h($productPromote['ProductPromote']['updated']); ?>&nbsp;</td>
		<td><?php echo h($productPromote['ProductPromote']['updated_by']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $productPromote['ProductPromote']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $productPromote['ProductPromote']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $productPromote['ProductPromote']['id']), array(), __('Are you sure you want to delete # %s?', $productPromote['ProductPromote']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Product Promote'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Promotes'), array('controller' => 'promotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promote'), array('controller' => 'promotes', 'action' => 'add')); ?> </li>
	</ul>
</div>
