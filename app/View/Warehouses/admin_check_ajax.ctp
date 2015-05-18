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
        }

    }
    ?>
    <tr id="<?php echo $warehouse['WarehouseCheckDetail']['code'] ?>" class="<?php echo $class?>">
        <td><?php echo $message  ?></td>
        <td><?php echo $warehouse['WarehouseCheckDetail']['code'] ?></td>
        <td><?php echo $warehouse['Product']['name'] ?></td>
        <td><?php echo $warehouse['WarehouseCheckDetail']['price'] ?></td>
        <td><?php echo $warehouse['WarehouseCheckDetail']['retail_price'] ?></td>
        <td><?php echo $warehouse['Store']['name'] ?></td>
        <td><?php echo $warehouse['WarehouseCheckDetail']['qty'] ?></td>
        <td><?php echo $warehouse['WarehouseCheckDetail']['real_qty'] ?></td>
        <td><a class="delete" href="javascript:;" data-href="<?php echo $this->Html->url(
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
