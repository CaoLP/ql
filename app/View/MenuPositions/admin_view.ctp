<div class="panel-heading">
    <h3 class="panel-title">
        <a href="javascript:void(0);" class="toggle-sidebar">
            <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>
        <?php echo __('Menu Position'); ?>    </h3>
</div>
<div class="panel-body">
    <div class="col-md-12">
        <ul class="nav nav-pills nav-justified">
            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>' . __('Edit Menu Position'), array('action' => 'edit', $menuPosition['MenuPosition']['id']), array('escape' => false)); ?> </li>
            <li><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>' . __('Delete Menu Position'), array('action' => 'delete', $menuPosition['MenuPosition']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $menuPosition['MenuPosition']['id'])); ?> </li>
            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>' . __('List Menu Positions'), array('action' => 'index'), array('escape' => false)); ?> </li>
            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>' . __('New Menu Position'), array('action' => 'add'), array('escape' => false)); ?> </li>
            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>' . __('List Options'), array('controller' => 'options', 'action' => 'index'), array('escape' => false)); ?> </li>
            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>' . __('New Option'), array('controller' => 'options', 'action' => 'add'), array('escape' => false)); ?> </li>

        </ul>
    </div>
    <div class="col-md-12">
        <table cellpadding="0" cellspacing="0" class="table table-striped">
            <tbody>
            <tr>
                <th><?php echo __('Id'); ?></th>
                <td>
                    <?php echo h($menuPosition['MenuPosition']['id']); ?>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <th><?php echo __('Name'); ?></th>
                <td>
                    <?php echo h($menuPosition['MenuPosition']['name']); ?>
                    &nbsp;
                </td>
            </tr>
            </tbody>
        </table>

    </div>


</div>

