<div class="panel-heading">
    <h3 class="panel-title">
        <a href="javascript:void(0);" class="toggle-sidebar">
            <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>
        <?php echo __('Front Menus'); ?>    </h3>
</div>
<div class="panel-body">
    <div class="col-md-12">
        <ul class="nav nav-pills nav-justified">
            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>'.__('New Front Menu'), array('action' => 'add'), array('escape' => false)); ?></li>
            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>'.__('List Front Menus'), array('controller' => 'front_menus', 'action' => 'index'), array('escape' => false)); ?> </li>
            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>'.__('New Parent Front Menu'), array('controller' => 'front_menus', 'action' => 'add'), array('escape' => false)); ?> </li>
        </ul>
    </div>
    <div class="col-md-12">
        <?php echo $this->Session->flash(); ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Icon</th>
                <th>Url</th>
                <th>Parent</th>
                <th>lft</th>
                <th>rght</th>
                <th class="actions"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($frontMenus as $frontMenu): ?>
                <tr>
                    <td><?php echo h($frontMenu['FrontMenu']['name']); ?>&nbsp;</td>
                    <td><?php echo h($frontMenu['FrontMenu']['icon']); ?>&nbsp;</td>
                    <td><?php echo h($frontMenu['FrontMenu']['url']); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Html->link($frontMenu['ParentFrontMenu']['name'], array('controller' => 'front_menus', 'action' => 'view', $frontMenu['ParentFrontMenu']['id'])); ?>
                    </td>
                    <td><?php echo h($frontMenu['FrontMenu']['lft']); ?>&nbsp;</td>
                    <td><?php echo h($frontMenu['FrontMenu']['rght']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $frontMenu['FrontMenu']['id']), array('escape' => false)); ?>
                        <?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $frontMenu['FrontMenu']['id']), array('escape' => false)); ?>
                        <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $frontMenu['FrontMenu']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $frontMenu['FrontMenu']['id'])); ?>
                    </td>
                </tr>
                <?php
                $this->Menu->loopChildMenu($frontMenu['ChildFrontMenu'],$frontMenu['FrontMenu']['name']);
                ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

