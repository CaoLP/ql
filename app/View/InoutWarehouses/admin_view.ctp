<?php
setlocale(LC_MONETARY,"vi_VN");
if($showBtn)
$this->Html->addCrumb ('<li>Phiếu nhập hàng chờ duyệt</li>', array ('action' => 'in'), array ('escape' => false));
else
$this->Html->addCrumb ('<li>' . $title_for_layout . '</li>', array ('action' => 'index'), array ('escape' => false));
$this->Html->addCrumb ('<li>' . $inoutWarehouse['InoutWarehouse']['code'] . '</li>', '/' . $this->request->url, array ('escape' => false));
?>
<!-- Row start -->
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="widget">
				<div class="widget-header">
					<div class="title">
						<span class="fs1" aria-hidden="true"
							  data-icon="&#xe039;"></span> <?php echo __ ('Hoá đơn nhâp-xuất : ') . $inoutWarehouse['InoutWarehouse']['code']; ?>
					</div>
				</div>
				<div class="widget-body">
					<table class="table table-striped table-hover">
						<tbody>
						<tr>
							<td><?php echo __ ('Mã số'); ?></td>
							<td>
								<?php echo h ($inoutWarehouse['InoutWarehouse']['code']); ?>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td><?php echo __ ('Loại hoá đơn'); ?></td>
							<td>
								<?php echo h ($wtypes[$inoutWarehouse['InoutWarehouse']['type']]); ?>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td><?php echo __ ('Cửa hàng xuất'); ?></td>
							<td>
								<?php echo $this->Html->link ($inoutWarehouse['Store']['name'], array ('controller' => 'stores', 'action' => 'view', $inoutWarehouse['Store']['id'])); ?>
								&nbsp;
							</td>
						</tr>
						<?php if($inoutWarehouse['InoutWarehouse']['store_receive']) :?>
						<tr>
							<td><?php echo __ ('Cửa hàng nhập'); ?></td>
							<td>
								<?php echo $this->Html->link ($inoutWarehouse['ReceiveStore']['name'], array ('controller' => 'stores', 'action' => 'view', $inoutWarehouse['Store']['id'])); ?>
								&nbsp;
							</td>
						</tr>
						<?php endif;?>
						<?php if($inoutWarehouse['Customer']['id']) :?>
						<tr>
							<td><?php echo __ ('Khách hàng'); ?></td>
							<td>
								<?php echo $this->Html->link ($inoutWarehouse['Customer']['id'], array ('controller' => 'customers', 'action' => 'view', $inoutWarehouse['Customer']['id'])); ?>
								&nbsp;
							</td>
						</tr>
						<?php endif; ?>
						<tr>
							<td><?php echo __ ('Tổng tiền'); ?></td>
							<td>
								<?php echo money_format('%.0n',h ($inoutWarehouse['InoutWarehouse']['total'])); ?>
								&nbsp;
							</td>
						</tr>
						<?php if($inoutWarehouse['InoutWarehouse']['received']) :?>
						<tr>
							<td><?php echo __ ('Đã nhận'); ?></td>
							<td>
								<?php echo h ($inoutWarehouse['InoutWarehouse']['received']); ?>
								&nbsp;
							</td>
						</tr>
						<?php endif; ?>
						<?php if($inoutWarehouse['InoutWarehouse']['refund']) :?>
						<tr>
							<td><?php echo __ ('Trả lại'); ?></td>
							<td>
								<?php echo h ($inoutWarehouse['InoutWarehouse']['refund']); ?>
								&nbsp;
							</td>
						</tr>
						<?php endif; ?>
						<tr>
							<td><?php echo __ ('Ngày tạo'); ?></td>
							<td>
								<?php echo h ($inoutWarehouse['InoutWarehouse']['created']); ?>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td><?php echo __ ('Người tạo'); ?></td>
							<td>
								<?php echo $this->Html->link($inoutWarehouse['Creater']['name'], array('controller' => 'users', 'action' => 'view', $inoutWarehouse['InoutWarehouse']['created_by'])); ?>
								&nbsp;
							</td>
						</tr>
						<?php if($inoutWarehouse['InoutWarehouse']['approved']) :?>
						<tr>
							<td><?php echo __ ('Ngày duyệt nhập'); ?></td>
							<td>
								<?php echo h ($inoutWarehouse['InoutWarehouse']['approved']); ?>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td><?php echo __ ('Người duyệt nhập'); ?></td>
							<td>
								<?php echo $this->Html->link($inoutWarehouse['Approver']['name'], array('controller' => 'users', 'action' => 'view', $inoutWarehouse['InoutWarehouse']['approved_by'])); ?>
								&nbsp;
							</td>
						</tr>
						<?php endif; ?>
						<tr>
							<td><?php echo __ ('Ghi chú'); ?></td>
							<td>
								<?php echo h ($inoutWarehouse['InoutWarehouse']['note']); ?>
								&nbsp;
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="widget">
				<div class="widget-header">
					<div class="title">
						<span class="fs1" aria-hidden="true"
							  data-icon="&#xe039;"></span> <?php echo __ ('Danh sách hàng'); ?>
					</div>
				</div>
				<div class="widget-body">
					<table class="table table-condensed table-bordered table-hover no-margin">
						<thead>
						<tr>
							<th><?php echo __('Tên hàng'); ?></th>
							<th><?php echo __('Thuộc tính'); ?></th>
							<th><?php echo __('Số lượng'); ?></th>
							<th><?php echo __('Giá'); ?></th>
							<th><?php echo __('Thành tiền'); ?></th>
							<th><?php echo __('Ghi chú'); ?></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($inoutWarehouse['InoutWarehouseDetail'] as $inoutWarehouseDetail): ?>
							<tr>
								<td><?php echo $inoutWarehouseDetail['name']; ?></td>
								<td><?php echo $inoutWarehouseDetail['option_names']; ?></td>
								<td><?php echo $inoutWarehouseDetail['qty']; ?></td>
								<td><?php echo money_format('%.0n',$inoutWarehouseDetail['price']); ?></td>
								<td><?php echo money_format('%.0n',$inoutWarehouseDetail['total']); ?></td>
								<td><?php echo $inoutWarehouseDetail['note']; ?></td>
							</tr>
						<?php endforeach; ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>Tổng tiền</td>
							<td><?php echo money_format('%.0n',h ($inoutWarehouse['InoutWarehouse']['total'])); ?></td>
							<td></td>
						</tr>
						</tbody>
					</table>
				</div>
				<?php if(($inoutWarehouse['InoutWarehouse']['type']==0 && empty($inoutWarehouse['InoutWarehouse']['approved']))) : ?>
				<div class="row">
					<form action="<?php echo $this->Html->url(array('admin'=>true,'controller'=>'inout_warehouses','action'=>'approve',$inoutWarehouse['InoutWarehouse']['id']))?>" method="post">
					<div class="pager">
						<button type="submit" class="next btn btn-success">Duyệt hàng</button>
					</div>
					</form>
				</div>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>