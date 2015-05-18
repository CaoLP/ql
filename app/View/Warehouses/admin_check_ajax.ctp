<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/18/15
 * Time: 11:32 AM
 */
foreach ($warehouses as $warehouse) {
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
