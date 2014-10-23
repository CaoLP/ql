<?php
setlocale (LC_MONETARY, "vi_VN");
?>
<!-- Row start -->
<div class="row">
	<div class="col-md-3">
		<div class="widget">
			<div class="widget-header">
				<h3>Tìm kiếm</h3>
			</div>
			<div class="widget-body">
				<form action="" method="get">
					<input class="form-control" placeholder="Theo mã phiếu chuyển">
				</form>
			</div>
		</div>
		<div class="widget">
			<div class="widget-header">
				<h3>Lọc thời gian</h3>
			</div>
			<div class="widget-body">
				<div class="radio">
					<label>
						<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
						Toàn thời gian
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
						Hôm nay
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
						Tuần này
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
						Tháng này
					</label>
				</div>
				<a href="javascript:;">Lựa chọn khác »</a>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="widget">
			<div class="widget-header">
				<div class="title pull-right">
					<?php echo $this->Html->link (
						'<span aria-hidden="true" class="icon-plus"></span> Chuyển hàng',
						array ('action' => 'add'),
						array ('class' => 'btn btn-sm btn-success','escape'=>false));?>
				</div>
			<h3>Phiếu chuyển hàng</h3>
			</div>
			<div class="widget-body">
				<table class="table table-condensedtable-hover no-margin">
					<thead>
					<th><?php echo $this->Paginator->sort ('code', 'Mã số chuyển'); ?></th>
					<th><?php echo $this->Paginator->sort ('store_id', 'Từ chi nhánh'); ?></th>
					<th><?php echo $this->Paginator->sort ('store_receive', 'Tới chi nhánh'); ?></th>
					<th><?php echo $this->Paginator->sort ('created', 'Ngày chuyển'); ?></th>
					<th><?php echo $this->Paginator->sort ('status', 'Trạng thái'); ?></th>
					</thead>
					<tbody>
					<?php foreach ($inoutWarehouses as $inoutWarehouse): ?>
						<tr class="table-toggle-expand">
							<td><?php echo h ($inoutWarehouse['InoutWarehouse']['code']); ?>&nbsp;</td>
							<td>
								<?php echo $inoutWarehouse['Store']['name']; ?>
							</td>
							<td>
								<?php echo $inoutWarehouse['ReceiveStore']['name']; ?>
							</td>
							<td><?php echo h ($inoutWarehouse['InoutWarehouse']['created']); ?>&nbsp;</td>
							<td><?php echo h ($inoutWarehouse['InoutWarehouse']['status']); ?>&nbsp;</td>
						</tr>
						<tr class="table-expandable">
							<td colspan="5">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">Panel heading without title</div>
                                        <div class="panel-body">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <table class="table">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <strong>Mã chuyển hàng</strong>
                                                                </td>
                                                                <td>
                                                                    <span class="label label-success">TRF000001</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>Từ chi nhánh</strong>
                                                                </td>
                                                                <td>
                                                                    Chi nhánh trung tâm
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>Ngày chuyển</strong>
                                                                </td>
                                                                <td>
                                                                    <input class="form-control">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>Người tạo</strong>
                                                                </td>
                                                                <td>
                                                                    Bao Bao
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <table class="table">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <strong>Trạng thái</strong>
                                                                </td>
                                                                <td>
                                                                    <span class="label label-warning">Đang chuyển</span>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <strong>Tới chi nhánh</strong>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control"></select>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input class="form-control" placeholder="Ghi chú">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer">Panel footer</div>
                                    </div>
                                </div>

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
