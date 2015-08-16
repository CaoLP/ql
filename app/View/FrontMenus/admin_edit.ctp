<div class="panel-heading">
    <h3 class="panel-title">
        <a href="javascript:void(0);" class="toggle-sidebar">
            <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>
        <?php echo __('Edit Front Menu'); ?>    </h3>
</div>
<div class="panel-body">
    <div class="col-md-12">
        <ul class="nav nav-pills nav-justified">
            <li><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>'.__('Delete'), array('action' => 'delete', $this->Form->value('FrontMenu.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('FrontMenu.id'))); ?></li>
            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>'.__('List Front Menus'), array('action' => 'index'), array('escape' => false)); ?></li>
            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>'.__('List Front Menus'), array('controller' => 'front_menus', 'action' => 'index'), array('escape' => false)); ?> </li>
            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>'.__('New Parent Front Menu'), array('controller' => 'front_menus', 'action' => 'add'), array('escape' => false)); ?> </li>
        </ul>
    </div>
    <div class="col-md-12">
        <?php echo $this->Form->create('FrontMenu', array('role' => 'form')); ?>

        <div class="form-group">
            <?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id')); ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name')); ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input('icon', array('class' => 'form-control', 'placeholder' => 'Icon')); ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input('url', array('class' => 'form-control', 'type'=>'text', 'placeholder' => 'Url', 'empty' => '___SELECT PATH___')); ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input('parent_id', array('class' => 'form-control', 'placeholder' => 'Parent Id', 'empty' =>'__Parents__')); ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input('menu_position_id', array('class' => 'form-control', 'placeholder' => 'Position', 'empty' =>'__Position__')); ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
        </div>

        <?php echo $this->Form->end() ?>


    </div>
</div>

