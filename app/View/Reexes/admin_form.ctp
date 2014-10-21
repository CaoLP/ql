<div class="reexes form">
<?php echo $this->Form->create('Reex'); ?>
	<fieldset>
		<legend><?php echo __('Add Reex'); ?></legend>
	<?php
		echo $this->Form->input('number');
		echo $this->Form->input('type');
		echo $this->Form->input('store_id');
		echo $this->Form->input('description');
		echo $this->Form->input('total');
		echo $this->Form->input('person_one');
		echo $this->Form->input('person_two');
		echo $this->Form->input('company');
		echo $this->Form->input('note');
		echo $this->Form->input('created_by');
		echo $this->Form->input('updated_by');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Reexes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Stores'), array('controller' => 'stores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Store'), array('controller' => 'stores', 'action' => 'add')); ?> </li>
	</ul>
</div>
