<div class="customerPromotes view">
<h2><?php echo __('Customer Promote'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($customerPromote['CustomerPromote']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($customerPromote['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $customerPromote['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Promote'); ?></dt>
		<dd>
			<?php echo $this->Html->link($customerPromote['Promote']['name'], array('controller' => 'promotes', 'action' => 'view', $customerPromote['Promote']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($customerPromote['CustomerPromote']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Create By'); ?></dt>
		<dd>
			<?php echo h($customerPromote['CustomerPromote']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($customerPromote['CustomerPromote']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Update By'); ?></dt>
		<dd>
			<?php echo h($customerPromote['CustomerPromote']['updated_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Customer Promote'), array('action' => 'edit', $customerPromote['CustomerPromote']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Customer Promote'), array('action' => 'delete', $customerPromote['CustomerPromote']['id']), array(), __('Are you sure you want to delete # %s?', $customerPromote['CustomerPromote']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Customer Promotes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer Promote'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Promotes'), array('controller' => 'promotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promote'), array('controller' => 'promotes', 'action' => 'add')); ?> </li>
	</ul>
</div>
