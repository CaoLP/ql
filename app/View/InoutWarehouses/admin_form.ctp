<?php
$this->Html->addCrumb('<li>' . $title_for_layout . '</li>', array('action' => 'index'), array('escape' => false));
if ($this->request->params['action'] == 'admin_add') {
    $this->Html->addCrumb('<li>Xuất kho</li>', '/' . $this->request->url, array('escape' => false));
} else {
    $this->Html->addCrumb('<li>Phiếu xuất' . $this->request->data['InoutWarehouse']['id'] . '</li>', '/' . $this->request->url, array('escape' => false));
}
echo $this->Html->script(array('warehouse'), array('inline' => false)
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
                <tbody id="product-list">
                <?php
                if (isset($this->request->data['ProductList']))
                    foreach ($this->request->data['ProductList'] as $key=>$item) {
                        $data = json_decode($item['Product']['data'],true);
                        $summary = $item['Product']['qty'] * $data['price'];
                        ?>
                        <tr class="first-tr row<?php echo $key?>" data-id="<?php echo $data['id']?>" data-options="<?php echo htmlentities($item['Product']['option'])?>">
                            <td><?php echo $data['sku']?></td>
                            <td><?php echo $data['name']?></td>
                            <td><span class="price-text"><?php echo number_format($data['price'], 2, '.', ',');?></span></td>
                            <td class="hidden-qty-text">
                                <a href="javascript:;" class="price-down"><i class="icon icon-arrow-down"></i></a>
                                <input type="text" class="hidden-qty" data-price="<?php echo $data['price']?>" name="data[ProductList][<?php echo $key?>][Product][qty]" value="<?php echo $item['Product']['qty']?>">
                                <a href="javascript:;"class="price-up"><i class="icon icon-arrow-up"></i></a>
                            </td>
                            <td><span class="price-text total-price"><?php echo number_format($summary, 2, '.', ',');?></span></td>
                        </tr>
                        <tr class="last-tr row<?php echo $key?>">
                            <td class="text-left"><a href="javascript:;" class="remove-row"
                                                     data-needremove=".row<?php echo $key?>"><i
                                        class="icon icon-close"></i></a></td>
                            <td colspan="3" class="text-right"><span>Thuộc tính : </span><span
                                    class="options"><?php
                                     echo implode(',',json_decode($item['Product']['optionName'],true))
                                    ?></span>
                            </td>
                            <td>
                                <textarea style="display: none" name="data[ProductList][<?php echo $key?>][Product][data]"><?php echo $item['Product']['data']?></textarea>
                                <textarea
                                    style="display: none"
                                    name="data[ProductList][<?php echo $key?>][Product][option]"><?php echo $item['Product']['option']?></textarea><textarea
                                    style="display: none" name="data[ProductList][<?php echo $key?>][Product][optionName]"><?php echo $item['Product']['optionName']?></textarea>
                            </td>
                        </tr>
                    <?php
                    }
                ?>
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
                            <!-- <li class="list-group-item">
                                 <div class="input-group">
                                     <input type="text" class="form-control" placeholder="Nhà cung cấp">
                               <span class="input-group-btn">
                                 <a class="btn btn-default" type="button" data-original-title=""><i class="icon-plus"></i></a>
                               </span>
                                 </div>
                             </li>
                             <li class="list-group-item"><strong>Nhà cung cấp chưa xác định</strong></li>-->
                            <li class="list-group-item">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Cửa hàng</span>
                                    <?php
                                    echo $this->Form->input('store_id', array('label' => false, 'div' => false, 'class' => 'form-control'));
                                    ?>
                                </div>
                             </li>
                            <li class="list-group-item">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Trạng thái</span>
                                    <span type="text" class="form-control">Phiếu tạm</span>
                                    <?php
                                    echo $this->Form->hidden('type', array('value' => '0'));
                                    echo $this->Form->hidden('status', array('value' => '0'));
                                    ?>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Mã phiếu</span>
                                    <?php
                                    echo $this->Form->input('code', array('label' => false, 'div' => false, 'class' => 'form-control', 'placeholder' => 'Tự động'));
                                    ?>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <div class="tab-pane fade" id="note">
                        <?php
                        echo $this->Form->input('note', array('label' => false, 'div' => false, 'class' => 'form-control', 'placeholder' => 'Ghi chú', 'rows' => '8'));
                        ?>
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
                                    <?php
                                    echo $this->Form->input('P.total', array('id'=>'summary-total','readonly'=>'readonly','label' => false, 'div' => false, 'class' => 'form-control'));
                                    ?>
                                </div>
                            </li>
                            <li class="list-group-item text-center">
                                <div class="btn-group">
                                    <a class="btn btn-danger" onclick="history.back()">Trở về</a>
                                    <a class="btn btn-warning" id="temp-save">Lưu tạm</a>
                                    <button type="submit" class="btn btn-success" id="save">Hoàn tất</button>
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
            <input type="number" name="qty" id="qty" class="text ui-widget-content ui-corner-all" min="1">
            <input type="hidden" name="id" id="p-id">
            <input type="hidden" name="sku" id="p-sku">
            <input type="hidden" name="name" id="p-name">
            <input type="hidden" name="price" id="p-price">
            <input type="hidden" name="data" id="p-data">
            <hr>
            <p><strong>Thuộc tính</strong></p>

            <div id="options-list">

            </div>
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>
