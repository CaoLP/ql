<?php
setlocale(LC_MONETARY, "vi_VN");
?>
<!-- Row start -->
<div class="row">
<div class="col-md-3">
	<div class="widget">
		<div class="widget-header">
			<h3>Tìm kiếm</h3>
		</div>
		<div class="widget-body">
			<form method="post">
				<input class="form-control" name="data[q]" value="<?php
                    if(isset($this->request->data['q'])) echo $this->request->data['q'];
                ?>" placeholder="Theo mã phiếu chuyển">
                <input type="hidden" name="data[from]"  value="<?php
                if (isset($this->request->data['from'])) echo $this->request->data['from'];
                ?>">
                <input type="hidden" name="data[to]"  value="<?php
                if (isset($this->request->data['to'])) echo $this->request->data['to'];
                ?>">
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
                    <input type="radio" name="optionsRadios" class="radio-filter" value="1">
                    Toàn thời gian
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" class="radio-filter" value="2">
                    Hôm nay
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" class="radio-filter" value="3">
                    Tuần này
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" class="radio-filter" value="4">
                    Tháng này
                </label>
            </div>
            <div>
                <form method="post">
                    <input type="hidden" class="form-control" name="data[q]" value="<?php
                    if (isset($this->request->data['q'])) echo $this->request->data['q'];
                    ?>">
                    <ul class="list-group no-margin">
                        <li class="list-group-item no-padding">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">--Từ ngày-</span>
                                <input name="data[from]"  value="<?php
                                if (isset($this->request->data['from'])) echo $this->request->data['from'];
                                ?>" class="form-control datepicker2" readonly="readonly">
                            </div>
                        </li>
                        <li class="list-group-item no-padding">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">Đến ngày-</span>
                                <input name="data[to]" value="<?php
                                if (isset($this->request->data['to'])) echo $this->request->data['to'];
                                ?>" class="form-control datepicker2" readonly="readonly">
                            </div>
                        </li>
                        <li class="list-group-item no-padding">
                            <button class="form-control"><i class="icon-search"></i> Tìm</button>
                        </li>
                    </ul>
                </form>
            </div>
		</div>
	</div>
