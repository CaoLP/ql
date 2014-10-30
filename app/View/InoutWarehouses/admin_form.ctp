<?php
$this->Html->addCrumb('<li>' . $title_for_layout . '</li>', array('action' => 'index'), array('escape' => false));
if ($this->request->params['action'] == 'admin_add') {
    $this->Html->addCrumb('<li>Xuất kho</li>', '/' . $this->request->url, array('escape' => false));
} else {
    $this->Html->addCrumb('<li>Phiếu xuất' . $this->request->data['InoutWarehouse']['id'] . '</li>', '/' . $this->request->url, array('escape' => false));
}
echo $this->Html->script (array ('warehouse'), array ('inline' => false)
);
echo $this->Form->create('InoutWarehouse', array('class' => 'form-horizontal'));
?>
<script>
	var ajax_url = '<?php echo $this->Html->url(array('controller'=>'products','action'=>'index'))?>';
	var optionData = JSON.parse('<?php echo json_encode($options)?>');
</script>
    <div class="row">
        <div class="col-md-8">
            <div class="widget-header">
                <div class="title pull-right" style="width: 70%">
                    <input class="form-control" id="p-search">
                </div>
                <h3>Nhập hàng</h3>
            </div>
            <div class="widget-body">
                <table class="table table-condensedtable-hover no-margin">
                    <thead>
                    <th>Mã hàng hóa</th>
                    <th>Tên hàng hóa</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    </thead>
                    <tbody>
                    <tr data-id="" data-options="">
                        <td>323454</td>
                        <td>adasdasdasd</td>
                        <td>4,00023,000</td>
                        <td>10</td>
                        <td>1,515,125,125</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">
							<span>Thuộc tính : </span><span class="options">Xanh,XL</span>
                        </td>
                        <td>

                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-md-4">
            <div class="widget-body">
                <div class="col-md-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li class="active"><a href="#info" role="tab" data-toggle="tab">Thông tin</a></li>
                        <li><a href="#note" role="tab" data-toggle="tab">Ghi chú</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content content-1">
                        <div class="tab-pane fade in active" id="info">
                            <ul class="list-group no-margin">
                                <li class="list-group-item">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Nhà cung cấp">
                                  <span class="input-group-btn">
                                    <a class="btn btn-default" type="button" data-original-title=""><i class="icon-plus"></i></a>
                                  </span>
                                    </div>
                                </li>
                                <li class="list-group-item"><strong>Nhà cung cấp chưa xác định</strong></li>
                                <li class="list-group-item">
									<div class="input-group input-group-sm">
										<span class="input-group-addon">Trạng thái</span>
										<input type="text" class="form-control" value="Phiếu tạm" disabled="disabled">
									</div>
								</li>
                                <li class="list-group-item">
									<div class="input-group input-group-sm">
										<span class="input-group-addon">Mã phiếu</span>
										<input type="text" class="form-control" placeholder="Tự động">
									</div>
								</li>
                            </ul>

                        </div>
                        <div class="tab-pane fade" id="note">
							<textarea class="form-control" rows="8" placeholder="Ghi chú"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li class="active"><a href="#sell" role="tab" data-toggle="tab">Thanh toán</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="sell">
							<ul class="list-group no-margin">
								<li class="list-group-item">
									<div class="input-group input-group-sm">
										<span class="input-group-addon">Tổng tiền hàng</span>
										<input type="text" class="form-control" placeholder="Tự động" disabled="disabled">
									</div>
								</li>
								<li class="list-group-item text-center">
									<div class="btn-group">
									<a class="btn btn-danger" onclick="history.back()">Trở về</a>
									<a class="btn btn-warning" id="temp-save">Lưu tạm</a>
									<a class="btn btn-success" id="save">Hoàn tất</a>
									</div>
								</li>
							</ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo $this->Form->end(); ?>

<div id="dialog-form" title="Thêm hàng">
	<p class="validateTips">Không được bỏ trống</p>
	<form>
		<fieldset>
			<label for="qty">Số lượng</label>
			<input type="number" name="name" id="qty" class="text ui-widget-content ui-corner-all" min="1">
			<hr>
			<p><strong>Thuộc tính</strong></p>
			<div id="options-list">

			</div>
			<!-- Allow form submission with keyboard without duplicating the dialog button -->
			<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
		</fieldset>
	</form>
</div>
