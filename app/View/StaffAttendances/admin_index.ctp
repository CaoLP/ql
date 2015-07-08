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
            <div class="form-group col-md-2">
                <?php
                echo $this->Form->input('user_id', array('label' => false, 'div' => false, 'empty' => 'Nhân viên', 'class' => 'form-control'));
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
                    <?php $salary = $salaries[$users_role[$staff_id]];?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       <h5 class="att-staff-name"><?php echo $this->Html->link($users[$staff_id], array('action' => 'view',$staff_id)); ?>
                           <span>[ Lương cơ bản : <?php echo $this->Common->formatMoney($salary)?> ]</span></h5>
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
                                <?php $time = 0;
                                $ontime = 0;
                                $late = 0;
                                $incorrect = 0;
                                foreach ($worked_sessions as $session_id => $attendances) { ?>
                                <tr>
                                    <td colspan="<?php echo date('d',strtotime($end))?>">
                                        <strong><?php echo $worksessions[$session_id]?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <?php

                                    $attendances = Set::combine($attendances, '{n}.StaffAttendance.date', '{n}.StaffAttendance');
                                    echo $this->Common->createCalendarTable($end,'td',$attendances, $time, $ontime, $late, $incorrect);
                                    ?>
                                </tr>
                                <?php }?>
                                <tr>
                                    <?php
                                    $total_days = date('d',strtotime($end));
                                    $salary_per_day = round($salary/$total_days);
                                    ?>
                                    <td class="text-right" colspan="<?php echo date('d',strtotime($end))?>">
                                        <strong>Tổng công làm : <?php echo $time;?></strong><br>
                                        <strong>Đúng giờ : <?php echo $ontime;?></strong><br>
                                        <strong>Trể giờ : <?php echo $late;?></strong><br>
                                        <strong>Không điểm : <?php echo $incorrect;?></strong>
                                        <hr>
                                        <strong>Lương ước tính : <?php echo $this->Common->formatMoney($salary_per_day*$time);?></strong><br>
                                    </td>
                                </tr>
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