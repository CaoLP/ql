<!-- Modal -->
<script>
    var attendancelink = '<?php
                                    echo $this->Html->url(
                                            array(
                                                    'admin'=>true,
                                                    'controller'=>'staff_timesheet',
                                                    'action'=> 'add'
                                            )
                                    );
    ?>';
</script>
<div class="modal fade" id="attendance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Điểm danh</h4>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="attendance-msg">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Tên Nhân viên</div>
                                <span class="form-control"><?php echo $this->Session->read('Auth.User.name'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Cửa hàng</div>
                                <span
                                    class="form-control"><?php echo $this->Session->read('Auth.User.Store.name'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group has-error">
                                <div class="input-group-addon">Mã số</div>
                                <input name="data[Code][code]" class="form-control"
                                       type="text" id="Code" required="required" placeholder="Nhập mã nhân viên">
                                <input name="data[Code][id]" class="form-control"
                                       type="hidden" value="<?php echo $this->Session->read('Auth.User.id'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-error">
                                <label class="radio-inline">
                                    <input type="radio" name="data[Code][type]" value="0"> Bắt đầu vào làm
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="data[Code][type]" value="1"> Kết thúc giờ làm
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea name="data[Code][note]" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="attendance-btn">Chấp nhận</button>
            </div>
        </div>
    </div>
</div>

<a href="javascript:;" class="btn btn-info real-log-btn text-center" id="real-log-btn" title="Thông tin hệ thống"><i class="icon icon-envelope"></i></a>
<div class="real-log" id="real-log">
    <div class="row">
        <div class="col-md-12">
            <a href="javascript:;" class="btn btn-info real-log-btn text-center" id="real-log-close"><i class="icon icon-close"></i></a>
            <div class="title">Thông tin hệ thống</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="realtime-log">

        </div>
    </div>

</div>