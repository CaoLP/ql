<div class="row">
    <div class="col-md-12">
        <form class="inl" role="form" method="post">
            <div class="form-group col-md-3">
                <?php
                echo $this->Form->input('from', array('label' => false, 'div' => false, 'placeholder' => 'Ngày kết thúc', 'class' => 'form-control datepicker2', 'readonly' => 'readonly'));
                ?>
            </div>
            <div class="form-group col-md-3">
                <?php
                echo $this->Form->input('to', array('label' => false, 'div' => false, 'placeholder' => 'Ngày kết thúc', 'class' => 'form-control datepicker2', 'readonly' => 'readonly'));
                ?>
            </div>
            <div class="form-group col-md-4">
                <?php echo $this->Form->input('store_id', array('label' => false, 'div' => false, 'class' => 'form-control', 'empty' => 'Tất cả cửa hàng')); ?>
            </div>
            <div class="form-group col-md-2">
                <button class="form-control btn btn-default" type="submit"><i class="icon-search"></i></button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php
        $summary1 = 0;
        $summary2 = 0;
        $summary3 = 0;
        $summary4 = 0;
        $summary5 = 0;

        foreach ($orders as $key => $order) {

            ?>
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <?php echo $stores[$key]; ?>
                </div>
                <!-- Table -->
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 50px">TT</th>
                        <th>Mã đơn hàng</th>
                        <th class="text-center" style="width: 100px">Tổng tiền</th>
                        <th class="text-right" style="width: 150px">Khuyến mãi</th>
                        <th class="text-right" style="width: 150px">Thành tiền</th>
                        <th class="text-right" style="width: 150px">Khách trả</th>
                        <th class="text-right" style="width: 150px">Trả lại</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total1 = 0;
                    $total2 = 0;
                    $total3 = 0;
                    $total4 = 0;
                    $total5 = 0;



                    $numb = 1;
                    foreach ($order as $o) {
                        $total1 += $o['total'];
                        $total2 += $o['total_promote'];
                        $total3 += $o['amount'];
                        $total4 += $o['receive'];
                        $total5 += $o['refund'];

                        $summary1 += $o['total'];
                        $summary2 += $o['total_promote'];
                        $summary3 += $o['amount'];
                        $summary4 += $o['receive'];
                        $summary5 += $o['refund'];

                        ?>
                        <tr>
                            <td><?php echo $numb; ?></td>
                            <td><?php echo $o['code']; ?></td>
                            <td class="text-right price-text"><?php echo number_format($o['total'], 0, '.', ','); ?></td>
                            <td class="text-right price-text"><?php echo number_format($o['total_promote'], 0, '.', ','); ?></td>
                            <td class="text-right price-text"><?php echo number_format($o['amount'], 0, '.', ','); ?></td>
                            <td class="text-right price-text"><?php echo number_format($o['receive'], 0, '.', ','); ?></td>
                            <td class="text-right price-text"><?php echo number_format($o['refund'], 0, '.', ','); ?></td>
                        </tr>
                        <?php
                        $numb++;
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right price-text"><?php echo number_format($total1, 0, '.', ','); ?></td>
                        <td class="text-right price-text"><?php echo number_format($total2, 0, '.', ','); ?></td>
                        <td class="text-right price-text"><?php echo number_format($total3, 0, '.', ','); ?></td>
                        <td class="text-right price-text"><?php echo number_format($total4, 0, '.', ','); ?></td>
                        <td class="text-right price-text"><?php echo number_format($total5, 0, '.', ','); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tổng cộng
            </div>
            <table class="table">
                <tr>
                    <td style="width: 50px"></td>
                    <td></td>
                    <td class="text-center price-text" style="width: 100px"><?php echo number_format($summary1, 0, '.', ','); ?></td>
                    <td class="text-right price-text" style="width: 150px"><?php echo number_format($summary2, 0, '.', ','); ?></td>
                    <td class="text-right price-text" style="width: 150px"><?php echo number_format($summary3, 0, '.', ','); ?></td>
                    <td class="text-right price-text" style="width: 150px"><?php echo number_format($summary4, 0, '.', ','); ?></td>
                    <td class="text-right price-text" style="width: 150px"><?php echo number_format($summary5, 0, '.', ','); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

