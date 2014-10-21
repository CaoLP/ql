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
						<th><?php echo $this->Paginator->sort ('number','Số chứng từ'); ?></th>
						<th><?php echo $this->Paginator->sort ('type','Loại chứng từ'); ?></th>
						<th><?php echo $this->Paginator->sort ('store_id','Cửa hàng'); ?></th>
						<th><?php echo $this->Paginator->sort ('description','Lý do'); ?></th>
						<th><?php echo $this->Paginator->sort ('total','Số tiền'); ?></th>
						<th><?php echo $this->Paginator->sort ('person_one','Bên A'); ?></th>
						<th><?php echo $this->Paginator->sort ('person_two','Bên B'); ?></th>
						<th><?php echo $this->Paginator->sort ('created','Ngày tạo'); ?></th>
						<th><?php echo $this->Paginator->sort ('created_by','Người tạo'); ?></th>
						<th><?php echo $this->Paginator->sort ('updated','Ngày thay đổi'); ?></th>
						<th><?php echo $this->Paginator->sort ('updated_by','Người thay đổi'); ?></th>
						<th class="actions"><?php echo __ ('Actions'); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($reexes as $reex): ?>
						<tr>
							<td><?php echo h ($reex['Reex']['id']); ?>&nbsp;</td>
							<td><?php echo h ($reex['Reex']['number']); ?>&nbsp;</td>
							<td><?php echo h ($reex['Reex']['type']); ?>&nbsp;</td>
							<td>
								<?php echo $this->Html->link ($reex['Store']['name'], array ('controller' => 'stores', 'action' => 'view', $reex['Store']['id'])); ?>
							</td>
							<td><?php echo h ($reex['Reex']['description']); ?>&nbsp;</td>
							<td><?php echo h ($reex['Reex']['total']); ?>&nbsp;</td>
							<td><?php echo h ($reex['Reex']['person_one']); ?>&nbsp;</td>
							<td><?php echo h ($reex['Reex']['person_two']); ?>&nbsp;</td>
							<td><?php echo h ($reex['Reex']['company']); ?>&nbsp;</td>
							<td><?php echo h ($reex['Reex']['created']); ?>&nbsp;</td>
							<td><?php echo h ($reex['Reex']['created_by']); ?>&nbsp;</td>
							<td><?php echo h ($reex['Reex']['updated']); ?>&nbsp;</td>
							<td><?php echo h ($reex['Reex']['updated_by']); ?>&nbsp;</td>
							<td class="actions">
								<?php echo $this->Html->link (__ ('View'), array ('action' => 'view', $reex['Reex']['id'])); ?>
								<?php echo $this->Html->link (__ ('Edit'), array ('action' => 'edit', $reex['Reex']['id'])); ?>
								<?php echo $this->Form->postLink (__ ('Delete'), array ('action' => 'delete', $reex['Reex']['id']), array (), __ ('Are you sure you want to delete # %s?', $reex['Reex']['id'])); ?>
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
