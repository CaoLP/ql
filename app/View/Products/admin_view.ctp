<div class="products view">
<h2><?php echo __('Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sku'); ?></dt>
		<dd>
			<?php echo h($product['Product']['sku']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($product['Product']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($product['Product']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Excert'); ?></dt>
		<dd>
			<?php echo h($product['Product']['excert']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descriptions'); ?></dt>
		<dd>
			<?php echo h($product['Product']['descriptions']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Thumbnail'); ?></dt>
		<dd>
			<?php echo h($product['Product']['thumbnail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Images'); ?></dt>
		<dd>
			<?php echo h($product['Product']['images']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($product['Product']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Create By'); ?></dt>
		<dd>
			<?php echo h($product['Product']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($product['Product']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Update By'); ?></dt>
		<dd>
			<?php echo h($product['Product']['updated_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($product['Product']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Product'), array('action' => 'edit', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product'), array('action' => 'delete', $product['Product']['id']), array(), __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Details'), array('controller' => 'order_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Detail'), array('controller' => 'order_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Categories'), array('controller' => 'product_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Category'), array('controller' => 'product_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Options'), array('controller' => 'product_options', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Option'), array('controller' => 'product_options', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Promotes'), array('controller' => 'product_promotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Promote'), array('controller' => 'product_promotes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Warehouses'), array('controller' => 'warehouses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Warehouse'), array('controller' => 'warehouses', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Order Details'); ?></h3>
	<?php if (!empty($product['OrderDetail'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Order Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Sku'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Store Id'); ?></th>
		<th><?php echo __('Promote Id'); ?></th>
		<th><?php echo __('Promote Value'); ?></th>
		<th><?php echo __('Promote Type'); ?></th>
		<th><?php echo __('Product Options'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($product['OrderDetail'] as $orderDetail): ?>
		<tr>
			<td><?php echo $orderDetail['id']; ?></td>
			<td><?php echo $orderDetail['order_id']; ?></td>
			<td><?php echo $orderDetail['product_id']; ?></td>
			<td><?php echo $orderDetail['name']; ?></td>
			<td><?php echo $orderDetail['price']; ?></td>
			<td><?php echo $orderDetail['sku']; ?></td>
			<td><?php echo $orderDetail['qty']; ?></td>
			<td><?php echo $orderDetail['store_id']; ?></td>
			<td><?php echo $orderDetail['promote_id']; ?></td>
			<td><?php echo $orderDetail['promote_value']; ?></td>
			<td><?php echo $orderDetail['promote_type']; ?></td>
			<td><?php echo $orderDetail['product_options']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'order_details', 'action' => 'view', $orderDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'order_details', 'action' => 'edit', $orderDetail['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'order_details', 'action' => 'delete', $orderDetail['id']), array(), __('Are you sure you want to delete # %s?', $orderDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order Detail'), array('controller' => 'order_details', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Product Categories'); ?></h3>
	<?php if (!empty($product['ProductCategory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($product['ProductCategory'] as $productCategory): ?>
		<tr>
			<td><?php echo $productCategory['id']; ?></td>
			<td><?php echo $productCategory['product_id']; ?></td>
			<td><?php echo $productCategory['category_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'product_categories', 'action' => 'view', $productCategory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'product_categories', 'action' => 'edit', $productCategory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'product_categories', 'action' => 'delete', $productCategory['id']), array(), __('Are you sure you want to delete # %s?', $productCategory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Product Category'), array('controller' => 'product_categories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Product Options'); ?></h3>
	<?php if (!empty($product['ProductOption'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Option Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Price Increment'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($product['ProductOption'] as $productOption): ?>
		<tr>
			<td><?php echo $productOption['id']; ?></td>
			<td><?php echo $productOption['option_id']; ?></td>
			<td><?php echo $productOption['product_id']; ?></td>
			<td><?php echo $productOption['price_increment']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'product_options', 'action' => 'view', $productOption['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'product_options', 'action' => 'edit', $productOption['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'product_options', 'action' => 'delete', $productOption['id']), array(), __('Are you sure you want to delete # %s?', $productOption['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Product Option'), array('controller' => 'product_options', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Product Promotes'); ?></h3>
	<?php if (!empty($product['ProductPromote'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Promote Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Create By'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Update By'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($product['ProductPromote'] as $productPromote): ?>
		<tr>
			<td><?php echo $productPromote['id']; ?></td>
			<td><?php echo $productPromote['product_id']; ?></td>
			<td><?php echo $productPromote['promote_id']; ?></td>
			<td><?php echo $productPromote['created']; ?></td>
			<td><?php echo $productPromote['created_by']; ?></td>
			<td><?php echo $productPromote['updated']; ?></td>
			<td><?php echo $productPromote['updated_by']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'product_promotes', 'action' => 'view', $productPromote['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'product_promotes', 'action' => 'edit', $productPromote['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'product_promotes', 'action' => 'delete', $productPromote['id']), array(), __('Are you sure you want to delete # %s?', $productPromote['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Product Promote'), array('controller' => 'product_promotes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Warehouses'); ?></h3>
	<?php if (!empty($product['Warehouse'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Store Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Create By'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Update By'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($product['Warehouse'] as $warehouse): ?>
		<tr>
			<td><?php echo $warehouse['id']; ?></td>
			<td><?php echo $warehouse['store_id']; ?></td>
			<td><?php echo $warehouse['product_id']; ?></td>
			<td><?php echo $warehouse['qty']; ?></td>
			<td><?php echo $warehouse['created']; ?></td>
			<td><?php echo $warehouse['created_by']; ?></td>
			<td><?php echo $warehouse['updated']; ?></td>
			<td><?php echo $warehouse['updated_by']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'warehouses', 'action' => 'view', $warehouse['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'warehouses', 'action' => 'edit', $warehouse['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'warehouses', 'action' => 'delete', $warehouse['id']), array(), __('Are you sure you want to delete # %s?', $warehouse['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Warehouse'), array('controller' => 'warehouses', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
