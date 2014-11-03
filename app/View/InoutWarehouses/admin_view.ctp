<?php
setlocale(LC_MONETARY, "vi_VN");
if ($showBtn)
    $this->Html->addCrumb('<li>Phiếu nhập hàng chờ duyệt</li>', array('action' => 'in'), array('escape' => false));
else
    $this->Html->addCrumb('<li>' . $title_for_layout . '</li>', array('action' => 'index'), array('escape' => false));
$this->Html->addCrumb('<li>' . $inoutWarehouse['InoutWarehouse']['code'] . '</li>', '/' . $this->request->url, array('escape' => false));
echo $this->Form->create('InoutWarehouse', array('class' => 'form-horizontal'));
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
                                        class="price-text"><?php echo number_format($item['price'], 2, '.', ','); ?></span>
                                </td>
                                <td class="hidden-qty-text">
                                    <?php echo $item['qty'] ?>
                                </td>
                                <td><span
                                        class="price-text total-price"><?php echo number_format($summary, 2, '.', ','); ?></span>
                                </td>
                                <td class="hidden-qty-text">
                                    <input type="text" class="hidden-qty" data-qty="<?php echo $item['qty'] ?>" data-price="<?php echo $item['price'] ?>"
                                           name="data[InoutWarehouseDetail][<?php echo $key ?>][qty_received]"
                                           value="<?php echo $item['qty_received']?$item['qty_received']:0;?>">
                                </td>
                                <td><span
                                        class="price-text total-price"><?php echo number_format($summary, 2, '.', ','); ?></span>
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
                                    ?></td>
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
                                            <?php echo $this->Html->link ($inoutWarehouse['ReceiveStore']['name'], array ('controller' => 'stores', 'action' => 'view', $inoutWarehouse['ReceiveStore']['id'])); ?>
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
                                <button type="submit" class="btn btn-success" id="save">Nhận hàng</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php echo $this->Form->end(); ?>