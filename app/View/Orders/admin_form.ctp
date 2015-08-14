<?php
setlocale(LC_MONETARY, "vi_VN");
if ($this->request->action == 'admin_add')
    $this->Html->addCrumb('<li>Bán hàng</li>', array('action' => 'add'), array('escape' => false));
else
    $this->Html->addCrumb('<li>' . $this->request->data['Order']['code'] . '</li>', '/' . $this->request->url, array('escape' => false));
echo $this->Html->script(array('sale', 'jquery.inputmask', 'customer'), array('inline' => false));
echo $this->Html->css(array('order'), array('inline' => false));
?>
<script>
    var ajax_url = '<?php echo $this->Html->url(array('controller'=>'warehouses','action'=>'product_ajax'))?>';
    var saveUrl = '<?php echo $this->Html->url(array('controller'=>'orders','action'=>'admin_save_cart'))?>';
    var customerUrl = '<?php echo $this->Html->url(array('controller'=>'customers','action'=>'index'))?>';
    var store_id = '<?php echo $this->Session->read('Auth.User.store_id')?>';
    var promotes = <?php echo json_encode($promoteData);?>;
    var customers = <?php echo json_encode($customers);?>;
    var product_ajax = '<?php echo $this->Html->url(array('controller'=>'warehouses','action'=>'ajax_product'))?>';
    var point_cal = <?php echo Configure::read('point_cal',10000);?>;
