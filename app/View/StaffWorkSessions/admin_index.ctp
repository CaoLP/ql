<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <div class="title pull-right">
                    <?php echo $this->Html->link(
                        '<span aria-hidden="true" class="icon-plus"></span> Tạo mới',
                        array('action' => 'add'),
                        array('class' => 'btn btn-sm btn-success', 'escape' => false));?>
                </div>
                <h3>Ca làm việc của nhân viên</h3>
            </div>
            <div class="widget-body">
                <table class="table table-condensedtable-hover no-margin">
                    <thead>
                    <tr>
                        <th><?php echo $this->Paginator->sort('staff_id','Nhân viên'); ?></th>
                        <th><?php echo $this->Paginator->sort('work_session_id','Ca làm'); ?></th>
                        <th><?php echo $this->Paginator->sort('basic_salary','Lương cơ bản'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($staff_work_sessions as $staff_work_session):
                        ?>
                        <tr class="table-toggle-expand">
                            <td><?php echo h($staff_work_session['User']['name']); ?></td>
                            <td><?php echo h($staff_work_session['WorkSession']['name']); ?></td>
                            <td><?php echo h($staff_work_session['StaffWorkSession']['basic_salary']); ?></td>
                            <td class="actions">
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit', $staff_work_session['StaffWorkSession']['id']), array('escape' => false, 'title' => 'Thay đổi thông tin')); ?>
                                <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $staff_work_session['StaffWorkSession']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?', $staff_work_session['StaffWorkSession']['id'])); ?>
                            </td>
                        </tr>
                        <tr class="table-expandable"></tr>
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