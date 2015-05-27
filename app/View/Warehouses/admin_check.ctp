<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/18/15
 * Time: 9:58 AM
 */
echo $this->Html->script(array('product', 'warehouse_check'), array('inline' => false));
$today = strtotime(date('Y-m-d'));
?>

<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <h3>Kiểm hàng [<?php echo date('d-m-Y', $date_filter) ?>]
                <small><a href="javascript:;" data-toggle="modal" data-target="#modal-timetable">[Danh sách kiểm hàng
                        theo ngày]</a> - <a href="<?php
                    echo $this->Html->url(array(
                        'admin' => true,
                        'controller' => 'warehouses',
                        'action' => 'check'
                    ));
                    ?>">[Hôm nay]</a></small>
            </h3>
            <?php
            echo $this->Form->create('WarehouseCheck', array('class' => ''));
            $this->Form->inputDefaults(array(
                'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                'div' => array('class' => 'form-group'),
                'label' => array('class' => 'col-lg-2 control-label'),
                'class' => 'form-control',
                'error' => array(
                    'attributes' => array(
                        'wrap' => 'span', 'class' => 'help-inline'
                    )
                ),
            ));
            echo $this->Form->input('store_id', array('label' => array('text' => 'Cửa hàng', 'class' => 'control-label')));
            ?>
            <input type="hidden" name="data[check]" value="1">
            <?php
            if ($date_filter >= $today) {
                ?>
                <div class="form-group">
                    <div class="input-group">
                        <input name="data[WarehouseCheck][code]" id="code" type="text" class="form-control"
                               placeholder="Code">
                    <span class="input-group-btn">
                         <?php echo $this->Form->submit('Kiểm tra', array('div' => false, 'id' => 'submit', 'class' => 'btn btn-success')) ?>
                    </span>
                    </div>
                    <!-- /input-group -->
                </div>
            <?php
            }
            echo $this->Form->end();
            ?>
        </div>
        <div class="col-lg-3"></div>
    </div>
</div>
<div class="row">
    <!--    <div class="col-lg-12">-->
    <!--        <div class="form-group">-->
    <!--            <label>Ghi chú</label>-->
    <!--            <textarea class="form-control"></textarea>-->
    <!--        </div>-->
    <!--    </div>-->
    <div class="col-lg-12">
        <table class="table table-condensedtable-hover no-margin">
            <thead>
            <tr>
                <th>Note</th>
                <th>Mã hàng</th>
                <th>Tên hàng</th>
                <th>Giá bán lẻ</th>
                <th>Giá bán sỉ</th>
                <th>Cửa hàng</th>
                <th>Số lượng</th>
                <th>Số lượng thực</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="check-body">
            <input type="hidden" id="store_id" value="<?php
            if(isset($warehouses['WarehouseCheck']['store_id']))
                echo $warehouses['WarehouseCheck']['store_id'];
            else
                if($this->Session->check('WarehouseCheck.store_id'))
                    echo $this->Session->read('WarehouseCheck.store_id');
                else
                    echo 1;
            ?>">
            <?php
            foreach ($warehouse_check_detail as $warehouse) {
                $class = '';
                $message = '';
                if ($warehouse['WarehouseCheckDetail']['warehouse_id'] == 0) {
                    $class = 'td-error';
                    $message = 'Kho không có';
                } else {
                    if ($warehouse['WarehouseCheckDetail']['qty'] < $warehouse['WarehouseCheckDetail']['real_qty']) {
                        $class = 'td-warning';
                        $message = 'Dư hàng';
                    }
                    if ($warehouse['WarehouseCheckDetail']['real_qty'] < $warehouse['WarehouseCheckDetail']['qty']) {
                        $class = 'td-warning-1';
                        $message = 'Thiếu hàng';
                        if($warehouse['WarehouseCheckDetail']['real_qty'] == 0){
                            $class = 'td-warning-2';
                            $message = 'Sai số liệu';
                        }
                    }

                }
                ?>
                <tr id="<?php echo $warehouse['WarehouseCheckDetail']['code'] ?>" class="<?php echo $class ?>">
                    <td><?php echo $message ?></td>
                    <td><?php echo $warehouse['WarehouseCheckDetail']['code'] ?></td>
                    <td><?php echo $warehouse['Product']['name'] ?></td>
                    <td><?php echo number_format($warehouse['WarehouseCheckDetail']['price'], 0, '.', ',') ?></td>
                    <td><?php echo number_format($warehouse['WarehouseCheckDetail']['retail_price'], 0, '.', ',') ?></td>
                    <td><?php echo $warehouse['Store']['name'] ?></td>
                    <td><?php echo $warehouse['WarehouseCheckDetail']['qty'] ?></td>
                    <td>
                        <?php
                        if ($date_filter >= $today) {
                            ?>
                            <div class="input-group input-group-sm tb-input">
                                <input id="code" type="text" class="form-control"
                                       data-store="<?php echo $warehouse['WarehouseCheckDetail']['store_id'] ?>"
                                       data-code="<?php echo $warehouse['WarehouseCheckDetail']['code'] ?>"
                                       placeholder="Số lượng"
                                       value="<?php echo $warehouse['WarehouseCheckDetail']['real_qty'] ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-info change-qty"><i class="icon icon-pen"></i></button>
                            </span>
                            </div>
                        <?php
                        } else {
                            echo $warehouse['WarehouseCheckDetail']['real_qty'];
                        }
                        ?>

                    </td>
                    <td>
                        <?php
                        if ($date_filter >= $today) {
                            ?>
                            <a class="delete" href="javascript:;" data-href="<?php echo $this->Html->url(
                                array(
                                    'admin' => true,
                                    'controller' => 'warehouses',
                                    'action' => 'warehouse_check_delete',
                                    $warehouse['WarehouseCheckDetail']['id']
                                )
                            )?>"><i class="glyphicon glyphicon-trash"></i></a>
                        <?php
                        }
                        ?>

                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <a href="<?php
                echo $this->Html->url(array(
                    'admin'=>true,
                    'controller' =>'warehouses',
                    'action' =>'check_print',
                    '?' => array(
                        'store_id' => $this->request->data['WarehouseCheck']['store_id'],
                        'date' => $date_filter
                    )
                ));
            ?>" class="btn btn-info">Xuất Excel</a>

            <?php
            if ($date_filter >= $today) {
                ?>
            <a href="javascript:;" data-href="<?php echo $this->Html->url(
                array(
                    'admin' => true,
                    'controller' => 'warehouses',
                    'action' => 'check_incorrect',
                    $this->request->data['WarehouseCheck']['store_id']
                )
            )?>" id="check-incorrect" class="btn btn-warning pull-right">Kiểm tra số lượng hàng tồn sai thực tế</a>
            <?php
            }
            ?>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="modal-timetable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Danh sách ngày</h4>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    <?php
                    foreach ($timetable as $tb) {
                        ?>
                        <a href="<?php
                        echo $this->Html->url(array(
                            'admin' => true,
                            'controller' => 'warehouses',
                            'action' => 'check',
                            '?' => array(
                                'date' => $tb['WarehouseCheck']['date']
                            )
                        ));
                        ?>" class="list-group-item"><?php echo date('d-m-Y', $tb['WarehouseCheck']['date']) ?></a>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>