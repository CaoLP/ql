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
						<th><?php echo $this->Paginator->sort ('number','Số chứng từ'); ?></th>
						<th><?php echo $this->Paginator->sort ('type','Loại chứng từ'); ?></th>
						<th><?php echo $this->Paginator->sort ('store_id','Cửa hàng'); ?></th>
						<th><?php echo $this->Paginator->sort ('note','Ghi chú'); ?></th>
						<th><?php echo $this->Paginator->sort ('total','Số tiền'); ?></th>
						<th><?php echo $this->Paginator->sort ('person_one','Bên A'); ?></th>
						<th><?php echo $this->Paginator->sort ('person_two','Bên B'); ?></th>
						<th><?php echo $this->Paginator->sort ('created_date','Ngày tạo'); ?></th>
						<th><?php echo $this->Paginator->sort ('created_by','Người tạo'); ?></th>
						<th class="actions"><?php echo __ ('Actions'); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($reexes as $reex): ?>
						<tr>
							<td><?php echo h ($reex['Reex']['number']); ?>&nbsp;</td>
							<td><span class="label <?php if($reex['Reex']['type']==0)echo 'label-success';else echo 'label-info'?>"><?php echo h ($types[$reex['Reex']['type']]); ?></span></td>
							<td>
								<?php echo $this->Html->link ($reex['Store']['name'], array ('controller' => 'stores', 'action' => 'view', $reex['Store']['id'])); ?>
							</td>
							<td><?php echo h ($reex['Reex']['note']); ?>&nbsp;</td>
							<td class="price-text"><?php echo number_format($reex['Reex']['total'], 0, '.', ',');?></td>
							<td><?php echo h ($reex['Reex']['person_one']); ?>&nbsp;</td>
							<td><?php echo h ($reex['Reex']['person_two']); ?>&nbsp;</td>
							<td><?php echo h (date('d/m/Y',strtotime($reex['Reex']['created_date']))); ?>&nbsp;</td>
							<td><?php echo h ($reex['TrackableCreator']['name']); ?>&nbsp;</td>
							<td class="actions">
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view', $reex['Reex']['id']), array('escape' => false,'title'=>'Xem thông tin')); ?>
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit', $reex['Reex']['id']), array('escape' => false,'title'=>'Thay đổi thông tin')); ?>
                                <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $reex['Reex']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?', $reex['Reex']['id'])); ?>
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
