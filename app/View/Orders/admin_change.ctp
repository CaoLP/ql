<?php
setlocale(LC_MONETARY, "vi_VN");
$this->Html->addCrumb('<li>' . $this->request->data['Order']['id'] . '</li>', '/' . $this->request->url, array('escape' => false));
echo $this->Html->script(array('sale', 'jquery.inputmask','change'), array('inline' => false));
?>
<script>
    var product_ajax = '<?php echo $this->Html->url(array('controller'=>'warehouses','action'=>'ajax_product'))?>';
    var ajax_url = '<?php echo $this->Html->url(array('controller'=>'warehouses','action'=>'product_ajax'))?>';
    var store_id = '<?php echo $this->request->data['Order']['store_id'];?>';
</script>
<div class="row">
<div class="col-md-8">
    <div class="widget">
        <div class="widget-header">
            <h3>Đơn hàng</h3>
        </div>
        <?php
        echo $this->Form->create('Order', array('class' => 'form-horizontal'));
        ?>
        <div class="widget-body order-w-b" id="order-product">
            <table id="order-product-list">
                <?php
                if($this->request->data['OrderDetail']){
                    ?>
                    <tr>
                        <th>Stt</th>
                        <th></th>
                        <th  style="width: 150px" class="text-left">Mã hàng</th>
                        <th  style="width: 250px" class="text-left">Tên hàng</th>
                        <th class="text-right">Giá</th>
                        <th class="text-right">Số lượng</th>
                        <th class="text-right">Thành tiền</th>
                    </tr>
                    <?php
                    foreach($this->request->data['OrderDetail'] as $key=>$order_detail){
                        ?>
                        <tr class="row_table" data-key="<?php echo $key?>">
                            <td>
                                <?php echo $key+1?>
                            </td>
                            <td>

                            </td>
                            <td class="text-left"><span><?php echo $order_detail['code']?></span></td>
                            <td class="text-left"><span><?php
                                    echo $order_detail['name']
                                    ?></span><br><span class="opt">
                                    <?php
                                    $opts = explode(',',$order_detail['product_options']);
                                    $temp = array();
                                    foreach($opts as $opt){
                                        if(isset($options[$opt]))
                                            $temp[] = $options[$opt];
                                    }
                                    $op = implode(',',$temp);
                                    echo $op;
                                    ?></span></td>
                            <td class="text-right"><span class="price-text"><?php echo number_format($order_detail['price'], 0, '.', ','); ?></span></td>
                            <td class="text-right" id="old-qty-text-<?php echo $key;?>" qty="<?php echo $order_detail['qty']?>" staticQty="<?php echo $order_detail['qty']?>">
                                <?php echo $order_detail['qty']?>
                            </td>
                            <td class="text-right">
                                <span id="new-total-price-<?php echo $key;?>" class="price-text get-total" price="<?php echo $order_detail['price'];?>" total="<?php echo ($order_detail['qty'] * $order_detail['price']);?>"><?php echo number_format(($order_detail['qty'] * $order_detail['price']),0, '.', ',')?></span>
                            </td>
                            <?php
                            $temp_data = $order_detail;
                            unset($temp_data['data'])
                            ?>
                            <textarea style="display: none;" name="OrderDetail[<?php echo $key;?>][oldData]" ><?php echo json_encode($temp_data);?></textarea>
                        </tr>
                        <tr style="background-color: rgba(229, 255, 202, 0.33)">
                            <td colspan="7"><input class="form-control input-sm product-p"  data-key="#tb-<?php echo $key;?>"></td>
                        </tr>
                        <tr class="row_<?php echo $key?>_table">
                            <td colspan="7" style="padding: 0">
                                <table id="tb-<?php echo $key;?>" data-id="<?php echo $key;?>" data-total="<?php echo $order_detail['qty'];?>">
                                </table>
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
                                    <input id="input-customer" class="form-control" readonly="readonly" value="<?php
                                    echo $customers[$this->request->data['Order']['customer_id']];
                                    ?>">
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Khuyến mãi</span>
                                    <?php
                                    echo $this->Form->input('promote_id', array('disabled'=>'disabled','label' => false, 'empty' => true, 'div' => false, 'class' => 'form-control'));
                                    echo $this->Form->hidden('promote_value');
                                    echo $this->Form->hidden('promote_type');
                                    ?>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Trạng thái</span>
                                    <?php
                                    echo $this->Form->input('status', array('disabled'=>'disabled','label' => false, 'empty' => true, 'div' => false, 'class' => 'form-control'));
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
                                        'readonly' => 'readonly',
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
                    <button type="submit" class="btn btn-success">Chấp nhận</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php echo $this->Form->end(); ?>
