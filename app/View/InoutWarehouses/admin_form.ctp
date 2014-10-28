<?php
$this->Html->addCrumb('<li>' . $title_for_layout . '</li>', array('action' => 'index'), array('escape' => false));
if ($this->request->params['action'] == 'admin_add') {
    $this->Html->addCrumb('<li>Xuất kho</li>', '/' . $this->request->url, array('escape' => false));
} else {
    $this->Html->addCrumb('<li>Phiếu xuất' . $this->request->data['InoutWarehouse']['id'] . '</li>', '/' . $this->request->url, array('escape' => false));
}
echo $this->Form->create('InoutWarehouse', array('class' => 'form-horizontal'));
?>
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
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="info">
                            <ul class="list-group no-margin">
                                <li class="list-group-item">
                                    <div class="input-group">
                                        <input type="text" class="form-control">
                                  <span class="input-group-btn">
                                    <a class="btn btn-default" type="button" data-original-title=""><i class="icon-plus"></i></a>
                                  </span>
                                    </div>
                                </li>
                                <li class="list-group-item">Porta ac consectetur ac</li>
                                <li class="list-group-item">Vestibulum at eros</li>
                            </ul>

                        </div>
                        <div class="tab-pane fade" id="note">...</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li class="active"><a href="#sell" role="tab" data-toggle="tab">Thanh toán</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="sell">...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo $this->Form->end(); ?>