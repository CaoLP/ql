<div class="panel-heading">
    <h3 class="panel-title">
        <a href="javascript:void(0);" class="toggle-sidebar">
            <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>
        <?php echo __('Front Menu'); ?>    </h3>
</div>
<div class="panel-body">
    <div class="col-md-12">
        <ul class="nav nav-pills nav-justified">
            		<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>'.__('Edit FrontMenu'), array('action' => 'edit', $FrontMenu['FrontMenu']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>'.__('Delete FrontMenu'), array('action' => 'delete', $FrontMenu['FrontMenu']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $FrontMenu['FrontMenu']['id'])); ?> </li>
		<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>'.__('List FrontMenus'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>'.__('New FrontMenu'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>'.__('List FrontMenus'), array('controller' => 'front_menus', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>'.__('New Parent FrontMenu'), array('controller' => 'front_menus', 'action' => 'add'), array('escape' => false)); ?> </li>

        </ul>
    </div>
    <div class="col-md-12">
        <table cellpadding="0" cellspacing="0" class="table table-striped">
            <tbody>
            <tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($FrontMenu['FrontMenu']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($FrontMenu['FrontMenu']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Icon'); ?></th>
		<td>
			<?php echo h($FrontMenu['FrontMenu']['icon']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Url'); ?></th>
		<td>
			<?php echo h($FrontMenu['FrontMenu']['url']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Parent FrontMenu'); ?></th>
		<td>
			<?php echo $this->Html->link($FrontMenu['ParentFrontMenu']['name'], array('controller' => 'front_menus', 'action' => 'view', $FrontMenu['ParentFrontMenu']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Lft'); ?></th>
		<td>
			<?php echo h($FrontMenu['FrontMenu']['lft']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Rght'); ?></th>
		<td>
			<?php echo h($FrontMenu['FrontMenu']['rght']); ?>
			&nbsp;
		</td>
</tr>
            </tbody>
        </table>

    </div>

            <div class="related row">
            <div class="col-md-12">
                <h3><?php echo __('Related FrontMenus'); ?></h3>
                <?php if (!empty($FrontMenu['ChildFrontMenu'])): ?>
                <table cellpadding = "0" cellspacing = "0" class="table table-striped">
                    <thead>
                    <tr>
                        		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Icon'); ?></th>
		<th><?php echo __('Url'); ?></th>
		<th><?php echo __('Group Ids'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Lft'); ?></th>
		<th><?php echo __('Rght'); ?></th>
                        <th class="actions"></th>
                    </tr>
                    <thead>
                    <tbody>
                    	<?php foreach ($FrontMenu['ChildFrontMenu'] as $childFrontMenu): ?>
		<tr>
			<td><?php echo $childFrontMenu['id']; ?></td>
			<td><?php echo $childFrontMenu['name']; ?></td>
			<td><?php echo $childFrontMenu['icon']; ?></td>
			<td><?php echo $childFrontMenu['url']; ?></td>
			<td><?php echo $childFrontMenu['group_ids']; ?></td>
			<td><?php echo $childFrontMenu['parent_id']; ?></td>
			<td><?php echo $childFrontMenu['lft']; ?></td>
			<td><?php echo $childFrontMenu['rght']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('controller' => 'front_menus', 'action' => 'view', $childFrontMenu['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('controller' => 'front_menus', 'action' => 'edit', $childFrontMenu['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('controller' => 'front_menus', 'action' => 'delete', $childFrontMenu['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $childFrontMenu['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>

                <div class="actions">
                    <?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>'.__('New Child FrontMenu'), array('controller' => 'front_menus', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?>                </div>
            </div><!-- end col md 12 -->
        </div>
    
</div>

