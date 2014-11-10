<?php
setlocale(LC_MONETARY, "vi_VN");
if ($this->request->action == 'admin_add')
    $this->Html->addCrumb('<li>Bán hàng</li>', array('action' => 'add'), array('escape' => false));
else
    $this->Html->addCrumb('<li>' . $order['Order']['id'] . '</li>', '/' . $this->request->url, array('escape' => false));
echo $this->Html->script(array('sale','jquery.inputmask'), array('inline' => false));
?>
    <script>
        var ajax_url = '<?php echo $this->Html->url(array('controller'=>'warehouses','action'=>'product_ajax'))?>';
        var store_id = '<?php echo $this->Session->read('Auth.User.store_id')?>';
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
                <div class="widget-body order-w-b" id="order-product">
                    <table id="order-product-list">

                    </table>
                </div>
            </div>
        </div>
        <?php
        echo $this->Form->create('Order', array('class' => 'form-horizontal'));
        ?>
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
                                            echo $this->Form->input('customer', array('label' => false, 'div' => false, 'class' => 'form-control'));
                                            ?>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">Khuyến mãi</span>
                                            <?php
                                            echo $this->Form->input('promote_id', array('label' => false, 'empty'=>true,'div' => false, 'class' => 'form-control'));
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
                                            echo $this->Form->input('total', array('label' => false,'type'=>'text', 'div' => false,
                                                'readonly'=>'readonly',
                                                'id'=>'summary-total',
                                                'class' => 'form-control',
                                                'data-inputmask'=>'\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
                                            ));
                                            ?>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">Khuyến mãi</span>
                                            <?php
                                            echo $this->Form->input('total_promote', array('label' => false,'type'=>'text',
                                                'div' => false,
                                                'readonly'=>'readonly',
                                                'class' => 'form-control',
                                                'data-inputmask'=>'\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
                                            ));
                                            ?>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">Khách phải trả</span>
                                            <?php
                                            echo $this->Form->input('amount', array('label' => false,'type'=>'text',
                                                'div' => false,
                                                'readonly'=>'readonly',
                                                'class' => 'form-control',
                                                'data-inputmask'=>'\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
                                            ));
                                            ?>
                                        </div>
                                    </li>
                                    <li class="list-group-item" style="border-bottom: 1px solid rgba(12, 9, 9, 0.68);margin-bottom: 5px;">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">Đã nhận</span>
                                            <?php
                                            echo $this->Form->input('receive', array('label' => false,
                                                'div' => false,
                                                'class' => 'form-control',
                                                'data-inputmask'=>'\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
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
                                                'readonly'=>'readonly',
                                                'data-inputmask'=>'\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
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
