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
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name','Tên'); ?></th>
			<th><?php echo $this->Paginator->sort('phone','Điện thoại'); ?></th>
			<th><?php echo $this->Paginator->sort('address','Địa chỉ'); ?></th>
			<th><?php echo $this->Paginator->sort('district','Quận'); ?></th>
			<th><?php echo $this->Paginator->sort('city','Thành phố'); ?></th>
			<th><?php echo $this->Paginator->sort('manager_id','Quản lý'); ?></th>
			<th><?php echo $this->Paginator->sort('created','Ngày tạo'); ?></th>
			<th><?php echo $this->Paginator->sort('created_by','Người tạo'); ?></th>
			<th><?php echo $this->Paginator->sort('updated','Ngày update'); ?></th>
			<th><?php echo $this->Paginator->sort('updated_by','Người update'); ?></th>
			<th><?php echo $this->Paginator->sort('status','Trạng thái'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($stores as $store): ?>
	<tr>
		<td><?php echo h($store['Store']['id']); ?></td>
		<td>
			<?php
			if($store['Store']['is_center']) echo '<span class="label label-warning">';
			echo h($store['Store']['name']);
			if($store['Store']['is_center']) echo '</span>';
			?>
		</td>
		<td><?php echo h($store['Store']['phone']); ?></td>
		<td><?php echo h($store['Store']['address']); ?></td>
		<td><?php echo h($store['Store']['district']); ?></td>
		<td><?php echo h($store['Store']['city']); ?></td>
		<td>
			<?php echo $this->Html->link($store['Manager']['name'], array('controller' => 'users', 'action' => 'view', $store['Manager']['id'])); ?>
		</td>
		<td><?php echo h($store['Store']['created']); ?></td>
		<td>
			<?php echo $this->Html->link($store['Creater']['name'],
										 array('controller' => 'customers', 'action' => 'view', $store['Creater']['id'])); ?>
		</td>
		<td><?php echo h($store['Store']['updated']); ?></td>
		<td>
			<?php echo $this->Html->link($store['Updater']['name'],
										 array('controller' => 'customers', 'action' => 'view', $store['Updater']['id'])); ?>
		</td>
		<td><?php echo h($store['Store']['status']); ?></td>
		<td class="actions">
			<?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view',$store['Store']['id']), array('escape' => false,'title'=>'Xem thông tin')); ?>
			<?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit',$store['Store']['id']), array('escape' => false,'title'=>'Thay đổi thông tin')); ?>
			<?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete',$store['Store']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?',$store['Store']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Store'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Details'), array('controller' => 'order_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Detail'), array('controller' => 'order_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Warehouses'), array('controller' => 'warehouses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Warehouse'), array('controller' => 'warehouses', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->