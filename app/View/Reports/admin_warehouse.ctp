<?php
$this->Html->css(array('report_warehouse'), array('inline' => false));
$this->Html->script(array('report_warehouse'), array('inline' => false));
$isAdmin = false;
if($this->Session->read('Auth.User.group_id')) $isAdmin = true;
?>
<div class="row">
    <div class="col-md-12">
        <form class="inl" role="form" method="post">
            <div class="form-group col-md-2">
                <?php
                echo $this->Form->input('from', array('label' => false, 'div' => false, 'placeholder' => 'Ngày kết thúc', 'class' => 'form-control datepicker2', 'readonly' => 'readonly'));
                ?>
            </div>
            <div class="form-group col-md-2">
                <?php
                echo $this->Form->input('to', array('label' => false, 'div' => false, 'placeholder' => 'Ngày kết thúc', 'class' => 'form-control datepicker2', 'readonly' => 'readonly'));
                ?>
            </div>
            <div class="form-group col-md-2">
                <?php echo $this->Form->input('filter', array('label' => false, 'div' => false, 'options' => array(
                    'qty' => 'Số lượng',
                    'price' => 'Theo giá',
                ), 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-md-2">
                <?php echo $this->Form->input('side', array('label' => false, 'div' => false, 'options' => array(
                    'desc' => 'Z-A',
                    'asc' => 'A-Z',
                ), 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-md-3">
                <?php echo $this->Form->input('store_id', array('label' => false, 'div' => false, 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-md-1">
                <button class="form-control btn btn-default" type="submit"><i class="icon-search"></i></button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead class="">
            <tr>
                <th rowspan="2">Stt</th>
                <th rowspan="2">Mã hàng</th>
                <th rowspan="2">Tên hàng</th>
                <th rowspan="2">Đơn giá</th>
                <th rowspan="2">Giá sỉ</th>
                <?php if($isAdmin) :?>
                <th rowspan="2">Giá gốc</th>
                <?php endif;?>
                <th rowspan="2" class="qty">Tồn đầu kỳ</th>
                <th colspan="2">Nhập</th>
                <th colspan="2">Xuất</th>
                <th colspan="3">Bán</th>
                <th rowspan="2" class="qty">Tồn cuối kỳ</th>
                <?php if($isAdmin) :?>
                <th rowspan="2">Lợi nhuận</th>
                <?php endif;?>
            </tr>
            <tr>
                <th class="qty">SL</th>
                <th>Thành tiền</th>
                <th class="qty">SL</th>
                <th>Thành tiền</th>
                <th class="qty">SL</th>
                <th>Khuyến mãi</th>
                <th>Thành tiền</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1;
            foreach ($products as $key=>$p) {
                ?>
                <tr>
                    <td><?php echo $this->Html->link($i,
                            array(
                                'controller' => 'products',
                                'action' => 'edit',
                                $key
                            ),
                            array(
                                'escape' => false,
                                'title' => 'Xem thông tin'
                            )
                        ); ?></td>
                    <td><?php echo $p['code']; ?></td>
                    <td><?php echo $p['name']; ?></td>
                    <td class="price-text"><?php echo $this->Common->formatMoney($p['price']); ?></td>
                    <td class="price-text"><?php echo $this->Common->formatMoney($p['retail_price']); ?></td>
                <?php if($isAdmin) :?>
                    <td class="price-text"><?php echo $this->Common->formatMoney($p['source_price']); ?></td>
                <?php endif;?>
                    <td class="qty"><?php echo $p['before_total']; ?></td>
                    <td class="qty"><?php echo $p['in_qty']; ?></td>
                    <td class="price-text"><?php echo $this->Common->formatMoney($p['in_price']); ?></td>
                    <td class="qty"><?php echo $p['out_qty']; ?></td>
                    <td class="price-text"><?php echo $this->Common->formatMoney($p['out_price']); ?></td>
                    <td class="qty"><?php echo $p['sale_qty']; ?></td>
                    <td class="price-text"><?php echo $this->Common->formatMoney($p['sale_promote']); ?></td>
                    <td class="price-text"><?php echo $this->Common->formatMoney($p['sale_price']); ?></td>
                    <td class="qty"><?php echo $p['after_total']; ?></td>
                <?php if($isAdmin) :?>
                    <td class="price-text"><?php echo $this->Common->formatMoney($p['profit']); ?></td>
                <?php endif;?>
                </tr>
                <?php
                $i++;
            }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="price-text"></td>
                <td class="price-text"></td>
                <?php if($isAdmin) :?>
                    <td class="price-text"></td>
                <?php endif;?>
                <td class="qty"><?php echo $summary['before_total']; ?></td>
                <td class="qty"><?php echo $summary['in_qty']; ?></td>
                <td class="price-text"><?php echo $this->Common->formatMoney($summary['in_price']); ?></td>
                <td class="qty"><?php echo $summary['out_qty']; ?></td>
                <td class="price-text"><?php echo $this->Common->formatMoney($summary['out_price']); ?></td>
                <td class="qty"><?php echo $summary['sale_qty']; ?></td>
                <td class="price-text"><?php echo $this->Common->formatMoney($summary['sale_promote']); ?></td>
                <td class="price-text"><?php echo $this->Common->formatMoney($summary['sale_price']); ?></td>
                <td class="qty"><?php echo $summary['after_total']; ?></td>
                <?php if($isAdmin) :?>
                    <td class="price-text"><?php echo $this->Common->formatMoney($summary['profit']); ?></td>
                <?php endif;?>
            </tr>

            <tr class="text-center text-bold footer_tb">
                <td rowspan="2">Stt</td>
                <td rowspan="2">Mã hàng</td>
                <td rowspan="2">Tên hàng</td>
                <td rowspan="2">Đơn giá</td>
                <td rowspan="2">Giá sỉ</td>
                <?php if($isAdmin) :?>
                    <td rowspan="2">Giá gốc</td>
                <?php endif;?>
                <td rowspan="2" class="qty">Tồn đầu kỳ</td>
                <td class="qty">SL</td>
                <td>Thành tiền</td>
                <td class="qty">SL</td>
                <td>Thành tiền</td>
                <td class="qty">SL</td>
                <td>Khuyến mãi</td>
                <td>Thành tiền</td>
                <td rowspan="2" class="qty">Tồn cuối kỳ</td>
                <?php if($isAdmin) :?>
                    <td rowspan="2">Lợi nhuận</td>
                <?php endif;?>
            </tr>
            <tr class="text-center text-bold footer_tb">
                <td colspan="2">Nhập</td>
                <td colspan="2">Xuất</td>
                <td colspan="3">Bán</td>
            </tr>
            <tr>
                <td colspan="11">

                </td>
                <td>
                </td>
                <td colspan="2" class="text-center text-bold">
                    Số lượng
                </td>
                <td colspan="2" class="text-center text-bold">
                    Thành tiên
                </td>
            </tr>
            <tr>
                <td colspan="12" class="text-right text-bold">
                    Tiền hàng đầu kỳ
                </td>
                <td colspan="2" class="qty">
                    <?php echo $this->Common->formatMoney($summary['before_total']); ?>
                </td>
                <td colspan="2" class="price-text">
                    <?php echo $this->Common->formatMoney($summary['before_price']); ?>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="text-right text-bold">
                    Tiền nhập
                </td>
                <td colspan="2" class="qty">
                    <?php echo $this->Common->formatMoney($summary['in_qty']); ?>
                </td>
                <td colspan="2" class="price-text">
                    <?php echo $this->Common->formatMoney($summary['in_price']); ?>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="text-right text-bold">
                    Tiền xuất
                </td>
                <td colspan="2" class="qty">
                    <?php echo $this->Common->formatMoney($summary['out_qty']); ?>
                </td>
                <td colspan="2" class="price-text">
                    <?php echo $this->Common->formatMoney($summary['out_price']); ?>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="text-right text-bold">
                    Tiền bán
                </td>
                <td colspan="2" class="qty">
                    <?php echo $this->Common->formatMoney($summary['sale_qty']); ?>
                </td>
                <td colspan="2" class="price-text">
                    <?php echo $this->Common->formatMoney($summary['sale_price']); ?>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="text-right text-bold">
                    Khuyến mãi
                </td>
                <td colspan="2" class="qty">
                </td>
                <td colspan="2" class="price-text">
                    <?php echo $this->Common->formatMoney($summary['sale_promote']); ?>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="text-right text-bold">
                    Cuối kỳ
                </td>
                <td colspan="2" class="qty">
                    <?php echo $this->Common->formatMoney($summary['after_total']); ?>
                </td>
                <td colspan="2" class="price-text">
                    <?php echo $this->Common->formatMoney($summary['after_price']); ?>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="text-right text-bold">
                    Phí ship
                </td>
                <td colspan="2" class="qty">

                </td>
                <td colspan="2" class="price-text">
                    <?php echo $this->Common->formatMoney($summary['ship']); ?>
                </td>
            </tr>
            <?php if($isAdmin) :?>
            <tr>
                <td colspan="12" class="text-right text-bold">
                   Lợi nhuận
                </td>
                <td colspan="2" class="qty">

                </td>
                <td colspan="2" class="price-text">
                    <?php echo $this->Common->formatMoney($summary['profit']); ?>
                </td>
            </tr>
            <?php endif;?>
            </tbody>
        </table>
    </div>
</div>