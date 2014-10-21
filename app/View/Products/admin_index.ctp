<!-- Row start -->
<div class="row">
	<div class="col-md-12">
		<div class="widget">
			<div class="widget-header">
				<div class="title">
					<?php echo $this->Html->link('Tạo mới',array('action'=>'add'),array(
																					   'class'=>'btn btn-sm btn-success'
																				  ));?>
				</div>
			</div>
			<div class="widget-body">
				<table class="table table-condensed table-bordered table-hover no-margin">
	<thead>
	<tr>
			<th width="80">Ảnh đại diện</th>
			<th><?php echo $this->Paginator->sort('sku'); ?></th>
			<th><?php echo $this->Paginator->sort('name','Tên Sản phẩm'); ?></th>
			<th><?php echo $this->Paginator->sort('price','Giá'); ?></th>
			<th><?php echo $this->Paginator->sort('created','Ngày tạo'); ?></th>
			<th><?php echo $this->Paginator->sort('created_by','Người tạo'); ?></th>
			<th><?php echo $this->Paginator->sort('updated','Ngày cập nhật'); ?></th>
			<th><?php echo $this->Paginator->sort('updated_by','Người cập nhật'); ?></th>
			<th><?php echo $this->Paginator->sort('status','Trạng thái'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($products as $product): ?>
	<tr>
		<td><img class="thumbnail grid-thumb" src="<?php echo !empty($product['Product']['thumbnail'])?$product['Product']['thumbnail']:'/img/logo.png'; ?>"></td>
		<td><?php echo h($product['Product']['sku']); ?></td>
		<td><?php echo h($product['Product']['name']); ?></td>
		<td><?php echo h($product['Product']['price']); ?></td>
		<td><?php echo h($product['Product']['created']); ?></td>
		<td>
			<?php echo $this->Html->link($product['Creater']['name'],
										 array('controller' => 'users', 'action' => 'view', $product['Creater']['id'])); ?>
		</td>
		<td><?php echo h($product['Product']['updated']); ?></td>
		<td>
			<?php echo $this->Html->link($product['Updater']['name'],
										 array('controller' => 'users', 'action' => 'view', $product['Updater']['id'])); ?>
		</td>
		<td><?php echo h($product['Product']['status']); ?></td>
		<td class="actions">
			<?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view',  $product['Product']['id']), array('escape' => false,'title'=>'Xem thông tin')); ?>
			<?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit',  $product['Product']['id']), array('escape' => false,'title'=>'Thay đổi thông tin')); ?>
			<?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete',  $product['Product']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?',  $product['Product']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
				</table>
				<div class="dataTables_info" id="data-table_info">
					<?php
					echo $this->Paginator->counter(array(
														'format' => __('Showing {:start} to {:end} {:count} entries')
												   ));
					?>
				</div>
				<div class="dataTables_paginate paging_full_numbers">
					<?php
					echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
					echo $this->Paginator->numbers(array('separator' => ''));
					echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
					?>
				</div>
			</div>
		</div>
	</div>
</div>


<!--
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?></li>
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
-->