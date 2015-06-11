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
				<table class="table table-condensed  table-hover no-margin">
					<thead>
					<tr>
						<th><?php echo $this->Paginator->sort ('name','Tên'); ?></th>
						<th><?php echo $this->Paginator->sort ('customer_id','Khách hàng'); ?></th>
						<th><?php echo $this->Paginator->sort ('order_id','Mã đơn hàng'); ?></th>
						<th><?php echo $this->Paginator->sort ('total','Số tiền'); ?></th>
						<th><?php echo $this->Paginator->sort ('paid','Đã trả'); ?></th>
						<th><?php echo $this->Paginator->sort ('pending','Còn lại'); ?></th>
                        <th><?php echo $this->Paginator->sort ('note','Ghi chú'); ?></th>
                        <th class="actions"><?php echo __ ('Actions'); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($depts as $dept): ?>
						<tr>
							<td><?php echo h ($dept['Dept']['name']); ?>&nbsp;</td>
							<td>
                                <?php echo $this->Html->link ($dept['Customer']['name'], array ('controller' => 'customers', 'action' => 'view', $dept['Customer']['id'])); ?>
							</td>
							<td>
								<?php
                                if($dept['Order']['type'] == 0)
                                echo $this->Html->link ($dept['Order']['code'], array ('controller' => 'orders', 'action' => 'view', $dept['Order']['id']));
                                else
                                echo $this->Html->link ($dept['Order']['code'], array ('controller' => 'orders', 'action' => 'viewretail', $dept['Order']['id']));
                                ?>
							</td>
							<td class="price-text"><?php echo number_format($dept['Dept']['total'], 0, '.', ',');?></td>
							<td><?php echo number_format($dept['Dept']['paid'], 0, '.', ',');?></td>
							<td><?php echo number_format($dept['Dept']['pending'], 0, '.', ',');?></td>
                            <td><?php echo h ($dept['Dept']['note']); ?>&nbsp;</td>
                            <td class="actions">
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view', $dept['Dept']['id']), array('escape' => false,'title'=>'Xem thông tin')); ?>
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit', $dept['Dept']['id']), array('escape' => false,'title'=>'Thay đổi thông tin')); ?>
                                <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $dept['Dept']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?', $dept['Dept']['id'])); ?>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
                <div class="row">
                    <div class="col-md-12">
                        <div class=" pull-right">
                            <div class="dataTables_info" id="data-table_info">
                                <?php
                                echo $this->Paginator->counter(array(
                                    'format' => __('Showing {:start} to {:end} {:count} entries')
                                ));
                                ?>
                            </div>
                            <ul class="pagination pull-right">
                                <?php
                                echo $this->Paginator->prev(__('&laquo;'), array('tag' => 'li','escape'=>false), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a','escape'=>false));
                                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                                echo $this->Paginator->next(__('&raquo;'), array('tag' => 'li','currentClass' => 'disabled','escape'=>false), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a','escape'=>false));
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
