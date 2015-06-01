<?php
$worksessions = Set::combine($worksessions_d,'{n}.WorkSession.id','{n}.WorkSession.name');
$total_time = array();
foreach($worksessions_d as $wk){
    $date2 =  new DateTime($wk['WorkSession']['begin']);
    $date1 =  new DateTime($wk['WorkSession']['end']);
    $dateDiff = $date2->diff($date1);
    $total = $dateDiff->h + round($dateDiff->m/60,0);
    $total_time[$wk['WorkSession']['id']] = $total;
}
?>
<div class="row">
    <div class="col-md-12">
        <form class="inl" role="form" method="post">
            <div class="form-group col-md-2">
                <?php
                echo $this->Form->input('year', array('label' => false, 'div' => false, 'empty' => 'Năm', 'class' => 'form-control'));
                ?>
            </div>
            <div class="form-group col-md-2">
                <?php
                echo $this->Form->input('month', array('label' => false, 'div' => false, 'empty' => 'Tháng', 'class' => 'form-control'));
                ?>
            </div>
            <div class="form-group col-md-1">
                <button class="form-control btn btn-default" type="submit"><i class="icon-search"></i></button>
            </div>
        </form>
    </div>
</div>
<!-- Row start -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
            </div>
            <div class="widget-body">
                <?php foreach ($staff_attendances as $key => $att) { ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><?php echo $worksessions[$key]; ?></div>
                        <div class="panel-body">
                            <?php
                            $staffs = Set::combine($att, '{n}.StaffAttendance.date', '{n}.StaffAttendance', '{n}.StaffAttendance.staff_id');
                            ?>
                            <div class="table-responsive">
                                <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tên Nhân viên</th>
                                        <?php echo $this->Common->createCalendarTable($end);?>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <?php foreach ($staffs as $k => $staff){ ?>
                                    <tr>
                                        <td><?php echo $users[$k]?></td>
                                        <?php
                                        $time = 0;
//                                        $salary = $salaries[$k.'-'.$key];
                                        $salary = 0;
                                        $w_time = $total_time[$key];
                                        $per_day = round($salary / (date('t')*$w_time),0);
                                        echo $this->Common->createCalendarTable($end,'td',$staff, $time);?>
                                    </tr>
                                    <tr>
                                        <td colspan="<?php echo date('t')-5;?>" class="text-right price-text">Thời gian làm: <?php echo $time?> giờ</td>
                                        <td colspan="<?php echo date('t') - (date('t')-5) + 1;?>" class="text-right price-text">Thành tiền : <?php echo number_format($time * $per_day,0,'.',',')?> đ</td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>