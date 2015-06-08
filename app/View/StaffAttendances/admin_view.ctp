<!-- Row start -->
<?php
$isAdmin = true;
if($this->Session->read('Auth.User.group_id')) $isAdmin = true;
$salary;
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
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
               <h4>Điểm danh nhân viên <?php if(isset($attendances['0']['User']['name'])){
                    echo $user['User']['name'];
                }?></h4>
            </div>
            <div class="widget-body">
                <table class="table table-condensed  table-hover no-margin">
                    <thead>
                    <tr>
                        <th>Bắt đầu</th>
                        <th>Trể</th>
                        <th>Ghi chú bắt đầu</th>
                        <th>Kết thúc</th>
                        <th>Trể</th>
                        <th>Ghi chú kết thúc</th>
                        <th>Tổng thời gian</th>
                        <?php if($isAdmin){?>
                            <th>Actions</th>
                        <?php }?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sum = 0;
                    foreach ($attendances as $attendance): ?>
                        <tr>
                            <td><?php echo h ($attendance['StaffAttendance']['begin_time']); ?></td>
                            <td><?php
                                if($attendance['StaffAttendance']['delay_time_begin'] < 0)
                                    echo 0;
                                else
                                    echo $attendance['StaffAttendance']['delay_time_begin'];
                                ?>
                            </td>
                            <td><?php echo h ($attendance['StaffAttendance']['note_begin']); ?></td>
                            <td><?php echo h ($attendance['StaffAttendance']['end_time']); ?></td>
                            <td><?php
                                if($attendance['StaffAttendance']['delay_time_end'] < 0)
                                    echo 0;
                                else
                                    echo $attendance['StaffAttendance']['delay_time_end'];
                                ?>
                            </td>
                            <td><?php echo h ($attendance['StaffAttendance']['note_end']); ?></td>
                           <?php
                                $date2 =  new DateTime($attendance['StaffAttendance']['end_time']);
                                $date1 =  new DateTime($attendance['StaffAttendance']['begin_time']);
                                $total = 0;
                                $style = '';
                                if(
                                    $attendance['StaffAttendance']['begin_time']!= '0000-00-00 00:00:00'
                                    && $attendance['StaffAttendance']['end_time']!= '0000-00-00 00:00:00'
                                    && $date1<$date2
                                ){
                                    $dateDiff = $date2->diff($date1);
                                    $total = $dateDiff->h * 60 + $dateDiff->i;
                                    $total = $this->Common->convertToHoursMins($total);
                                }else{
                                    $style = 'style="background-color:red;color:#fff"';
                                }
                                $sum+=$total;
                                echo '<td '.$style.'>'.$total;
                                ?>
                            </td>
                            <?php if($isAdmin){?>
                            <td>
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>',
                                    array('action' => 'edit', $attendance['StaffAttendance']['id']),
                                    array('escape' => false, 'title' => 'Thay đổi thông tin')); ?>
                            </td>
                            <?php }?>
                        </tr>

                    <?php endforeach; ?>
                    <tr>
                        <td colspan="6" class="text-right">
                            <strong>Tổng cộng</strong>
                        </td>
                        <td>
                            <?php echo $sum;?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
