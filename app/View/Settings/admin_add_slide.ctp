<div class="panel-heading">
    <h3 class="panel-title">
        <a href="javascript:void(0);" class="toggle-sidebar">
            <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>
        <?php echo __('Thêm Slide'); ?>
    </h3>
</div>
<div class="panel-body">
    <div class="col-md-12">
        <?php echo $this->Form->create('Setting', array('role' => 'form')); ?>
        <?php echo $this->Form->hidden('parent_id');?>
        <?php echo $this->Form->hidden('id');?>
        <?php echo $this->Form->hidden('name');?>
        <?php echo $this->Form->hidden('key');?>
        <div class="form-group">
            <?php echo $this->Form->input('data', array('class' => 'form-control','type' => 'text', 'placeholder' => 'Đường dẫn')); ?>
        </div>
        <div class="form-group">
            <?php echo $this->Media->iframe('Setting', $this->request->data['Setting']['id']); ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
        </div>

        <?php echo $this->Form->end() ?>


    </div>
</div>

