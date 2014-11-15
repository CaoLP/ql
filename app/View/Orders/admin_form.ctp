<?php
setlocale(LC_MONETARY, "vi_VN");
if ($this->request->action == 'admin_add')
    $this->Html->addCrumb('<li>Bán hàng</li>', array('action' => 'add'), array('escape' => false));
else
    $this->Html->addCrumb('<li>' . $this->request->data['Order']['id'] . '</li>', '/' . $this->request->url, array('escape' => false));
echo $this->Html->script(array('sale', 'jquery.inputmask', 'customer'), array('inline' => false));
?>
<script>
    var ajax_url = '<?php echo $this->Html->url(array('controller'=>'warehouses','action'=>'product_ajax'))?>';
    var store_id = '<?php echo $this->Session->read('Auth.User.store_id')?>';
    var promotes = <?php echo json_encode($promoteData);?>;
    var customers = <?php echo json_encode($customers);?>;
</script>
<div class="row">
    <div class="col-md-8">
        <div class="widget">
            <div class="widget-header">
                <div class="title pull-right" style="width: 70%">
                    <input class="form-control" id="p-search">
                </div>
                <h3>Nhập hàng</h3>
            </div>
            <?php
            echo $this->Form->create('Order', array('class' => 'form-horizontal'));
            ?>
            <div class="widget-body order-w-b" id="order-product">
                <table id="order-product-list">
                    <?php
                    if($this->request->action == 'admin_edit')
                    if($this->request->data['OrderDetail']){
                        ?>
                        <tr>
                            <th>Stt</th>
                            <th class="text-left">Mã hàng</th>
                            <th class="text-left">Tên hàng</th>
                            <th class="text-right">Giá</th>
                            <th class="text-right">Số lượng</th>
                            <th class="text-right">Thành tiền</th>
                        </tr>
                        <?php
                        foreach($this->request->data['OrderDetail'] as $key=>$order_detail){
                            ?>
                            <tr class="row<?php echo $key?>">
                                <td>
                                    <?php echo $key+1?>
                                </td>
                                <td class="text-left"><span><?php echo $order_detail['code']?></span></td>
                                <td class="text-left"><span>Áo demo</span><br><span class="opt">
                                    <?php
                                    $opts = explode(',',$order_detail['product_options']);
                                    $temp = array();
                                    foreach($opts as $opt){
                                        $temp[] = $options[$opt];
                                    }
                                    $op = implode(',',$temp);
                                    echo $op;
                                    ?></span></td>
                                <td class="text-right"><span class="price-text"><?php echo number_format($order_detail['price'], 0, '.', ','); ?></span></td>
                                <td class="text-right">
                                    <?php echo $order_detail['qty']?>
                                </td>
                                <td class="text-right">
                                    <span class="new-total-price price-text"><?php echo number_format(($order_detail['qty'] * $order_detail['price']),0, '.', ',')?></span>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="widget">
            <div class="widget-header">
                <h3>Thông tin</h3>
            </div>
            <div class="widget-body order-w-b-s">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li class="active"><a href="#info" role="tab" data-toggle="tab">Thông tin</a></li>
                        <li><a href="#note" role="tab" data-toggle="tab">Ghi chú</a></li>
                    </ul>
                    <div class="tab-content content-2">
                        <div class="tab-pane fade in active" id="info">
                            <ul class="list-group no-margin">
                                <li class="list-group-item">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon">Khách hàng</span>
                                        <?php
                                        echo $this->Form->hidden('store_id', array('value' => $this->Session->read('Auth.User.store_id')));
                                        ?>
                                        <input id="input-customer" class="form-control" value="<?php
                                        if(isset($this->request->data['Order']['customer_id']))
                                        echo $customersl[$this->request->data['Order']['customer_id']];
                                        ?>">
                                        <input type="hidden" name="data[Order][customer_id]" id="input-customer-id">
                                            <span class="input-group-btn">
                                                <button class="btn btn-success" type="button" data-toggle="modal"
                                                        data-target="#customer"><i class="icon-plus"></i>
                                                </button>
                                            </span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon">Khuyến mãi</span>
                                        <?php
                                        echo $this->Form->input('promote_id', array('label' => false, 'empty' => true, 'div' => false, 'class' => 'form-control'));
                                        echo $this->Form->hidden('promote_value');
                                        echo $this->Form->hidden('promote_type');
                                        ?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="note">
                            <?php
                            echo $this->Form->input('note', array('label' => false, 'div' => false, 'class' => 'form-control', 'placeholder' => 'Ghi chú', 'rows' => '4'));
                            ?>
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#info-total" role="tab" data-toggle="tab">Thông tin</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="info-total">
                            <ul class="list-group no-margin">
                                <li class="list-group-item">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon">Thành tiền</span>
                                        <?php
                                        echo $this->Form->input('total', array('label' => false, 'type' => 'text', 'div' => false,
                                            'readonly' => 'readonly',
                                            'id' => 'summary-total',
                                            'class' => 'form-control',
                                            'data-inputmask' => '\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
                                        ));
                                        ?>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon">Khuyến mãi</span>
                                        <?php
                                        echo $this->Form->input('total_promote', array('label' => false, 'type' => 'text',
                                            'div' => false,
                                            'readonly' => 'readonly',
                                            'class' => 'form-control',
                                            'data-inputmask' => '\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
                                        ));
                                        ?>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon">Khách phải trả</span>
                                        <?php
                                        echo $this->Form->input('amount', array('label' => false, 'type' => 'text',
                                            'div' => false,
                                            'readonly' => 'readonly',
                                            'class' => 'form-control',
                                            'data-inputmask' => '\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
                                        ));
                                        ?>
                                    </div>
                                </li>
                                <li class="list-group-item"
                                    style="border-bottom: 1px solid rgba(12, 9, 9, 0.68);margin-bottom: 5px;">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon">Đã nhận</span>
                                        <?php
                                        echo $this->Form->input('receive', array('label' => false,
                                            'div' => false,
                                            'type' => 'text',
                                            'class' => 'form-control',
                                            'data-inputmask' => '\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
                                        ));
                                        ?>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon">Trả lại</span>
                                        <?php
                                        echo $this->Form->input('refund', array('label' => false,
                                            'div' => false,
                                            'class' => 'form-control',
                                            'type' => 'text',
                                            'readonly' => 'readonly',
                                            'data-inputmask' => '\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
                                        ));
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
            </div>
            <div class="col-md-12">
                <div class="text-center bt-done">
                    <div class="btn-group">
                        <a class="btn btn-danger" onclick="history.back()">Trở về</a>
                        <?php
                        echo '<button type="submit" class="btn btn-success" id="save">Thanh toán</button>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php echo $this->Form->end(); ?>

<!-- Add this html to your page -->
<div class="modal fade" id="customer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-original-title="">×
                </button>
                <h4 class="modal-title">Khách hàng</h4>
            </div>
            <div class="modal-body">
                <div class="widget-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Tên Khách</div>
                                <input name="data[Customer][name]" class="form-control"
                                       type="text" id="CustomerName" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Số điện thoại</div>
                                <input name="data[Customer][phone]" class="form-control"
                                       type="text" id="CustomerPhone" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Email</div>
                                <input name="data[Customer][email]" class="form-control"
                                       type="text" id="CustomerEmail" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Facebook</div>
                                <input name="data[Customer][facebook]" class="form-control"
                                       type="text" id="CustomerFacebook" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Địa chỉ</div>
                                <input name="data[Customer][address]" class="form-control"
                                       type="text" id="CustomerAddress" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Quận huyện</div>
                                <input name="data[Customer][district]" class="form-control"
                                       type="text" id="CustomerDistrict" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Thành phố</div>
                                <input name="data[Customer][city]" class="form-control"
                                       type="text" id="CustomerCity" required="required">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submit-customer" data-dismiss="modal"
                        data-original-title="">Thêm mới
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal" data-original-title="">Đóng</button>
            </div>
        </div>
    </div>
</div>