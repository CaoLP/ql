<div class="options view">
<h2><?php echo __('Option'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($option['Option']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($option['Option']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Option Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($option['OptionGroup']['name'], array('controller' => 'option_groups', 'action' => 'view', $option['OptionGroup']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Option'), array('action' => 'edit', $option['Option']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Option'), array('action' => 'delete', $option['Option']['id']), array(), __('Are you sure you want to delete # %s?', $option['Option']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Options'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Option'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Option Groups'), array('controller' => 'option_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Option Group'), array('controller' => 'option_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
