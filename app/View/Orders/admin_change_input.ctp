<?php
$this->Html->script(array('change_input'),array('inline'=>false));
?>
<script>
    var linkOrder = '<?php echo $this->Html->url(array('action'=>'index'));?>';
</script>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="widget">
            <div class="widget-header">
                <h3>Đổi hàng</h3>
            </div>
            <div class="widget-body">
                <div class="input-group">
                    <span class="input-group-addon">Nhập mã đơn hàng</span>
                    <input class="form-control" id="p-search" name="q">
                    <input type="hidden" class="form-control" id="p-search-hide" name="q">
                    <div class="input-group-btn">
                        <button class="btn btn-success" id="submit-change">Thực hiện</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>