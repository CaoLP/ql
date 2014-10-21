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
						<th><?php echo $this->Paginator->sort ('id'); ?></th>
						<th><?php echo $this->Paginator->sort ('name','Tên'); ?></th>
						<th><?php echo $this->Paginator->sort ('value','Giá trị'); ?></th>
						<th><?php echo $this->Paginator->sort ('type','Loại'); ?></th>
						<th><?php echo $this->Paginator->sort ('description','Ghi chú'); ?></th>
						<th><?php echo $this->Paginator->sort ('created','Ngày tạo'); ?></th>
						<th><?php echo $this->Paginator->sort ('created_by','Người tạo'); ?></th>
						<th><?php echo $this->Paginator->sort ('updated','Ngày thay đổi'); ?></th>
						<th><?php echo $this->Paginator->sort ('updated_by','Người thay đổi'); ?></th>
						<th class="actions"><?php echo __ ('Actions'); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($settings as $setting): ?>
						<tr>
							<td><?php echo h ($setting['Setting']['id']); ?>&nbsp;</td>
							<td><?php echo h ($setting['Setting']['name']); ?>&nbsp;</td>
							<td><?php echo h ($setting['Setting']['value']); ?>&nbsp;</td>
							<td><?php echo h ($setting['Setting']['type']); ?>&nbsp;</td>
							<td><?php echo h ($setting['Setting']['description']); ?>&nbsp;</td>
							<td><?php echo h ($setting['Setting']['created']); ?>&nbsp;</td>
							<td>
								<?php echo $this->Html->link ($setting['Creater']['name'], array ('controller' => 'users', 'action' => 'view', $setting['Creater']['id'])); ?>
							</td>
							<td><?php echo h ($setting['Setting']['updated']); ?>&nbsp;</td>
							<td>
								<?php echo $this->Html->link ($setting['Updater']['name'], array ('controller' => 'users', 'action' => 'view', $setting['Updater']['id'])); ?>
							</td>
							<td class="actions">
								<?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view', $setting['Setting']['id']), array('escape' => false,'title'=>'Xem thông tin')); ?>
								<?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit', $setting['Setting']['id']), array('escape' => false,'title'=>'Thay đổi thông tin')); ?>
								<?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $setting['Setting']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?', $setting['Setting']['id'])); ?>
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
