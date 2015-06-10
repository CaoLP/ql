<div class="row">
    <div class="col-lg-12">
        <?php echo $this->Form->create('Post');?>
        <div class="form-group">
            <?php echo $this->Form->input('title', array('class' => 'form-control', 'placeholder' => 'Title'));?>
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