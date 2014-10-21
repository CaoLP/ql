<?php
setlocale(LC_MONETARY,"vi_VN");
?>
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

					<th><?php echo $this->Paginator->sort('id','Mã số'); ?></th>
					<th><?php echo $this->Paginator->sort('code','Mã số xuất'); ?></th>
					<th><?php echo $this->Paginator->sort('note','Ghi chú'); ?></th>
					<th><?php echo $this->Paginator->sort('type','Loại'); ?></th>
					<th><?php echo $this->Paginator->sort('store_id','Cửa hàng xuất'); ?></th>
					<th><?php echo $this->Paginator->sort('store_receive','Cửa hàng nhận'); ?></th>
					<th><?php echo $this->Paginator->sort('customer_id','Khách hàng'); ?></th>
					<th><?php echo $this->Paginator->sort('total','Thành tiền'); ?></th>
					<th><?php echo $this->Paginator->sort('created','Ngày tạo'); ?></th>
					<th><?php echo $this->Paginator->sort('created_by','Người tạo'); ?></th>
					<th><?php echo $this->Paginator->sort('approved','Ngày duyệt'); ?></th>
					<th><?php echo $this->Paginator->sort('approved_by','Người duyệt'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>

					</thead>
					<tbody>
					<?php foreach ($inoutWarehouses as $inoutWarehouse): ?>
						<tr>
							<td><?php echo h($inoutWarehouse['InoutWarehouse']['id']); ?>&nbsp;</td>
							<td><?php echo h($inoutWarehouse['InoutWarehouse']['code']); ?>&nbsp;</td>
							<td>
								<a
										class="label label-success info"
										data-container="body"
										data-toggle="popover"
										data-placement="bottom"
										data-content="<?php echo h($inoutWarehouse['InoutWarehouse']['note']); ?>"
										data-original-title="<?php echo h($inoutWarehouse['InoutWarehouse']['code']); ?>">
									<span>Ghi chú</span>
								</a>
							</td>
							<td><?php echo h($wtypes[$inoutWarehouse['InoutWarehouse']['type']]); ?>&nbsp;</td>
							<td>
								<?php echo $this->Html->link($inoutWarehouse['Store']['name'], array('controller' => 'stores', 'action' => 'view', $inoutWarehouse['Store']['id'])); ?>
							</td>
							<td>
								<?php echo $this->Html->link($inoutWarehouse['ReceiveStore']['name'], array('controller' => 'stores', 'action' => 'view', $inoutWarehouse['ReceiveStore']['id'])); ?>
							</td>
							<td>
								<?php echo $this->Html->link($inoutWarehouse['Customer']['id'], array('controller' => 'customers', 'action' => 'view', $inoutWarehouse['Customer']['id'])); ?>
							</td>
							<td>
								<?php echo money_format('%.0n',h ($inoutWarehouse['InoutWarehouse']['total'])); ?>
							</td>
							<td><?php echo h($inoutWarehouse['InoutWarehouse']['created']); ?>&nbsp;</td>
							<td>
								<?php echo $this->Html->link($inoutWarehouse['Creater']['name'], array('controller' => 'users', 'action' => 'view', $inoutWarehouse['InoutWarehouse']['created_by'])); ?>
							</td>
							<td><?php echo h($inoutWarehouse['InoutWarehouse']['approved']); ?>&nbsp;</td>
							<td>
								<?php echo $this->Html->link($inoutWarehouse['Approver']['name'], array('controller' => 'users', 'action' => 'view', $inoutWarehouse['InoutWarehouse']['approved_by'])); ?>
							</td>
							<td class="actions">
								<?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view',    $inoutWarehouse['InoutWarehouse']['id']), array('escape' => false,'title'=>'Xem thông tin')); ?>
								<?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit',   $inoutWarehouse['InoutWarehouse']['id']), array('escape' => false,'title'=>'Thay đổi thông tin')); ?>
								<?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete',   $inoutWarehouse['InoutWarehouse']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?',
																																																						$inoutWarehouse['InoutWarehouse']['id'])); ?>
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
<script>
	$(".info").popover();

	$('body').on('click', function (e) {
		$('.info').each(function () {
			//the 'is' for buttons that trigger popups
			//the 'has' for icons within a button that triggers a popup
			if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
				$(this).popover('hide');
			}
		});
	});
</script>
