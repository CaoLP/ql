<!-- Row start -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    <?php echo $this->Html->link('Tạo mới', array('action' => 'add'), array(
                        'class' => 'btn btn-sm btn-success'
                    ));?>
                </div>
            </div>
            <div class="widget-body">
                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                    <div class="form-inline" id="data-table_filter"><label>Tìm kiếm
                            <form action="" method="get">
                                <div class="form-group">
                                    <input type="text" name="data[name]" value="<?php echo $name;?>"  class="form-control" placeholder="Tên khách">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="data[promote_code]" value="<?php echo $promote_code;?>"  class="form-control" placeholder="Mã số giảm giá">
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->input('promote_type',array(
                                        'empty'=>array(0=>'--Chọn loại khuyến mãi--'),
                                        'options'=>$promotes,
                                        'selected'=>$promote_type,
                                        'class'=>'form-control',
                                        'placeholder'=>'Loại giảm giá',
                                        'label'=>false

                                    ));
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->input('status',array(
                                        'empty'=>array(0=>'--Chọn tình trạng--'),
                                        'options'=>$statuses,
                                        'selected'=>$status,
                                        'class'=>'form-control',
                                        'placeholder'=>'Loại giảm giá',
                                        'label'=>false
                                    ));
                                    ?>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-default" type="submit" data-original-title="">Tìm</button>
                                </div>
                            </form>
                        </label></div>
                    <table class="table table-condensed table-bordered table-hover no-margin">
                        <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('id'); ?></th>
                            <th><?php echo $this->Paginator->sort('customer_id', 'Tên khách'); ?></th>
                            <th><?php echo $this->Paginator->sort('promote_id', 'Loại giảm giá'); ?></th>
                            <th><?php echo $this->Paginator->sort('promote_code', 'Mã số'); ?></th>
                            <th><?php echo $this->Paginator->sort('used', 'Sử dụng'); ?></th>
                            <th><?php echo $this->Paginator->sort('created', 'Ngày tạo'); ?></th>
                            <th><?php echo $this->Paginator->sort('created_by', 'Người tạo'); ?></th>
                            <th><?php echo $this->Paginator->sort('updated', 'Ngày thay đổi'); ?></th>
                            <th><?php echo $this->Paginator->sort('updated_by', 'Người thay đổi'); ?></th>
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($customerPromotes as $customerPromote): ?>
                            <tr>
                                <td><?php echo h($customerPromote['CustomerPromote']['id']); ?>&nbsp;</td>
                                <td>
                                    <?php echo $this->Html->link($customerPromote['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $customerPromote['Customer']['id'])); ?>
                                </td>
                                <td>
                                    <?php echo $this->Html->link($customerPromote['Promote']['name'], array('controller' => 'promotes', 'action' => 'view', $customerPromote['Promote']['id'])); ?>
                                </td>
                                <td><?php echo h($customerPromote['CustomerPromote']['promote_code']); ?>&nbsp;</td>
                                <td id="<?php echo 'toggle-' . $customerPromote['CustomerPromote']['id'] ?>" class="tb-toggle">
                                    <a href="javascript:;;"
                                       onclick="admin.toggle('<?php echo $this->Html->url(
                                           array(
                                               'admin' => true,
                                               'controller' => 'customer_promotes',
                                               'action' => 'toggle',
                                               $customerPromote['CustomerPromote']['id'],
                                               $customerPromote['CustomerPromote']['used'],
                                           )
                                       );?>',<?php echo $customerPromote['CustomerPromote']['id']; ?>);return false;">
                                        <?php echo $this->Html->image('/img/icons/allow-' . $customerPromote['CustomerPromote']['used'] . '.png'); ?>
                                    </a>
                                </td>
                                <td><?php echo h($customerPromote['CustomerPromote']['created']); ?>&nbsp;</td>
                                <td>
                                    <?php echo $this->Html->link($customerPromote['Creater']['name'],
                                        array('controller' => 'users', 'action' => 'view', $customerPromote['Creater']['id'])); ?>
                                </td>
                                <td><?php echo h($customerPromote['CustomerPromote']['updated']); ?>&nbsp;</td>
                                <td>
                                    <?php echo $this->Html->link($customerPromote['Updater']['name'],
                                        array('controller' => 'users', 'action' => 'view', $customerPromote['Updater']['id'])); ?>
                                </td>
                                <td class="actions">
                                    <?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view', $customerPromote['CustomerPromote']['id']), array('escape' => false, 'title' => 'Xem thông tin')); ?>
                                    <?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit', $customerPromote['CustomerPromote']['id']), array('escape' => false, 'title' => 'Thay đổi thông tin')); ?>
                                    <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $customerPromote['CustomerPromote']['id']), array('escape' => false, 'title' => 'Xoá'), __('Are you sure you want to delete # %s?', $customerPromote['CustomerPromote']['id'])); ?>
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
</div>