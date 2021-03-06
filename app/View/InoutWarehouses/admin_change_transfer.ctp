<?php
$this->Html->addCrumb('<li>' . $title_for_layout . '</li>', array('action' => 'index'), array('escape' => false));
$this->Html->addCrumb('<li>Phiếu xuất ' . $this->request->data['InoutWarehouse']['code'] . '</li>', '/' . $this->request->url, array('escape' => false));
echo $this->Html->script(array('edit_warehouse_transferred'), array('inline' => false));
?>
<script>
    var ajax_url = '<?php
        echo $this->Html->url(array('controller'=>'warehouses','action'=>'product_ajax'));
    ?>';
    var optionData = JSON.parse('<?php echo json_encode($options)?>');
    var inout_warehouse_id = '<?php echo $this->request->data['InoutWarehouse']['id']?>';
</script>
<div class="row">
    <div class="col-md-8">
        <div class="widget-header">
            <div class="title pull-right" style="width: 70%">
                <input class="form-control" id="p-search">
            </div>
            <h3>Nhập hàng</h3>
        </div>
        <?php
        echo $this->Form->create('InoutWarehouse', array('class' => 'form-horizontal'));
        ?>
        <div class="widget-body">
            <table class="table table-condensedtable-hover no-margin">
                <tbody id="product-list">
                <?php
                if (isset($this->request->data['InoutWarehouseDetail']))
                    foreach ($this->request->data['InoutWarehouseDetail'] as $key=>$item) {
                        $summary = $item['qty'] * $item['price'];
                        $limit = 0;
                        if(isset($limits[$item['sku']])) $limit = $limits[$item['sku']];
                        $over = false;
                        if($item['qty'] > $limit) $over = true;
                        ?>
                        <tr class="first-tr row<?php echo $key?>" data-id="<?php echo $item['sku']?>">
                            <td><?php echo $item['sku']?></td>
                            <td><?php echo $item['name']?></td>
                            <td><span class="price-text"><?php echo number_format($item['price'], 0, '.', ',');?></span></td>
                            <td class="hidden-qty-text <?php if($over) echo 'bg-danger'; ?>">
                                <a href="javascript:;" class="price-down"><i class="icon icon-arrow-down"></i></a>
                                <input type="text" class="hidden-qty <?php if($over) echo 'error-input text-error'; ?>" data-price="<?php echo $item['price']?>"
                                       data-limit="<?php echo $limit;?>"
                                       name="data[InoutWarehouseDetail][<?php echo $key?>][qty]"
                                       value="<?php echo $item['qty']?>">
                                <a href="javascript:;"class="price-up"><i class="icon icon-arrow-up"></i></a>
                                <strong> of (<?php echo $limit;?>)</strong>
                            </td>
                            <td><span class="price-text total-price"><?php echo number_format($summary, 0, '.', ',');?></span></td>
                        </tr>
                        <tr class="last-tr row<?php echo $key?>">
                            <td class="text-left"><a href="javascript:;" class="remove-row"
                                                     data-needremove=".row<?php echo $key?>"><i
                                        class="icon icon-close"></i></a></td>
                            <td colspan="3" class="text-right"><span>Thuộc tính : </span><span
                                    class="options"><?php
                                    echo $item['option_names']
                                    ?></span>
                            </td>
                            <td>
                                <input type="hidden" name="data[InoutWarehouseDetail][<?php echo $key?>][product_id]" value="<?php echo $item['product_id']?>">
                                <input type="hidden" name="data[InoutWarehouseDetail][<?php echo $key?>][inout_warehouse_id]" value="<?php echo $item['inout_warehouse_id']?>">
                                <input type="hidden" name="data[InoutWarehouseDetail][<?php echo $key?>][sku]" value="<?php echo $item['sku']?>">
                                <input type="hidden" name="data[InoutWarehouseDetail][<?php echo $key?>][price]" value="<?php echo $item['price']?>">
                                <input type="hidden" name="data[InoutWarehouseDetail][<?php echo $key?>][retail_price]" value="<?php echo $item['retail_price']?>">
                                <input type="hidden" name="data[InoutWarehouseDetail][<?php echo $key?>][name]" value="<?php echo $item['name']?>">
                                <textarea
                                    style="display: none"
                                    name="data[InoutWarehouseDetail][<?php echo $key?>][options]"><?php echo $item['options']?></textarea>
                                <textarea
                                    style="display: none" name="data[InoutWarehouseDetail][<?php echo $key?>][option_names]"><?php echo $item['option_names']?></textarea>
                            </td>
                        </tr>
                    <?php
                    }
                ?>
                </tbody>
            </table>

        </div>
    </div>
    <div class="col-md-4 right-bar">
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
                            <?php
                            if($this->request->data['InoutWarehouse']['type']==1){
                                ?>
                                <li class="list-group-item">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon">Ngày chuyển</span>
                                        <?php
                                        echo $this->Form->input('tranfered', array('type'=>'text','label' => false, 'div' => false, 'class' => 'form-control datepicker','readonly'=>'readonly'));
                                        ?>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                            <li class="list-group-item">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Cửa hàng</span>
                                    <?php
                                    echo $this->Form->input('store_id', array('label' => false, 'div' => false, 'class' => 'form-control'));
                                    ?>
                                </div>
                            </li>
                            <?php
                            if($this->request->data['InoutWarehouse']['type']==1){
                                ?>
                                <li class="list-group-item">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon">Cửa hàng nhận</span>
                                        <?php
                                        echo $this->Form->input('store_receive_id', array('label' => false, 'div' => false, 'class' => 'form-control','options'=>$stores));
                                        ?>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                            <li class="list-group-item">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Loại</span>
                                    <span type="text" class="form-control"><?php echo $wtypes[$this->request->data['InoutWarehouse']['type']]?></span>
                                    <?php
                                    echo $this->Form->hidden('id');
                                    echo $this->Form->hidden('type');
                                    echo $this->Form->hidden('status');
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
                                    <!--<a class="btn btn-warning" id="temp-save">Lưu tạm</a>-->
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
            <input type="hidden" name="retail_price" id="p-retail_price">
            <input type="hidden" name="data" id="p-data">
            <input type="hidden" name="options" id="p-options">
            <input type="hidden" name="optionsName" id="p-optionsName">
            <input type="hidden" name="limit" id="p-limit">
            <input type="hidden" name="warehouse" id="p-warehouse">
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>
