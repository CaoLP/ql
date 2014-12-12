<?php
setlocale(LC_MONETARY, "vi_VN");
if ($showBtn)
    $this->Html->addCrumb('<li>Phiếu nhập hàng chờ duyệt</li>', array('action' => 'in'), array('escape' => false));
else
    $this->Html->addCrumb('<li>' . $title_for_layout . '</li>', array('action' => 'index'), array('escape' => false));
$this->Html->addCrumb('<li>' . $inoutWarehouse['InoutWarehouse']['code'] . '</li>', '/' . $this->request->url, array('escape' => false));

echo $this->Html->script(array('warehouse_transferred','inout_view'), array('inline' => false));
echo $this->Html->css(array('check_receive'), array('inline' => false));
echo $this->Form->create('InoutWarehouse', array('class' => 'form-horizontal','url'=>array(
    'controller'=>'inout_warehouses','action'=>'approve_transfer'
)));
echo $this->Form->hidden('received');
?>
    <div class="row">
        <div class="col-md-8">
            <div class="widget-header">
                <h3><?php echo __ ('Hoá đơn nhâp-xuất : ') . $inoutWarehouse['InoutWarehouse']['code']; ?></h3>
            </div>
            <div class="widget-body">
                <table class="table table-condensedtable-hover no-margin">
                    <thead>
                    <th>Mã hàng hóa</th>
                    <th>Tên hàng hóa</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Đã nhận</th>
                    <th>Thành tiền</th>
                    </thead>
                    <tbody id="product-list">
                    <?php
                    if (isset($this->request->data['InoutWarehouseDetail']))
                        foreach ($this->request->data['InoutWarehouseDetail'] as $key => $item) {
                            $summary = $item['qty'] * $item['price'];
                            ?>
                            <tr class="first-tr row<?php echo $key ?>" data-id="<?php echo $item['product_id'] ?>"
                                data-options="<?php echo htmlentities($item['options']) ?>">
                                <td><?php echo $item['sku'] ?></td>
                                <td><?php echo $item['name'] ?></td>
                                <td><span
                                        class="price-text"><?php echo number_format($item['price'], 0, '.', ','); ?></span>
                                </td>
                                <td class="hidden-qty-text text-center">
                                    <?php echo $item['qty'] ?>
                                </td>
                                <td class="text-right"><span
                                        class="price-text total-price"><?php echo number_format($summary, 0, '.', ','); ?></span>
                                </td>
                                <td class="hidden-qty-text">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="hidden-qty form-control" data-limit="<?php echo $item['qty'] ?>" data-price="<?php echo $item['price'] ?>"
                                               name="data[InoutWarehouseDetail][<?php echo $key ?>][qty_received]"
                                               value="<?php echo $item['qty_received']?$item['qty_received']:0;?>">
                                          <span class="input-group-btn">
                                            <a href="javascript:;"  class="btn btn-info btn-sm btn-fill-all">All</a>
                                          </span>
                                    </div>
                                </td>
                                <td class="text-right"><span
                                        class="price-text new-total-price"><?php echo number_format(($item['qty_received'] * $item['price']), 0, '.', ','); ?></span>
                                </td>
                            </tr>
                            <tr class="last-tr row<?php echo $key ?>">
                                <td class="text-left"></td>
                                <td colspan="3" class="text-left"><span>Thuộc tính : </span><span
                                        class="options"><?php
                                        echo $item['option_names']
                                        ?></span>
                                </td>
                                <td> </td>
                                <td> </td>
                                <td><?php
                                    echo $this->Form->hidden('InoutWarehouseDetail.'.$key.'.id',array('value'=>$item['id']));
                                    echo $this->Form->hidden('InoutWarehouseDetail.'.$key.'.product_id',array('value'=>$item['product_id']));
                                    echo $this->Form->hidden('InoutWarehouseDetail.'.$key.'.options',array('value'=>$item['options']));
                                    echo $this->Form->hidden('InoutWarehouseDetail.'.$key.'.price',array('value'=>$item['price']));
                                    echo $this->Form->hidden('InoutWarehouseDetail.'.$key.'.retail_price',array('value'=>$item['retail_price']));
                                    echo $this->Form->hidden('InoutWarehouseDetail.'.$key.'.sku',array('value'=>$item['sku']));
                                    ?></td>
                            </tr>
                        <?php
                        }
                    ?>
                    <tr class="first-tr last-tr">
                        <td colspan="5" class="text-right"><span class="price-text"><?php echo number_format($this->request->data['InoutWarehouse']['total'], 0, '.', ','); ?></span></td>
                        <td colspan="2" class="text-right"><span id="summary-total" class="price-text"></span></td>
                    </tr>
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
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content content-1">
                        <div class="tab-pane fade in active" id="info">
                            <table class="table table-striped table-hover">
                                <tbody>
                                <tr>
                                    <td><?php echo __ ('Mã số'); ?></td>
                                    <td>
                                        <?php echo h ($inoutWarehouse['InoutWarehouse']['code']); ?>
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo __ ('Loại hoá đơn'); ?></td>
                                    <td>
                                        <?php echo h ($wtypes[$inoutWarehouse['InoutWarehouse']['type']]); ?>
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo __ ('Cửa hàng xuất'); ?></td>
                                    <td>
                                        <?php echo $this->Html->link ($inoutWarehouse['Store']['name'], array ('controller' => 'stores', 'action' => 'view', $inoutWarehouse['Store']['id'])); ?>
                                        &nbsp;
                                    </td>
                                </tr>
                                <?php if($inoutWarehouse['InoutWarehouse']['store_receive_id']) :?>
                                    <tr>
                                        <td><?php echo __ ('Cửa hàng nhập'); ?></td>
                                        <td>
                                            <?php
                                            echo $this->Html->link ($inoutWarehouse['ReceiveStore']['name'], array ('controller' => 'stores', 'action' => 'view', $inoutWarehouse['ReceiveStore']['id']));
                                            echo $this->Form->hidden('InoutWarehouse.store_receive_id',array('value'=>$inoutWarehouse['InoutWarehouse']['store_receive_id']));
                                            ?>
                                            &nbsp;
                                        </td>
                                    </tr>
                                <?php endif;?>
                                <?php if($inoutWarehouse['Customer']['id']) :?>
                                    <tr>
                                        <td><?php echo __ ('Khách hàng'); ?></td>
                                        <td>
                                            <?php echo $this->Html->link ($inoutWarehouse['Customer']['id'], array ('controller' => 'customers', 'action' => 'view', $inoutWarehouse['Customer']['id'])); ?>
                                            &nbsp;
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td><?php echo __ ('Tổng tiền'); ?></td>
                                    <td>
                                        <?php echo money_format('%.0n',h ($inoutWarehouse['InoutWarehouse']['total'])); ?>
                                        &nbsp;
                                    </td>
                                </tr>
                                <?php if($inoutWarehouse['InoutWarehouse']['received']) :?>
                                    <tr>
                                        <td><?php echo __ ('Đã nhận'); ?></td>
                                        <td>
                                            <?php echo h ($inoutWarehouse['InoutWarehouse']['received']); ?>
                                            &nbsp;
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if($inoutWarehouse['InoutWarehouse']['refund']) :?>
                                    <tr>
                                        <td><?php echo __ ('Trả lại'); ?></td>
                                        <td>
                                            <?php echo h ($inoutWarehouse['InoutWarehouse']['refund']); ?>
                                            &nbsp;
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td><?php echo __ ('Ngày tạo'); ?></td>
                                    <td>
                                        <?php echo h ($inoutWarehouse['InoutWarehouse']['created']); ?>
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo __ ('Người tạo'); ?></td>
                                    <td>
                                        <?php echo $this->Html->link($inoutWarehouse['Creater']['name'], array('controller' => 'users', 'action' => 'view', $inoutWarehouse['InoutWarehouse']['created_by'])); ?>
                                        &nbsp;
                                    </td>
                                </tr>
                                <?php if($inoutWarehouse['InoutWarehouse']['approved']) :?>
                                    <tr>
                                        <td><?php echo __ ('Ngày duyệt nhập'); ?></td>
                                        <td>
                                            <?php echo h ($inoutWarehouse['InoutWarehouse']['approved']); ?>
                                            &nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo __ ('Người duyệt nhập'); ?></td>
                                        <td>
                                            <?php echo $this->Html->link($inoutWarehouse['Approver']['name'], array('controller' => 'users', 'action' => 'view', $inoutWarehouse['InoutWarehouse']['approved_by'])); ?>
                                            &nbsp;
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td><?php echo __ ('Ghi chú'); ?></td>
                                    <td>
                                        <?php echo h ($inoutWarehouse['InoutWarehouse']['note']); ?>
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><?php echo __ ('Ghi chú nhận hàng'); ?></td>

                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <?php
                                        echo $this->Form->input('InoutWarehouse.receive_note',array('label'=>false,'div'=>false,'class'=>'form-control','col'=>'8'));
                                        ?>
                                        &nbsp;
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <ul class="list-group no-margin">
                        <li class="list-group-item text-center">
                            <div class="btn-group">
                                <a class="btn btn-danger" onclick="history.back()">Trở về</a>
                                <!--<a class="btn btn-warning" id="temp-save">Lưu tạm</a>-->
                                <?php
                                if($this->request->data['InoutWarehouse']['status']!=1)
                                    echo '<button type="submit" class="btn btn-success" id="save">Nhận hàng</button>';
                                ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php echo $this->Form->end(); ?>

<div class="panel-from-left" id="panel-from-left">
    <a href="javascript:;" class="btn-expand"><div class="expand-cart"><i class="icon-cart"></i><br><span class="expand-text">Kiểm nhanh</span></div></a>
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="row">
                <div class="col-md-12 check-detail">
                    <table class="table table-condensedtable-hover no-margin">
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>