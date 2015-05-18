<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/18/15
 * Time: 9:58 AM
 */
echo $this->Html->script(array('product', 'warehouse_check'), array('inline' => false));
?>

<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <h3>Kiểm hàng [<?php echo date('d-m-Y') ?>]</h3>
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
            echo $this->Form->end();
            ?>
        </div>
        <div class="col-lg-3"></div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label>Ghi chú</label>
            <textarea class="form-control"></textarea>
        </div>
    </div>
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
            <?php
            foreach ($warehouse_check_detail as $warehouse) {
                $class = '';
                if($warehouse['WarehouseCheckDetail']['warehouse_id'] == 0){
                    $class = 'td-error';
                }else{
                    if($warehouse['WarehouseCheckDetail']['qty'] <  $warehouse['WarehouseCheckDetail']['real_qty'] )
                        $class = 'td-warning';
                }
                ?>
                <tr id="<?php echo $warehouse['WarehouseCheckDetail']['code'] ?>" class="<?php echo $class?>">
                    <td><?php if($warehouse['WarehouseCheckDetail']['warehouse_id'] == 0) echo 'Kho không có' ?></td>
                    <td><?php echo $warehouse['WarehouseCheckDetail']['code'] ?></td>
                    <td><?php echo $warehouse['Product']['name'] ?></td>
                    <td><?php echo $warehouse['WarehouseCheckDetail']['price'] ?></td>
                    <td><?php echo $warehouse['WarehouseCheckDetail']['retail_price'] ?></td>
                    <td><?php echo $warehouse['Store']['name'] ?></td>
                    <td><?php echo $warehouse['WarehouseCheckDetail']['qty'] ?></td>
                    <td><?php echo $warehouse['WarehouseCheckDetail']['real_qty'] ?></td>
                    <td><a class="delete"  href="javascript:;" data-href="<?php echo $this->Html->url(
                            array(
                                'admin'=>true,
                                'controller'=>'warehouses'
                            ,   'action'=>'warehouse_check_delete',
                                $warehouse['WarehouseCheckDetail']['id']
                            )
                        )?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>