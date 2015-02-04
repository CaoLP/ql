<?php
$this->Html->script(array('staff_attendances'), array('inline' => false));
?>
<script>
    var linkOrder = '<?php echo $this->Html->url(array('action'=>'index'));?>';
</script>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="widget">
            <div class="widget-header">
                <h3>Điểm danh</h3>
            </div>
            <div class="widget-body">
                <div class="input-group">
                    <span class="input-group-addon">Mã nhân viên</span>
                    <input class="form-control" id="p-search" name="q">
                    <input type="hidden" class="form-control" id="p-search-hide" name="q">

                    <div class="input-group-btn">
                        <button class="btn btn-success" id="submit-change">Chấp nhận</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6" id="select-session">
        <div class="widget">
            <div class="widget-header">
                <h4>Ca 1 (7:00 - 12:00)</h4>
            </div>
            <div class="widget-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <label class="radio-inline col-lg-6">
                                <input type="radio" name="type">Vào làm
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label class="radio-inline">
                                <input type="radio" name="type">Ra về
                            </label>
                        </div>
                    </div>
                </div>
                <p></p>
                <div class="row">
                    <div class="col-lg-12">
                        <textarea class="col-lg-12" name="note"></textarea>
                    </div>
                </div>
                <p></p>
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-success col-lg-12">Xác nhận</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget">
            <div class="widget-header">
                <h4>Ca 2</h4>
            </div>
            <div class="widget-body">

            </div>
        </div>
        <div class="widget">
            <div class="widget-header">
                <h4>Ca 3</h4>
            </div>
            <div class="widget-body">
            </div>
        </div>
        <div class="widget">
            <div class="widget-header">
                <h4>Ca 4</h4>
            </div>
            <div class="widget-body">
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>