<?php
foreach($customers as $customer){
    ?>
    <tr>
        <td><?php echo $customer['Customer']['code'];?></td>
        <td><?php echo $customer['Customer']['name'];?></td>
        <td><?php echo $customer['Customer']['phone'];?></td>
        <td><button
                class="btn btn-success btn-sm add-customer-btn"
                data-id = "<?php echo $customer['Customer']['id'];?>"
                data-name = "<?php echo $customer['Customer']['name'];?>"
                data-point = "<?php echo $customer['Customer']['point'];?>"
                ><i class="icon-plus"></i> Chọn</button></td>
    </tr>
    <?php
}
?>