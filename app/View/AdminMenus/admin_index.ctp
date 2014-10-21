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

					<th><?php echo $this->Paginator->sort('name','Tên'); ?></th>
					<th><?php echo $this->Paginator->sort('icon'); ?></th>
					<th><?php echo $this->Paginator->sort('url','Đường dẫn'); ?></th>
					<th><?php echo $this->Paginator->sort('group_ids','Nhóm người dùng'); ?></th>
					<th><?php echo $this->Paginator->sort('parent_id','Mục cha'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>

					</thead>
					<tbody>
					<?php foreach ($adminMenus as $adminMenu): ?>
						<tr>
							<td><?php echo h($adminMenu['AdminMenu']['name']); ?>&nbsp;</td>
							<td><?php echo h($adminMenu['AdminMenu']['icon']); ?>&nbsp;</td>
							<td><?php echo h($adminMenu['AdminMenu']['url']); ?>&nbsp;</td>
							<td>
								<?php
								$groupList = explode(',',$adminMenu['AdminMenu']['group_ids']);
								foreach($groupList as $gr_id){
									echo $this->Html->link($groups[$gr_id], array('controller' => 'groups', 'action' => 'view', $gr_id));
									echo ', ';
								}
								?>
							</td>
							<td>
								<?php echo $this->Html->link($adminMenu['ParentAdminMenu']['name'], array('controller' => 'admin_menus', 'action' => 'view', $adminMenu['ParentAdminMenu']['id'])); ?>
							</td>
							<td class="actions">
								<?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view',    $adminMenu['AdminMenu']['id']), array('escape' => false,'title'=>'Xem thông tin')); ?>
								<?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit',   $adminMenu['AdminMenu']['id']), array('escape' => false,'title'=>'Thay đổi thông tin')); ?>
								<?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete',   $adminMenu['AdminMenu']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?',
																																																						$adminMenu['AdminMenu']['id'])); ?>
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