<div class="panel-heading">
    <h3 class="panel-title">
        <a href="javascript:void(0);" class="toggle-sidebar">
            <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>
        <?php echo __('Edit Setting'); ?>    </h3>
</div>
<div class="panel-body">
    <div class="col-md-12">
        <?php echo $this->Form->create('Setting', array('role' => 'form')); ?>

        <div class="form-group">
            <?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id')); ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input('parent_id', array('class' => 'form-control','empty'=>__('__Select parent__'), 'placeholder' => 'Parent Id')); ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name')); ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input('key', array('class' => 'form-control', 'placeholder' => 'Key')); ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input('data', array('class' => 'form-control', 'placeholder' => 'Data')); ?>
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