</div>
<div class="col-md-9">
<div class="widget">
	<div class="widget-header">
		<div class="title pull-right">
			<?php echo $this->Html->link(
				'<span aria-hidden="true" class="icon-plus"></span> Nhập hàng',
				array('action' => 'add',0),
				array('class' => 'btn btn-sm btn-success', 'escape' => false));?>
		</div>
		<h3>Phiếu nhập hàng</h3>
	</div>
	<div class="widget-body">
		<table class="table table-condensedtable-hover no-margin">
			<thead>
			<th><?php echo $this->Paginator->sort('code', 'Mã số chuyển'); ?></th>
			<th><?php echo $this->Paginator->sort('store_id', 'Ngày tạo'); ?></th>
			<th><?php echo $this->Paginator->sort('created', 'Tổng cộng'); ?></th>
			<th><?php echo $this->Paginator->sort('status', 'Trạng thái'); ?></th>
			</thead>
			<tbody>
			<?php foreach ($inoutWarehouses as $key=>$inoutWarehouse): ?>
				<tr class="table-toggle-expand">
					<td><?php echo h($inoutWarehouse['InoutWarehouse']['code']); ?>&nbsp;</td>
					<td>
						<?php echo date('d/m/Y',strtotime($inoutWarehouse['InoutWarehouse']['created'])); ?>
					</td>
					<td>
						<span class="price-text"><?php echo money_format ('%.0n',$inoutWarehouse['InoutWarehouse']['total']); ?></span>
					</td>
					<td><?php echo $status[$inoutWarehouse['InoutWarehouse']['status']]; ?>&nbsp;</td>
				</tr>
				<tr class="table-expandable">
					<td colspan="5">
						<div class="col-md-12">
							<?php echo $this->Form->create('InoutWarehouse',array('id'=>'InoutWarehouse'.$key,'action'=>'/edit/'.$inoutWarehouse['InoutWarehouse']['id']));?>
							<?php
							echo $this->Form->input('id',array('value'=>$inoutWarehouse['InoutWarehouse']['id']));
							?>
							<div class="panel panel-success">
								<div class="panel-heading">Thông tin</div>
								<div class="panel-body">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-5 p-0">
												<table class="table">
													<tbody>
													<tr>
														<td>
															<strong>Mã nhập hàng</strong>
														</td>
														<td>
                                                                <span
																		class="label label-success"><?php echo $inoutWarehouse['InoutWarehouse']['code']; ?></span>
														</td>
													</tr>
													<tr>
														<td>
															<strong>Chi nhánh</strong>
														</td>
														<td>
															<?php echo $inoutWarehouse['Store']['name']; ?>
														</td>
													</tr>
													<tr>
														<td>
															<strong>Ngày tạo</strong>
														</td>
														<td>
                                                            <?php echo date('d/m/Y',strtotime($inoutWarehouse['InoutWarehouse']['created'])); ?>
														</td>
													</tr>

													</tbody>
												</table>
											</div>
											<div class="col-md-4 p-0">
												<table class="table">
													<tbody>
													<tr>
														<td>
															<strong>Trạng thái</strong>
														</td>
														<td>
                                                                <span
																		class="label label-warning"><?php echo $status[$inoutWarehouse['InoutWarehouse']['status']]; ?></span>
														</td>
													</tr>
                                                    <tr>
                                                        <td>
                                                            <strong>Người tạo</strong>
                                                        </td>
                                                        <td>
                                                            <?php echo $inoutWarehouse['Creater']['name']; ?>
                                                        </td>
                                                    </tr>
													</tbody>
												</table>
											</div>
											<div class="col-md-3 p-0">
												<?php echo $this->Form->input('note', array('class' => 'form-control','placeholder'=>'Ghi chú','label' => false, 'div' => false,'value'=> $inoutWarehouse['InoutWarehouse']['note'])) ?>

											</div>
										</div>
									</div>
									<div class="col-md-12">
										<table class="table table-condensedtable-hover no-margin">
											<thead>
											<tr>
												<th>Mã hàng hóa</th>
												<th>Tên hàng hóa</th>
												<th>Số lượng</th>
												<th>Thuộc tính</th>
											</tr>
											</thead>
											<tbody>
											<?php foreach ($inoutWarehouse['InoutWarehouseDetail'] as $detail) { ?>
												<tr>
													<td><?php echo $detail['sku']; ?></td>
													<td><?php echo $detail['name']; ?></td>
													<td><?php echo $detail['qty']; ?></td>
													<td><?php echo $detail['option_names']; ?></td>
												</tr>
											<?php
											};
											?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="panel-footer text-right">
                                    <?php
                                    if($inoutWarehouse['InoutWarehouse']['status']==0)
                                        if($this->Session->read('Auth.User.group_id')==1
                                            || $inoutWarehouse['InoutWarehouse']['created_by']==$this->Session->read('Auth.User.id'))
                                        echo $this->Html->link(
                                            '<i class="icon-pencil"></i> Thay đổi',
                                            array('action' => 'change',
                                                $inoutWarehouse['InoutWarehouse']['id']),
                                            array('escape'=>false,'class'=>'btn btn-info'),
                                            __('Bạn có muốn thay đổi thông tin đơn nhập hàng # %s này không?',
                                                $inoutWarehouse['InoutWarehouse']['code'])); ?>
									<?php
                                    if($inoutWarehouse['InoutWarehouse']['status']==0)
                                    echo $this->Html->link(
										'<i class="icon-remove"></i> Huỷ bỏ',
										array('action' => 'cancel',
											 $inoutWarehouse['InoutWarehouse']['id']),
										array('escape'=>false,'class'=>'btn btn-danger'),
										__('Bạn có muốn huỷ đơn nhập hàng # %s này không?',
										   $inoutWarehouse['InoutWarehouse']['code'])); ?>
                                        <a href="<?php echo $this->Html->url(array(
                                            'controller'=>'print',
                                            'action'=>'fillwarehouse',
                                            $inoutWarehouse['InoutWarehouse']['id']
                                        ));?>" target="_blank" class="btn btn-warning"><i class="icon-print"></i> In</a>
									<a href="<?php echo $this->Html->url(array(
                                        'controller'=>'print',
                                        'action'=>'fillwarehouse_excel',
                                        $inoutWarehouse['InoutWarehouse']['id']
                                    ));?>" class="btn btn-warning"><i class="icon-download-3"></i>
										Xuất file</a>
                                    <?php
                                    if($inoutWarehouse['InoutWarehouse']['status']==0)
                                        if($this->Session->read('Auth.User.group_id')==1)
                                    echo $this->Html->link(
                                        '<i class="icon-checkmark"></i> Duyệt hàng',
                                        array('action' => 'approve',
                                            $inoutWarehouse['InoutWarehouse']['id']),
                                        array('escape'=>false,'class'=>'btn btn-success'),
                                        __('Bạn có muốn duyệt đơn nhập hàng # %s này không?',
                                            $inoutWarehouse['InoutWarehouse']['code'])); ?>
								</div>
							</div>
							<?php echo $this->Form->end();?>
						</div>
					</td>
				</tr>
			<?php endforeach; ?>

			</tbody>
		</table>
        <div class="row">
            <div class="col-md-12">
                <div class=" pull-right">
                    <div class="dataTables_info" id="data-table_info">
                        <?php
                        echo $this->Paginator->counter(array(
                            'format' => __('Showing {:start} to {:end} {:count} entries')
                        ));
                        ?>
                    </div>
                    <ul class="pagination pull-right">
                        <?php
                        echo $this->Paginator->prev(__('&laquo;'), array('tag' => 'li','escape'=>false), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a','escape'=>false));
                        echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                        echo $this->Paginator->next(__('&raquo;'), array('tag' => 'li','currentClass' => 'disabled','escape'=>false), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a','escape'=>false));
                        ?>
                    </ul>
                </div>
            </div>
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
	Date.prototype.toDateInputValue = (function() {
		var local = new Date(this);
		local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
		return local.toJSON().slice(0,10);
	});
	$(function() {
		$( ".datepicker" ).datepicker({
			showOn: "button",
			buttonImage: "/img/dateIcon.png",
			buttonImageOnly: true,
			buttonText: 'Chọn ngày',
			dateFormat : 'yy-mm-dd',
			minDate: 0,
			maxDate: "+1M +10D"
		});
	});
</script>
