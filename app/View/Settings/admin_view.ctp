<div class="settings view">
<h2><?php echo __('Setting'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Key'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creater'); ?></dt>
		<dd>
			<?php echo $this->Html->link($setting['Creater']['id'], array('controller' => 'users', 'action' => 'view', $setting['Creater']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($setting['Setting']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updater'); ?></dt>
		<dd>
			<?php echo $this->Html->link($setting['Updater']['id'], array('controller' => 'users', 'action' => 'view', $setting['Updater']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Setting'), array('action' => 'edit', $setting['Setting']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Setting'), array('action' => 'delete', $setting['Setting']['id']), array(), __('Are you sure you want to delete # %s?', $setting['Setting']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Settings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setting'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Creater'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
