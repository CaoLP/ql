<?php
$this->Html->css(array('report_warehouse'), array('inline' => false));
$this->Html->script(array('report_warehouse'), array('inline' => false));
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
        <table class="table">
            <thead class="">
            <tr>
                <th rowspan="2">Stt</th>
                <th rowspan="2">Mã hàng</th>
                <th rowspan="2">Tên hàng</th>
                <th rowspan="2">Đơn giá</th>
                <th rowspan="2">Giá sỉ</th>
                <th rowspan="2">Giá gốc</th>
                <th rowspan="2">Tồn đầu kỳ</th>
                <th colspan="2">Nhập</th>
                <th colspan="2">Xuất</th>
                <th colspan="2">Bán</th>
                <th rowspan="2">Tồn cuối kỳ</th>
                <th rowspan="2">Lợi nhuận</th>
            </tr>
            <tr>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1;
            foreach ($products as $p) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $p['code']; ?></td>
                    <td><?php echo $p['name']; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $p['total']; ?></td>
                    <td></td>
                </tr>
                <?php
                $i++;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>