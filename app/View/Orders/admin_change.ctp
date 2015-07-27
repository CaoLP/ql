<?php
setlocale(LC_MONETARY, "vi_VN");
$this->Html->addCrumb('<li>' . $this->request->data['Order']['id'] . '</li>', '/' . $this->request->url, array('escape' => false));
echo $this->Html->script(array('jquery.inputmask','change'), array('inline' => false));
?>
<script>
    var product_ajax = '<?php echo $this->Html->url(array('controller'=>'warehouses','action'=>'ajax_product'))?>';
    var ajax_url = '<?php echo $this->Html->url(array('controller'=>'warehouses','action'=>'product_ajax'))?>';
    var store_id = '<?php echo $this->request->data['Order']['store_id'];?>';
    var point_cal = <?php echo Configure::read('point_cal',10000);?>;
</script>
<div class="row">
<div class="col-md-8">
    <div class="widget">
        <div class="widget-header">
            <div class="title pull-right" style="width: 70%">
                <input class="form-control" id="p-search" autocomplete='off'>
            </div>
            <h3>Đổi hàng</h3>
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
                        <th></th>
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
                                <a href="javascript:;" class="remove-row" ><i class="glyphicon glyphicon-trash"></i></a>
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
                            <td class="text-right"><span class="price-text"><?php echo $this->Common->formatMoney($order_detail['price']); ?></span></td>
                            <td class="text-right" id="old-qty-text-<?php echo $key;?>" qty="<?php echo $order_detail['qty']?>" staticQty="<?php echo $order_detail['qty']?>">
                                <a href="javascript:;" class="price-down"><i class="glyphicon glyphicon-minus-sign"></i></a>
                                <input class="qty" id="<?php echo $key?>-cur-price" name="data[OrderDetail][<?php echo $key?>][qty]" data-limit="<?php echo $order_detail['qty']?>"
                                       data-price="<?php echo $order_detail['price']?>"  value="<?php echo $order_detail['qty']?>">
                                <a href="javascript:;" class="price-up"><i class="glyphicon glyphicon-plus-sign"></i></a>
                            </td>
                            <td class="text-right">
                                <span id="new-total-price-<?php echo $key;?>" class="price-text new-total-price" price="<?php echo $order_detail['price'];?>" total="<?php echo ($order_detail['qty'] * $order_detail['price']);?>"><?php echo $this->Common->formatMoney(($order_detail['qty'] * $order_detail['price']))?></span>
                                <?php
                                $temp_data = $order_detail;
                                unset($temp_data['data'])
                                ?>
                                <textarea style="display: none;" name="data[OrderDetail][<?php echo $key;?>][oldData]" ><?php echo json_encode($temp_data);?></textarea>
                            </td>

                        </tr>
                    <?php
                    }

                    ?>
                <?php
                }
                ?>
            </table>
            <hr>
            <table id="new-order-product-list">
                <tr>
                    <th width="41"></th>
                    <th class="text-left">Mã hàng</th>
                    <th class="text-left">Tên hàng</th>
                    <th class="text-right">Giá gốc</th>
                    <th class="text-right">Giá</th>
                    <th class="text-right">Số lượng</th>
                    <th class="text-right">Thành tiền</th>
                </tr>
                <?php
                if(isset($this->request->data['NewOrderDetail'])){
                    ?>
                    <?php
                    foreach($this->request->data['NewOrderDetail'] as $key=>$order_detail){
                        $data = json_decode($order_detail['data'], true);
                        if(!isset($data['mod_price'])) $data['mod_price'] = $order_detail['price'];
                        ?>
                        <tr class="row<?php echo $key?>" data-id="<?php echo $data['id']?>" data-options="<?php echo $data['options']?>">
                            <td>
                                <a href="javascript:;" class="remove-row" data-needremove=".row<?php echo $key?>"><i class="icon-close"></i></a>
                            </td>
                            <td class="text-left"><span><?php echo $data['code']?></span></td>
                            <td class="text-left"><span><?php echo $data['name']?></span><br><span class="opt">
                                   <?php echo $data['optionsName']?></span></td>
                            <td class="text-right">
                                <span class="price-text"><?php echo number_format($data['price'], 0, '.', ','); ?></span>
                            </td>
                            <td class="text-right">
                                <a href="javascript:;" class="pov" data-price="<?php echo $data['price']?>" data-key="<?php echo $key?>">
                                    <span class="price-text" id="<?php echo $key?>-price-text">
                                        <?php echo number_format($data['mod_price'], 0, '.', ','); ?></span> <i class="icon icon-pen"></i>
                                    <input type="hidden" name="data[NewOrderDetail][<?php echo $key?>][mod_price]" id="<?php echo $key?>-mod-price" value="<?php echo number_format($data['mod_price'], 0, '.', ',');?>">

                                </a>
                            </td>
                            <td class="text-right">
                                <a href="javascript:;" class="price-down"><i class="glyphicon glyphicon-minus-sign"></i></a>
                                <input class="qty" id="<?php echo $key?>-cur-price" name="data[NewOrderDetail][<?php echo $key?>][qty]" data-limit="<?php echo $data['warehouse']?>"
                                       data-price="<?php echo $data['mod_price']?>" data-basic_price="<?php echo $data['price']?>" value="<?php echo $order_detail['qty']?>">
                                <a href="javascript:;" class="price-up"><i class="glyphicon glyphicon-plus-sign"></i></a>
                            </td>
                            <td class="text-right">
                                <span class="new-total-price price-text"><?php echo number_format(($order_detail['qty'] * $data['mod_price']),0, '.', ',')?></span>
                                <textarea type="hidden" style="display: none" name="data[NewOrderDetail][<?php echo $key?>][data]"><?php echo $order_detail['data'];?></textarea>
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
                                    <span class="input-group-addon">Đã thanh toán</span>
                                    <?php
                                    echo $this->Form->input('amount', array('label' => false, 'type' => 'text',
                                                                            'id' =>"paid",
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
