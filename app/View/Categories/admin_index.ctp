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
			<th width="80">Hình ảnh</th>
			<th><?php echo $this->Paginator->sort('parent_id','Mục cha'); ?></th>
			<th><?php echo $this->Paginator->sort('name', 'Tên danh mục'); ?></th>
			<th><?php echo $this->Paginator->sort('created','Ngày tạo'); ?></th>
			<th><?php echo $this->Paginator->sort('created_by','Người tạo'); ?></th>
			<th><?php echo $this->Paginator->sort('updated','Ngày update'); ?></th>
			<th><?php echo $this->Paginator->sort('status','Trạng thái'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($categories as $category): ?>
	<tr>
		<td><img class="thumbnail grid-thumb" src="<?php echo !empty($category['Category']['images'])?$category['Category']['images']:'/img/logo.png'; ?>"></td>
		<td>
			<?php echo $this->Html->link($category['ParentCategory']['name'], array('controller' => 'categories', 'action' => 'view', $category['ParentCategory']['id'])); ?>
		</td>
		<td><?php echo h($category['Category']['name']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['created']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($category['Creater']['name'],
										 array('controller' => 'customers', 'action' => 'view', $category['Creater']['id'])); ?>
		</td>
		<td><?php echo h($category['Category']['updated']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view',$category['Category']['id']), array('escape' => false,'title'=>'Xem thông tin')); ?>
			<?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit',$category['Category']['id']), array('escape' => false,'title'=>'Thay đổi thông tin')); ?>
			<?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete',$category['Category']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?',$category['Category']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
				</table>
				<div class="dataTables_info" id="data-table_info">
					<?php
					echo $this->Paginator->counter (array (
														  'format' => __ ('Showing {:start} to {:end} {:count} entries')
													));
					?>
				</div>
				<div class="dataTables_paginate paging_full_numbers">
					<?php
					echo $this->Paginator->prev ('< ' . __ ('previous'), array (), null, array ('class' => 'prev disabled'));
					echo $this->Paginator->numbers (array ('separator' => ''));
					echo $this->Paginator->next (__ ('next') . ' >', array (), null, array ('class' => 'next disabled'));
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
		<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->
