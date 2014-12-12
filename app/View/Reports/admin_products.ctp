<?php
$this->Html->script(array('report'),array('inline'=>false));
?>
<div class="row">
    <div class="col-md-12">
        <form class="inl" role="form" method="post">
            <div class="form-group col-md-2">
                <?php
                echo $this->Form->input('from',array('label'=>false,'div'=>false,'placeholder'=>'Ngày kết thúc','class'=>'form-control datepicker2','readonly'=>'readonly'));
                ?>
            </div>
            <div class="form-group col-md-2">
                <?php
                echo $this->Form->input('to',array('label'=>false,'div'=>false,'placeholder'=>'Ngày kết thúc','class'=>'form-control datepicker2','readonly'=>'readonly'));
                ?>
            </div>
            <div class="form-group col-md-2">
                <?php echo $this->Form->input('filter', array('label' => false, 'div' => false,'options'=>array(
                    'qty' => 'Số lượng',
                    'price' => 'Theo giá',
                ), 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-md-2">
                <?php echo $this->Form->input('side', array('label' => false, 'div' => false,'options'=>array(
                    'desc' => 'Z-A',
                    'asc' => 'A-Z',
                ), 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-md-3">
                <?php echo $this->Form->input('store_id', array('label' => false, 'div' => false, 'class' => 'form-control', 'empty' => 'Tất cả cửa hàng')); ?>
            </div>
            <div class="form-group col-md-1">
                <button class="form-control btn btn-default" type="submit"><i class="icon-search"></i></button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php
        $summary = 0;
        foreach ($orders as $key => $order_details) {
            $order_details = Set::sort($order_details,'{n}.'.$filter, $side);
            ?>
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <?php echo $stores[$key]; ?>
                </div>
                <!-- Table -->
                <table class="table">
                    <thead>
                    <th style="width: 50px">TT</th>
                    <th style="width: 150px">Mã hàng</th>
                    <th>Tên hàng</th>
                    <th class="text-center"style="width: 100px">Số lượng</th>
                    <th class="text-right"style="width: 150px">Giá xuất</th>
                    <th class="text-right" style="width: 150px">Thành tiền</th>
                    </thead>
                    <tbody>
                    <?php
                    $total = 0;
                    $number = 1;
                    foreach ($order_details as $order) {
                        $s_total = ($order['qty'] * $order['price']);
                        $total+= $s_total;
                        ?>
                        <tr>
                            <td><?php echo $number; ?></td>
                            <td><?php echo $order['sku']; ?></td>
                            <td><a href="javascript:;" class="pov" data-id="<?php echo $order['product_id']; ?>"
                                   data-store_id="<?php echo $key; ?>"
                                   data-request="<?php echo urlencode(json_encode($this->request->data))?>"><?php echo $order['name']; ?></a></td>
                            <td class="text-center"><?php echo $order['qty']; ?></td>
                            <td class="text-right price-text"><?php echo number_format($order['price'], 0, '.', ','); ?></td>
                            <td class="text-right price-text"><?php echo number_format($s_total, 0, '.', ','); ?></td>
                        </tr>
                        <?php
                        $number++;
                    }
                    $summary+= $total;
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" class="text-right"><strong>Tổng cộng</strong></td>
                        <td class="text-right price-text"><?php echo number_format($total, 0, '.', ','); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                Tổng cộng
            </div>
            <!-- Table -->
            <table class="table">
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" class="text-right"><strong>Tổng cộng</strong></td>
                    <td class="text-right price-text"><?php echo number_format($summary, 0, '.', ','); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>