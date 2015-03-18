<?php
$this->Html->script(array('staff_attendances'), array('inline' => false));
?>
<script>
    var linkUsers = '<?php echo $this->Html->url(array('action'=>'user_list'));?>';
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
    </div>
    <div class="col-md-3"></div>
</div>