<!-- Row start -->
<div class="row">
    <div class="col-md-10">
        <div class="row">
            <div class="widget">
                <div class="widget-header">
                    <div class="title">
						<span class="fs1" aria-hidden="true"
                              data-icon="&#xe039;"></span> <?php echo __ ('Thông tin điểm danh "%s"' , $this->request->data['Staff']['name'] ); ?>
                    </div>
                </div>
                <div class="widget-body">
                        <?php echo $this->Form->create('StaffAttendance', array('role' => 'form')); ?>
                        <div class="form-group">
                            <?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('staff_id', array('class' => 'form-control', 'placeholder' => 'Option Id')); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $this->Form->input('begin_time', array('timeFormat' => '24','class' => 'form-control', 'placeholder' => 'Thời gian bắt đầu')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('delay_time_begin', array('class' => 'form-control', 'placeholder' => 'Đi trể')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('note_begin', array('class' => 'form-control', 'placeholder' => 'Ghi chú bắt đầu')); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $this->Form->input('end_time', array('timeFormat' => '24','class' => 'form-control', 'placeholder' => 'Thời gian kết thúc')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('delay_time_end', array('class' => 'form-control', 'placeholder' => 'Về sớm')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('note_end', array('class' => 'form-control', 'placeholder' => 'Ghi chú kết thúc')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
                        </div>
                        <?php echo $this->Form->end() ?>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end (); ?>
    </div>
    <div class="col-md-2" id="leftCol">
    </div>
</div>