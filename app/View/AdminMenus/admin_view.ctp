<div class="adminMenus view">
<h2><?php echo __('Admin Menu'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($adminMenu['AdminMenu']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($adminMenu['AdminMenu']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Icon'); ?></dt>
		<dd>
			<?php echo h($adminMenu['AdminMenu']['icon']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($adminMenu['AdminMenu']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($adminMenu['Group']['name'], array('controller' => 'groups', 'action' => 'view', $adminMenu['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Admin Menu'); ?></dt>
		<dd>
			<?php echo $this->Html->link($adminMenu['ParentAdminMenu']['name'], array('controller' => 'admin_menus', 'action' => 'view', $adminMenu['ParentAdminMenu']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lft'); ?></dt>
		<dd>
			<?php echo h($adminMenu['AdminMenu']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rght'); ?></dt>
		<dd>
			<?php echo h($adminMenu['AdminMenu']['rght']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Admin Menu'), array('action' => 'edit', $adminMenu['AdminMenu']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Admin Menu'), array('action' => 'delete', $adminMenu['AdminMenu']['id']), array(), __('Are you sure you want to delete # %s?', $adminMenu['AdminMenu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Admin Menus'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin Menu'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Admin Menus'), array('controller' => 'admin_menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Admin Menu'), array('controller' => 'admin_menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Admin Menus'); ?></h3>
	<?php if (!empty($adminMenu['ChildAdminMenu'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Icon'); ?></th>
		<th><?php echo __('Url'); ?></th>
		<th><?php echo __('Group Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Lft'); ?></th>
		<th><?php echo __('Rght'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($adminMenu['ChildAdminMenu'] as $childAdminMenu): ?>
		<tr>
			<td><?php echo $childAdminMenu['id']; ?></td>
			<td><?php echo $childAdminMenu['name']; ?></td>
			<td><?php echo $childAdminMenu['icon']; ?></td>
			<td><?php echo $childAdminMenu['url']; ?></td>
			<td><?php echo $childAdminMenu['group_id']; ?></td>
			<td><?php echo $childAdminMenu['parent_id']; ?></td>
			<td><?php echo $childAdminMenu['lft']; ?></td>
			<td><?php echo $childAdminMenu['rght']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'admin_menus', 'action' => 'view', $childAdminMenu['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'admin_menus', 'action' => 'edit', $childAdminMenu['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'admin_menus', 'action' => 'delete', $childAdminMenu['id']), array(), __('Are you sure you want to delete # %s?', $childAdminMenu['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Admin Menu'), array('controller' => 'admin_menus', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