</script>
<div class="row">
    <div class="col-md-8">
        <div class="widget">
            <div class="widget-header">
                <div class="title pull-right" style="width: 70%">
                    <input class="form-control" id="p-search" autocomplete='off'>
                </div>
                <h3>Nhập hàng</h3>
            </div>
            <?php
            echo $this->Form->create('Order', array('class' => 'form-horizontal'));
            echo $this->Form->hidden('id');
            echo $this->Form->hidden('code');
            ?>
            <div class="widget-body order-w-b" id="order-product">
                <table id="order-product-list">
                    <tr>
                        <th></th>
                        <th class="text-left">Mã hàng</th>
                        <th class="text-left">Tên hàng</th>
                        <th class="text-right">Giá gốc</th>
                        <th class="text-right">Giá</th>
                        <th class="text-right">Số lượng</th>
                        <th class="text-right">Thành tiền</th>
                    </tr>
                    <?php
                    if(isset($this->request->data['OrderDetail'])){
                        ?>
                        <?php
                        foreach($this->request->data['OrderDetail'] as $key=>$order_detail){
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
                                    <input type="hidden" name="data[OrderDetail][<?php echo $key?>][mod_price]" id="<?php echo $key?>-mod-price" value="<?php echo number_format($data['mod_price'], 0, '.', ',');?>">

                                    </a>
                                </td>
                                <td class="text-right">
                                    <a href="javascript:;" class="price-down"><i class="icon icon-arrow-down"></i></a>
                                    <input class="qty" id="<?php echo $key?>-cur-price" name="data[OrderDetail][<?php echo $key?>][qty]" data-limit="<?php echo $data['warehouse']?>"
                                           data-price="<?php echo $data['mod_price']?>" data-basic_price="<?php echo $data['price']?>" value="<?php echo $order_detail['qty']?>">
                                    <a href="javascript:;" class="price-up"><i class="icon icon-arrow-up"></i></a>
                                </td>
                                <td class="text-right">
                                    <span class="new-total-price price-text"><?php echo number_format(($order_detail['qty'] * $data['mod_price']),0, '.', ',')?></span>
                                    <textarea type="hidden" style="display: none" name="data[OrderDetail][<?php echo $key?>][data]"><?php echo $order_detail['data'];?></textarea>
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
                <h3>Thông tin <?php
                    if(isset($this->request->data['Order']['code']) && !empty($this->request->data['Order']['code']))
                        echo '<span style="color:red;font-size:14px;">('.$this->request->data['Order']['code'].')</span>';
                    ?></h3>
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
                                        <?php
                                        echo $this->Form->hidden('basic_price');
                                        ?>
                                        <?php
                                        echo $this->Form->hidden('flag_type');
                                        ?>
                                        <input id="input-customer" class="form-control" value="<?php
                                        if(isset($this->request->data['Order']['customer_id']) && !empty($this->request->data['Order']['customer_id']))
                                            echo $customersl[$this->request->data['Order']['customer_id']];
                                        else echo $customersl[1];
                                        ?>">
                                        <input type="hidden" name="data[Order][customer_id]" id="input-customer-id" value="<?php
                                        if(isset($this->request->data['Order']['customer_id']) && !empty($this->request->data['Order']['customer_id']))
                                            echo $this->request->data['Order']['customer_id'];
                                        else echo 1;
                                        ?>">
                                            <span class="input-group-btn">
                                                <button class="btn btn-info" type="button" data-toggle="modal"
                                                        data-target="#search-customer"><i class="icon-search"></i>
                                                </button>
                                            </span>
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
                                <?php
                                if($this->Session->read('Auth.User.group_id') == 1){
                                    ?>
                                    <li class="list-group-item">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">Ngày tạo</span>
                                            <?php
                                            echo $this->Form->input('created', array('label' => false,'type'=>'text','readonly'=>'readonly','div' => false, 'class' => 'form-control datepicker2'));
                                            ?>
                                        </div>
                                    </li>
                                <?php
                                }
                                ?>
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
                    <div class="input-group input-group-sm input-total">
                        <span class="input-group-addon">Thành tiền</span>
                        <?php
                        echo $this->Form->input('basic_total', array('label' => false, 'type' => 'text', 'div' => false,
                            'readonly' => 'readonly',
                            'id' => 'summary-total',
                            'class' => 'form-control',
                            'data-inputmask' => '\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
                        ));
                        ?>
                    </div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#info-total" role="tab" data-toggle="tab">Thông tin</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="info-total">
                            <ul class="list-group no-margin">

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
                                <li class="list-group-item">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon">Điểm tích lũy</span>
                                        <?php
                                        echo $this->Form->input('point', array('label' => false,
                                            'div' => false,
                                            'class' => 'form-control',
                                            'type' => 'text',
                                            'readonly' => 'readonly',
                                            'data-inputmask' => '\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
                                        ));
                                        ?>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon">Điểm hiện có</span>
                                        <div class="form-control" id="cur-point">0</div>
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
                <?php
                if ($this->request->action == 'admin_edit'){
                    ?>
                    <textarea style="display: none" name="data[oldData]"><?php echo $this->request->data['oldData'];?></textarea>
                <?php
                }
                ?>
                <div class="text-center bt-done">
                    <div class="btn-group">
                        <a class="btn btn-info" id="refresh">Làm mới</a>
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
<div class="panel-from-left" id="panel-from-left">
    <a href="javascript:;" class="btn-expand"><div class="expand-cart"><i class="icon-cart"></i><br><span class="expand-text">Tìm nhanh</span></div></a>
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('search-input',
                            array(
                                'label'=>false,
                                'placeholder'=>'Tên hoặc mã hàng',
                                'name'=>'q',
                                'id'=>'search-input',
                                'div'=>false,
                                'class'=>'form-control input-sm'
                            )
                        );
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('category_id',
                            array(
                                'label'=>false,
                                'name'=>'search-select',
                                'id'=>'search-select',
                                'div'=>false,
                                'empty'=>true,
                                'class'=>'form-control input-sm'
                            )
                        );
                        ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div id="product-list">
                    <div class="col-md-12 text-center">
                        <img src="/img/select2-spinner.gif">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
                                <div class="input-group-addon">Mã thẻ</div>
                                <input name="data[Customer][code]" class="form-control"
                                       type="text" id="CustomerCode" required="required">
                            </div>
                        </div>
                    </div>
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
                                <div class="input-group-addon">Birthday</div>
                                <div class="input-group-addon" style="width: 10%">Ngày</div>
                                <input name="data[Customer][birthday][day]" class="input-sm"
                                   num-max="31" data-type="number" min="1" max="2" type="text" required="required">
                                <div class="input-group-addon" style="width: 10%">Tháng</div>
                                <input name="data[Customer][birthday][month]" class="input-sm"
                                   num-max="12" data-type="number" min="1" max="2" type="text" required="required">
                                <div class="input-group-addon" style="width: 10%">Năm</div>
                                <input name="data[Customer][birthday][year]" class="input-sm"
                                   data-type="number" min="4" max="4" type="text" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Giới tính</div>
                                <div class="input-group-addon" style="width: 30%">Nam
                                    <input name="data[Customer][gender]" class="form-control"
                                           type="radio" checked required="required" value="0">
                                </div>
                                <div class="input-group-addon" style="width: 30%">Nữ
                                    <input name="data[Customer][gender]" class="form-control"
                                           type="radio" required="required" value="1">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Email</div>
                                <input name="data[Customer][email]" class="form-control"
                                       type="text" id="CustomerEmail">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Facebook</div>
                                <input name="data[Customer][facebook]" class="form-control"
                                       type="text" id="CustomerFacebook">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Địa chỉ</div>
                                <input name="data[Customer][address]" class="form-control"
                                       type="text" id="CustomerAddress">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Quận huyện</div>
                                <input name="data[Customer][district]" class="form-control"
                                       type="text" id="CustomerDistrict">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Thành phố</div>
                                <input name="data[Customer][city]" class="form-control"
                                       type="text" id="CustomerCity">
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
<div class="modal fade" id="search-customer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-original-title="">×
                </button>
                <h4 class="modal-title">Tìm kiếm khách hàng</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-success">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" placeholder="Nhập tên hoặc SĐT" name="term" id="search-customer-input">
                                    <div class="input-group-btn">
                                        <button class="btn btn-info" id="search-customer-btn"><i class="icon-search"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Mã thành viên</th>
                                    <th>Tên</th>
                                    <th>Số điện thoại</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="customer-table">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>

</div>