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
    <th rowspan="2" class="qty bg4">Tồn đầu kỳ</th>
    <th colspan="2" class="bg1">Nhập</th>
    <th colspan="2" class="bg2">Xuất</th>
    <th colspan="3" class="bg3">Bán</th>
    <th rowspan="2" class="qty bg4">Tồn cuối kỳ</th>
    <?php if($isAdmin) :?>
        <th rowspan="2">Lợi nhuận</th>
    <?php endif;?>

</tr>
<tr>
    <th class="qty bg1">SL</th>
    <th class="bg1">Thành tiền</th>
    <th class="qty bg2">SL</th>
    <th class="bg2">Thành tiền</th>
    <th class="qty bg3">SL</th>
    <th class="bg3">Khuyến mãi</th>
    <th class="bg3">Thành tiền</th>
</tr>
</thead>
<tbody>
<?php
foreach ($categories as $key => $products) {
    $i = 1;
    $sub_summary = array(
        'before_total' => 0,
        'before_price' => 0,
        'ship' => 0,
        'in_qty' => 0,
        'in_price' => 0,
        'out_qty' => 0,
        'out_price' => 0,
        'sale_qty' => 0,
        'sale_promote' => 0,
        'sale_price' => 0,
        'after_total' => 0,
        'after_price' => 0,
        'profit' => 0,
    );
    foreach($products as $k => $p){
       if(
            $p['before_total'] ==  0
            && $p['after_total'] == 0
            && $p['in_qty'] == 0
            && $p['out_qty'] == 0
            && $p['sale_qty'] == 0
        ){
            $build = false;
        }else{
           if($i == 1){
           ?>
           <tr>
               <td colspan="13"><?php echo $cats[$key];?></td>
           </tr>
           <?php }?>
            <tr>
                <td><?php echo $this->Html->link($i,
                        array(
                            'controller' => 'products',
                            'action' => 'edit',
                            $p['product_id']
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
                <td class="qty bg4"><?php echo $p['before_total']; ?></td>
                <td class="qty bg1"><?php echo $p['in_qty']; ?></td>
                <td class="price-text bg1"><?php echo $this->Common->formatMoney($p['in_price']); ?></td>
                <td class="qty bg2"><?php echo $p['out_qty']; ?></td>
                <td class="price-text bg2"><?php echo $this->Common->formatMoney($p['out_price']); ?></td>
                <td class="qty bg3"><?php echo $p['sale_qty']; ?></td>
                <td class="price-text bg3"><?php echo $this->Common->formatMoney($p['sale_promote']); ?></td>
                <td class="price-text bg3"><?php echo $this->Common->formatMoney($p['sale_price']); ?></td>
                <td class="qty bg4"><?php echo $p['after_total']; ?></td>
                <?php if($isAdmin) :?>
                    <td class="price-text"><?php echo $this->Common->formatMoney($p['profit']); ?></td>
                <?php endif;?>
            </tr>
            <?php
           $sub_summary['before_total'] += $p['before_total'];
           $sub_summary['before_price'] += $p['before_total'] *  $p['price'];
           $sub_summary['in_qty'] += $p['in_qty'];
           $sub_summary['in_price'] += $p['in_price'];
           $sub_summary['out_qty'] += $p['out_qty'];
           $sub_summary['out_price'] += $p['out_price'];
           $sub_summary['sale_qty'] += $p['sale_qty'];
           $sub_summary['sale_promote'] += $p['sale_promote'];
           $sub_summary['sale_price'] += $p['sale_price'];
           $sub_summary['after_total'] += $p['after_total'];
           $sub_summary['after_price'] += $p['after_total'] *  $p['price'];
           $sub_summary['profit'] += $p['profit'];
            $i++;
        }
        if(end($products) == $p && $i!=1){
            ?>
            <tr>
                <td class="text-right" colspan="6"><strong>Tổng cộng</strong></td>
                <td class="qty bg4"><?php echo $sub_summary['before_total']; ?></td>
                <td class="qty bg1"><?php echo $sub_summary['in_qty']; ?></td>
                <td class="price-text bg1"><?php echo $this->Common->formatMoney($sub_summary['in_price']); ?></td>
                <td class="qty bg2"><?php echo $sub_summary['out_qty']; ?></td>
                <td class="price-text bg2"><?php echo $this->Common->formatMoney($sub_summary['out_price']); ?></td>
                <td class="qty bg3"><?php echo $sub_summary['sale_qty']; ?></td>
                <td class="price-text bg3"><?php echo $this->Common->formatMoney($sub_summary['sale_promote']); ?></td>
                <td class="price-text bg3"><?php echo $this->Common->formatMoney($sub_summary['sale_price']); ?></td>
                <td class="qty bg4"><?php echo $sub_summary['after_total']; ?></td>
                <td class="price-text"><?php echo  $this->Common->formatMoney($sub_summary['profit']); ?></td>
            </tr>
        <?php
        }
    }
}
?>

<tr class="text-center text-bold footer_tb">
    <td rowspan="2">Stt</td>
    <td rowspan="2">Mã hàng</td>
    <td rowspan="2">Tên hàng</td>
    <td rowspan="2">Đơn giá</td>
    <td rowspan="2">Giá sỉ</td>
    <?php if($isAdmin) :?>
        <td rowspan="2">Giá gốc</td>
    <?php endif;?>
    <td rowspan="2" class="qty bg4">Tồn đầu kỳ</td>
    <td class="qty bg1">SL</td>
    <td class="bg1">Thành tiền</td>
    <td class="qty bg2">SL</td>
    <td class="bg2">Thành tiền</td>
    <td class="qty bg3">SL</td>
    <td class="bg3">Khuyến mãi</td>
    <td class="bg3">Thành tiền</td>
    <td rowspan="2" class="qty bg4">Tồn cuối kỳ</td>
    <?php if($isAdmin) :?>
        <td rowspan="2">Lợi nhuận</td>
    <?php endif;?>
</tr>
<tr class="text-center text-bold footer_tb">
    <td colspan="2" class="bg1">Nhập</td>
    <td colspan="2" class="bg2">Xuất</td>
    <td colspan="3" class="bg3">Bán</td>
</tr>
<tr>
    <td class="text-right" colspan="6"><strong>Tổng cộng</strong></td>
    <td class="qty"><?php echo $summary['before_total']; ?></td>
    <td class="qty"><?php echo $summary['in_qty']; ?></td>
    <td class="price-text"><?php echo $this->Common->formatMoney($summary['in_price']); ?></td>
    <td class="qty"><?php echo $summary['out_qty']; ?></td>
    <td class="price-text"><?php echo $this->Common->formatMoney($summary['out_price']); ?></td>
    <td class="qty"><?php echo $summary['sale_qty']; ?></td>
    <td class="price-text"><?php echo $this->Common->formatMoney($summary['sale_promote']); ?></td>
    <td class="price-text"><?php echo $this->Common->formatMoney($summary['sale_price']); ?></td>
    <td class="qty"><?php echo $summary['after_total']; ?></td>
    <td class="price-text"><?php echo  $this->Common->formatMoney($summary['profit']); ?></td>
</tr>

<tr>
    <td colspan="12">

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