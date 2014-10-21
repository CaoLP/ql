<!-- Row start -->
<div class="row">
	<div class="col-md-12">
		<div class="widget">
			<div class="widget-header">
				<div class="title">
					<?php echo $this->Html->link ('Tạo mới', array ('action' => 'add'), array (
																							  'class' => 'btn btn-sm btn-success'
																						));?>
				</div>
			</div>
			<div class="widget-body">
				<table class="table table-condensed table-bordered table-hover no-margin">
					<thead>
					<tr>
						<th><?php echo $this->Paginator->sort ('id'); ?></th>
						<th><?php echo $this->Paginator->sort ('product_id'); ?></th>
						<th><?php echo $this->Paginator->sort ('category_id'); ?></th>
						<th class="actions"><?php echo __ ('Actions'); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($productCategories as $productCategory): ?>
						<tr>
							<td><?php echo h ($productCategory['ProductCategory']['id']); ?>&nbsp;</td>
							<td>
								<?php echo $this->Html->link ($productCategory['Product']['name'], array ('controller' => 'products', 'action' => 'view', $productCategory['Product']['id'])); ?>
							</td>
							<td>
								<?php echo $this->Html->link ($productCategory['Category']['name'], array ('controller' => 'categories', 'action' => 'view', $productCategory['Category']['id'])); ?>
							</td>
							<td class="actions">
								<?php echo $this->Html->link (__ ('View'), array ('action' => 'view', $productCategory['ProductCategory']['id'])); ?>
								<?php echo $this->Html->link (__ ('Edit'), array ('action' => 'edit', $productCategory['ProductCategory']['id'])); ?>
								<?php echo $this->Form->postLink (__ ('Delete'), array ('action' => 'delete', $productCategory['ProductCategory']['id']), array (), __ ('Are you sure you want to delete # %s?', $productCategory['ProductCategory']['id'])); ?>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<div class="dataTables_info" id="data-table_info">
					<?php
					echo $this->Paginator->counter (array (
														  'format' => __ ('Showing {:start} to {:end} {:count} entries')
													));
					?>
				</div>
				<div class="dataTables_paginate paging_full_numbers">
					<?php
					echo $this->Paginator->prev ('< ' . __ ('previous'), array (), null, array ('class' => 'prev disabled'));
					echo $this->Paginator->numbers (array ('separator' => ''));
					echo $this->Paginator->next (__ ('next') . ' >', array (), null, array ('class' => 'next disabled'));
					?>
				</div>
			</div>
		</div>
	</div>
</div>


<!--
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Product Category'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->