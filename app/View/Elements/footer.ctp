<!-- Modal -->
<div class="modal fade" id="attendance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Điểm danh</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="input-group-addon">Tên Nhân viên</div>
                            <span  class="form-control"><?php echo $this->Session->read ('Auth.User.name'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="input-group-addon">Cửa hàng</div>
                            <span class="form-control"><?php echo $this->Session->read ('Auth.User.Store.name'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group has-error">
                            <div class="input-group-addon">Mã số</div>
                            <input name="data[Code][code]" class="form-control"
                                   type="text" id="Code" required="required">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group has-error">
                            <label class="radio-inline">
                                <input type="radio" name="data[Code][type]" value="option1"> Bắt đầu vào làm
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="data[Code][type]" value="option1"> Kết thúc giờ làm
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
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Chấp nhận</button>
            </div>
        </div>
    </div>
</div>