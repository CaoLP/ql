
<!-- Row start -->
<div class="row">
	<div class="col-md-12">
		<div class="widget">
			<div class="widget-header">
				<div class="title">
					<?php echo $this->Html->link ('Tạo mới', array ('action' => 'add'), array (
																							  'class' => 'btn btn-sm btn-success'
																						));?>
				</div>
			</div>
			<div class="widget-body">
				<table class="table table-condensed table-bordered table-hover no-margin">
					<thead>
					<tr>
						<th class="header"><?php echo $this->Paginator->sort('id');?></th>
						<th class="header"><?php echo $this->Paginator->sort('name','Tên');?></th>
						<th class="header"><?php echo $this->Paginator->sort('created','Ngày tạo');?></th>
						<th class="header"><?php echo $this->Paginator->sort('modified','Ngày thay đổi');?></th>
						<th class="header"><?php echo __('Actions');?></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($groups as $group): ?>
						<tr>
							<td><?php echo h($group['Group']['id']); ?>&nbsp;</td>
							<td><?php echo h($group['Group']['name']); ?>&nbsp;</td>
							<td><?php echo h($group['Group']['created']); ?>&nbsp;</td>
							<td><?php echo h($group['Group']['modified']); ?>&nbsp;</td>
							<td class="actions">
								<?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit',   $group['Group']['id']), array('escape' => false,'title'=>'Thay đổi thông tin')); ?>
								<?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete',   $group['Group']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?',   $group['Group']['id'])); ?>
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