<div class="row">
    <div class="col-md-12">
        <form class="inl" role="form" method="post">
            <div class="form-group col-md-3">
                <input name="data[from]" type="text" class="form-control datepicker2" placeholder="Ngày bắt đầu"
                       readonly>
            </div>
            <div class="form-group col-md-3">
                <input name="data[to]" type="text" class="form-control datepicker2" placeholder="Ngày Kết thúc"
                       readonly>
            </div>
            <div class="form-group col-md-3">
                <?php echo $this->Form->input('store_id', array('label' => false, 'div' => false, 'class' => 'form-control', 'empty' => 'Tất cã cửa hàng')); ?>
            </div>
            <div class="form-group col-md-3">
                <button class="form-control btn btn-default" type="submit"><i class="icon-search"></i> Lọc</button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php
        foreach ($orderIDs as $key => $order) {
//            $order = (Set::classicExtract($order, '{n}.{n}'));
//            $details = Set::combine($order,'{n}.{n}.id','{n}','{n}.{n}.product_id');
//            debug($details);
            ?>
            <div class="panel panel-default">
                <!-- Default panel contents -->

                <div class="panel-heading">
                    <?php echo $stores[$key]; ?>
                </div>
                <?php
                debug($orders[$order]);
                ?>
                <!-- Table -->
                <table class="table">
                    <thead>
                    <th>TT</th>
                    <th>Mã hàng</th>
                    <th>Tên hàng</th>
                    <th>Số lượng</th>
                    <th>Giá xuất</th>
                    <th>Thành tiền</th>
                    </thead>
                    <tbody>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
    </div>
</div>