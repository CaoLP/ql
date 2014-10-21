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
			<th><?php echo $this->Paginator->sort('code','Mã số'); ?></th>
			<th><?php echo $this->Paginator->sort('value','Giá trị'); ?></th>
			<th><?php echo $this->Paginator->sort('type','Loại'); ?></th>
			<th><?php echo $this->Paginator->sort('begin','Ngày bắt đầu'); ?></th>
			<th><?php echo $this->Paginator->sort('end','Ngày kết thúc'); ?></th>
			<th><?php echo $this->Paginator->sort('created','Ngày tạo'); ?></th>
			<th><?php echo $this->Paginator->sort('created_by','Người tạo'); ?></th>
			<th><?php echo $this->Paginator->sort('updated','Ngày update'); ?></th>
			<th><?php echo $this->Paginator->sort('updated_by','Người update'); ?></th>
			<th><?php echo $this->Paginator->sort('status','Trạng thái'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($promotes as $promote): ?>
	<tr>
		<td><?php echo h($promote['Promote']['id']); ?></td>
		<td><?php echo h($promote['Promote']['name']); ?></td>
		<td><?php echo h($promote['Promote']['code']); ?></td>
		<td><?php echo h($promote['Promote']['value']); ?></td>
		<td><?php echo h($promote['Promote']['type']); ?></td>
		<td><?php echo h($promote['Promote']['begin']); ?></td>
		<td><?php echo h($promote['Promote']['end']); ?></td>
		<td><?php echo h($promote['Promote']['created']); ?></td>
		<td>
			<?php echo $this->Html->link($promote['Creater']['name'],
										 array('controller' => 'customers', 'action' => 'view', $promote['Creater']['id'])); ?>
		</td>
		<td><?php echo h($promote['Promote']['updated']); ?></td>
		<td>
			<?php echo $this->Html->link($promote['Updater']['name'],
										 array('controller' => 'customers', 'action' => 'view', $promote['Updater']['id'])); ?>
		</td>
		<td><?php echo h($promote['Promote']['status']); ?></td>
		<td class="actions">
			<?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view', $promote['Promote']['id']), array('escape' => false,'title'=>'Xem thông tin')); ?>
			<?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit', $promote['Promote']['id']), array('escape' => false,'title'=>'Thay đổi thông tin')); ?>
			<?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $promote['Promote']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?', $promote['Promote']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Promote'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Order Details'), array('controller' => 'order_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Detail'), array('controller' => 'order_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->