<?php
echo $this->Html->script(array('attendances.js'), array('inline' => false));
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
<div class="row attendance-calendar">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
            </div>
            <div class="widget-body">
                <?php foreach($staff_attendances as $staff_id => $worked_sessions) {?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       <h5 class="att-staff-name"><?php echo $this->Html->link($users[$staff_id], array('action' => 'view',$staff_id)); ?></h5>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <?php echo $this->Common->createCalendarTable($end); ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($worked_sessions as $session_id => $attendances) { ?>
                                <tr>
                                    <td colspan="<?php echo date('d',strtotime($end))?>">
                                        <strong><?php echo $worksessions[$session_id]?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <?php
                                    $time = 0;
                                    $attendances = Set::combine($attendances, '{n}.StaffAttendance.date', '{n}.StaffAttendance');
                                    echo $this->Common->createCalendarTable($end,'td',$attendances, $time);
                                    ?>
                                </tr>
                                <?php }?>
                                <tr>
                                    <td colspan="<?php echo date('d',strtotime($end))?>">
                                        <div class="label-attendance"><strong>Ghi chú màu sắc : </strong></div>
                                        <div class="label-attendance attendance-ok">Đúng giờ</div>
                                        <div class="label-attendance attendance-late">Trể giờ</div>
                                        <div class="label-attendance not-attendance">Chưa điểm danh</div>
                                        <div class="label-attendance error-begin">Không điểm danh bắt đầu</div>
                                        <div class="label-attendance error-end">Không điểm danh kết thúc</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>