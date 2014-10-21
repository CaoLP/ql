<div class="optionGroups view">
<h2><?php echo __('Option Group'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($optionGroup['OptionGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($optionGroup['OptionGroup']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Option Group'), array('action' => 'edit', $optionGroup['OptionGroup']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Option Group'), array('action' => 'delete', $optionGroup['OptionGroup']['id']), array(), __('Are you sure you want to delete # %s?', $optionGroup['OptionGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Option Groups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Option Group'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Options'), array('controller' => 'options', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Option'), array('controller' => 'options', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Options'); ?></h3>
	<?php if (!empty($optionGroup['Option'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Option Group Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($optionGroup['Option'] as $option): ?>
		<tr>
			<td><?php echo $option['id']; ?></td>
			<td><?php echo $option['name']; ?></td>
			<td><?php echo $option['option_group_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'options', 'action' => 'view', $option['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'options', 'action' => 'edit', $option['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'options', 'action' => 'delete', $option['id']), array(), __('Are you sure you want to delete # %s?', $option['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Option'), array('controller' => 'options', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
