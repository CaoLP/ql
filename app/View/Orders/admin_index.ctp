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
						<th><?php echo $this->Paginator->sort('customer_id','Tên khách'); ?></th>
						<th><?php echo $this->Paginator->sort('amount','Giá tiền'); ?></th>
						<th><?php echo $this->Paginator->sort('ship','Chuyển hàng'); ?></th>
						<th><?php echo $this->Paginator->sort('ship_increment_price','Phí Ship'); ?></th>
						<th><?php echo $this->Paginator->sort('status','Trạng thái'); ?></th>
						<th><?php echo $this->Paginator->sort('created_by', 'Người tạo'); ?></th>
						<th><?php echo $this->Paginator->sort('created','Ngày tạo'); ?></th>
						<th><?php echo $this->Paginator->sort('updated','Ngày update'); ?></th>
						<th><?php echo $this->Paginator->sort('promote_value','Khuyến mãi'); ?></th>
						<th>Thành tiền</th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($orders as $order): ?>
						<tr>
							<td><?php echo h($order['Order']['id']); ?>&nbsp;</td>
							<td>
								<?php echo $this->Html->link($order['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $order['Customer']['id'])); ?>
							</td>
							<td><?php echo h($order['Order']['amount']); ?>&nbsp;</td>
							<td><?php echo h($order['Order']['ship']); ?>&nbsp;</td>
							<td><?php echo h($order['Order']['ship_increment_price']); ?>&nbsp;</td>
							<td><?php echo h($order['Order']['status']); ?>&nbsp;</td>
							<td>
								<?php echo $this->Html->link($order['Creater']['name'],
																			array('controller' => 'users', 'action' => 'view', $order['Creater']['id'])); ?>
							</td>
							<td><?php echo h($order['Order']['created']); ?>&nbsp;</td>
							<td><?php echo h($order['Order']['updated']); ?>&nbsp;</td>
							<td><?php echo h($order['Order']['promote_value']); ?> <?php echo h($types[$order['Order']['promote_type']]); ?>&nbsp;</td>
							<td><?php
								if($order['Order']['promote_type']==0){
									$res = $order['Order']['amount']+$order['Order']['ship_increment_price']-$order['Order']['promote_value'];
									echo $res<0?0:$res;
								}else{
									$res = ($order['Order']['amount']+$order['Order']['ship_increment_price']-($order['Order']['amount']*$order['Order']['promote_value']/100));
									echo $res<0?0:$res;
								}
								?></td>
							<td class="actions">
								<?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view', $order['Order']['id']), array('escape' => false,'title'=>'Xem thông tin')); ?>
								<?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit', $order['Order']['id']), array('escape' => false,'title'=>'Thay đổi thông tin')); ?>
								<?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $order['Order']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Promotes'), array('controller' => 'promotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promote'), array('controller' => 'promotes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Details'), array('controller' => 'order_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Detail'), array('controller' => 'order_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->
