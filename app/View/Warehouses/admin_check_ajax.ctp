<input type="hidden" id="store_id" value="<?php
if(isset($w['WarehouseCheck']['id']))
    echo $w['WarehouseCheck']['id'];
else
    if($this->Session->check('WarehouseCheck.store_id'))
        echo $this->Session->read('WarehouseCheck.store_id');
    else
        echo 1;
?>">
<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/18/15
 * Time: 11:32 AM
 */
foreach ($warehouses as $warehouse) {
    $class = '';
    $message = '';
    if($warehouse['WarehouseCheckDetail']['warehouse_id'] == 0){
        $class = 'td-error';
        $message = 'Kho không có';
    }else{
        if($warehouse['WarehouseCheckDetail']['qty'] <  $warehouse['WarehouseCheckDetail']['real_qty'] ){
            $class = 'td-warning';
            $message = 'Dư hàng';
        }
        if($warehouse['WarehouseCheckDetail']['real_qty'] <  $warehouse['WarehouseCheckDetail']['qty'] ){
            $class = 'td-warning-1';
            $message = 'Thiếu hàng';
            if($warehouse['WarehouseCheckDetail']['real_qty'] == 0){
                $class = 'td-warning-2';
                $message = 'Sai số liệu';
            }
        }

    }
    ?>
    <tr id="<?php echo $warehouse['WarehouseCheckDetail']['code'] ?>" class="<?php echo $class?>">
        <td><?php echo $message  ?></td>
        <td><?php echo $warehouse['WarehouseCheckDetail']['code'] ?></td>
        <td><?php echo $warehouse['Product']['name'] ?></td>
        <td><?php echo number_format($warehouse['WarehouseCheckDetail']['price'], 0, '.', ',') ?></td>
        <td><?php echo number_format($warehouse['WarehouseCheckDetail']['retail_price'], 0, '.', ',') ?></td>
        <td><?php echo $warehouse['Store']['name'] ?></td>
        <td><?php echo $warehouse['WarehouseCheckDetail']['qty'] ?></td>
        <td>
            <div class="input-group input-group-sm tb-input">
                <input type="text" class="form-control"
                       data-store="<?php echo $warehouse['WarehouseCheckDetail']['store_id'] ?>"
                       data-code = "<?php echo $warehouse['WarehouseCheckDetail']['code'] ?>"
                       placeholder="Số lượng" value="<?php echo $warehouse['WarehouseCheckDetail']['real_qty'] ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-info change-qty"><i class="icon icon-pen"></i></button>
                            </span>
            </div>
        </td>
        <td><a class="delete" href="javascript:;" data-href="<?php echo $this->Html->url(
                array(
                    'admin'=>true,
                    'controller'=>'warehouses',
                    'action'=>'warehouse_check_delete',
                    $warehouse['WarehouseCheckDetail']['id']
                )
            )?>"><i class="glyphicon glyphicon-trash"></i></a></td>
    </tr>
<?php
}
?>
