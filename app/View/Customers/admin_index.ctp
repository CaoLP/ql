
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
                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                <div class="dataTables_filter" id="data-table_filter"><label>Tìm theo tên
                        <form action="<?php echo $this->Html->url(array('controller'=>'customers','action'=>'search'))?>" method="post">
                        <div class="input-group">
                            <input type="text" name="name" class="form-control">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" data-original-title="">Tìm</button>
                      </span>
                        </div>
                        </form>
                    </label></div>
				<table class="table table-condensed table-bordered table-hover no-margin">
					<thead>
					<tr>
						<th><?php echo $this->Paginator->sort ('id'); ?></th>
						<th><?php echo $this->Paginator->sort ('name','Tên'); ?></th>
						<th><?php echo $this->Paginator->sort ('code','Code'); ?></th>
						<th><?php echo $this->Paginator->sort ('phone','Số điện thoại'); ?></th>
						<th><?php echo $this->Paginator->sort ('email','Thư điện tử'); ?></th>
						<th><?php echo $this->Paginator->sort ('address','Địa chỉ'); ?></th>
						<th><?php echo $this->Paginator->sort ('district','Quận'); ?></th>
						<th><?php echo $this->Paginator->sort ('city','Thành phố'); ?></th>
						<th><?php echo $this->Paginator->sort ('created','Ngày tạo'); ?></th>
						<th><?php echo $this->Paginator->sort ('created_by','Tạo bởi'); ?></th>
						<th class="actions"><?php echo __ ('Actions'); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($customers as $customer): ?>
						<tr>
							<td><?php echo h ($customer['Customer']['id']); ?></td>
							<td><?php echo h ($customer['Customer']['name']); ?></td>
							<td><?php echo h ($customer['Customer']['code']); ?></td>
							<td><?php echo h ($customer['Customer']['phone']); ?></td>
							<td><?php echo h ($customer['Customer']['email']); ?></td>
							<td><?php echo h ($customer['Customer']['address']); ?></td>
							<td><?php echo h ($customer['Customer']['district']); ?></td>
							<td><?php echo h ($customer['Customer']['city']); ?></td>
							<td><?php echo h ($customer['Customer']['created']); ?></td>
							<td>
								<?php echo $this->Html->link($customer['Creater']['name'],
															 array('controller' => 'users', 'action' => 'view', $customer['Creater']['id'])); ?>
							</td>
							<td class="actions">
								<?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view',   $customer['Customer']['id']), array('escape' => false,'title'=>'Xem thông tin')); ?>
								<?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit',   $customer['Customer']['id']), array('escape' => false,'title'=>'Thay đổi thông tin')); ?>
								<?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete',   $customer['Customer']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?',   $customer['Customer']['id'])); ?>
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
</div>


<!--
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Customer'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->