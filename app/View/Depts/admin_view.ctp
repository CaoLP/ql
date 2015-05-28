<div class="debts view">
<h2><?php echo __('Dept'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dept['Dept']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($dept['Dept']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dept['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $dept['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
            <?php echo $this->Html->link($dept['Order']['code'], array('controller' => 'orders', 'action' => 'view', $dept['Order']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total'); ?></dt>
		<dd>
			<?php echo h($dept['Dept']['total']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paid'); ?></dt>
		<dd>
			<?php echo h($dept['Dept']['paid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pending'); ?></dt>
		<dd>
			<?php echo h($dept['Dept']['pending']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($dept['Dept']['note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($dept['Dept']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo h($dept['Creater']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($dept['Dept']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo h($dept['Updater']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
