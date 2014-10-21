<!-- Row start -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
			<div class="widget-header">
				<div class="title">
					<?php echo $this->Html->link('Tạo mới',array('action'=>'add'),array(
																					   'class'=>'btn btn-sm btn-success'
																				  ));?>
				</div>
			</div>
            <div class="widget-body">
                <table class="table table-condensed table-bordered table-hover no-margin">
                    <thead>
                    <tr>
                        <th><?php echo $this->Paginator->sort('id'); ?></th>
                        <th><?php echo $this->Paginator->sort('username','Tên đăng nhập'); ?></th>
                        <th><?php echo $this->Paginator->sort('group_id', 'Quyền'); ?></th>
                        <th><?php echo $this->Paginator->sort('name','Tên'); ?></th>
                        <th><?php echo $this->Paginator->sort('phone', 'Điện thoại'); ?></th>
                        <th><?php echo $this->Paginator->sort('store_id','Shop'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo h($user['User']['id']); ?>&nbsp;</td>
                            <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                            <td><?php echo h($user['Group']['name']); ?>&nbsp;</td>
							<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
                            <td><?php echo h($user['User']['phone']); ?>&nbsp;</td>
                            <td>
                                <?php echo $this->Html->link($user['Store']['name'], array('controller' => 'stores', 'action' => 'view', $user['Store']['id'])); ?>
                            </td>
                            <td class="actions">
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view', $user['User']['id']), array('escape' => false,'title'=>'Xem thông tin')); ?>
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit', $user['User']['id']), array('escape' => false,'title'=>'Thay đổi thông tin')); ?>
                                <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $user['User']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="dataTables_info" id="data-table_info">
                    <?php
                    echo $this->Paginator->counter(array(
                        'format' => __('Showing {:start} to {:end} {:count} entries')
                    ));
                    ?>
                </div>
                <div class="dataTables_paginate paging_full_numbers">
                    <?php
                    echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                    echo $this->Paginator->numbers(array('separator' => ''));
                    echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
