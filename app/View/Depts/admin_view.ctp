<div class="reexes view">
<h2><?php echo __('Reex'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($reex['Reex']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number'); ?></dt>
		<dd>
			<?php echo h($reex['Reex']['number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($reex['Reex']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Store'); ?></dt>
		<dd>
			<?php echo $this->Html->link($reex['Store']['name'], array('controller' => 'stores', 'action' => 'view', $reex['Store']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($reex['Reex']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total'); ?></dt>
		<dd>
			<?php echo h($reex['Reex']['total']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Person One'); ?></dt>
		<dd>
			<?php echo h($reex['Reex']['person_one']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Person Two'); ?></dt>
		<dd>
			<?php echo h($reex['Reex']['person_two']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company'); ?></dt>
		<dd>
			<?php echo h($reex['Reex']['company']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($reex['Reex']['note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($reex['Reex']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo h($reex['Reex']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($reex['Reex']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo h($reex['Reex']['updated_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Reex'), array('action' => 'edit', $reex['Reex']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Reex'), array('action' => 'delete', $reex['Reex']['id']), array(), __('Are you sure you want to delete # %s?', $reex['Reex']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Reexes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reex'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stores'), array('controller' => 'stores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Store'), array('controller' => 'stores', 'action' => 'add')); ?> </li>
	</ul>
</div>
