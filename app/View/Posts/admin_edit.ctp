<div class="row">
    <div class="col-lg-12">
        <?php echo $this->Form->create('Post');?>
        <div class="form-group">
            <?php echo $this->Form->input('title', array('class' => 'form-control', 'placeholder' => 'Title'));?>
            <?php echo $this->Form->input('id');?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status'));?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input('type', array('class' => 'form-control', 'placeholder' => 'Type'));?>
        </div>
        <div class="form-group">
            <?php echo $this->Media->ckeditor('body', array('label' => array('text' => 'Nội dung', 'class' => 'control-label')));?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default', 'div'=>false)); ?>
            <?php echo $this->Form->reset(__('Cancel'), array('class'=>'btn btn-danger', 'div'=>false));?>
        </div>
        <?php echo $this->Form->end();?>
    </div>
</div>