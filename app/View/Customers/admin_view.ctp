<?php
$this->Html->addCrumb('<li>' . $title_for_layout . '</li>', array('action' => 'index'), array('escape' => false));
$this->Html->addCrumb('<li>' . $customer['Customer']['name'] . '</li>', '/' . $this->request->url, array('escape' => false));
?>
<!-- Row start -->
<div class="row">
    <div class="col-md-10">
        <div class="row">
            <div class="widget">
                <div class="widget-header">
                    <div class="title">
						<span class="fs1" aria-hidden="true"
                              data-icon="&#xe039;"></span> <?php echo __('Thông tin khách hàng'); ?>
                    </div>
                </div>
                <div class="widget-body">
                    <table class="table table-striped table-hover">
                        <tbody>
                        <tr>
                            <td><?php echo __('Id'); ?></td>
                            <td>
                                <?php echo h($customer['Customer']['id']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Họ Tên'); ?></td>
                            <td>
                                <?php echo h($customer['Customer']['name']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Số điện thoại'); ?></td>
                            <td>
                                <?php echo h($customer['Customer']['phone']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Email'); ?></td>
                            <td>
                                <?php echo h($customer['Customer']['email']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Địa chỉ'); ?></td>
                            <td>
                                <?php echo h($customer['Customer']['address']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Quận'); ?></td>
                            <td>
                                <?php echo h($customer['Customer']['district']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Thành phố'); ?></td>
                            <td>
                                <?php echo h($customer['Customer']['city']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Ngày tạo'); ?></td>
                            <td>
                                <?php echo h($customer['Customer']['created']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Người tạo'); ?></td>
                            <td>
                                <?php echo h($customer['Creater']['name']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Ngày thay đổi'); ?></td>
                            <td>
                                <?php echo h($customer['Customer']['updated']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Người thay đổi'); ?></td>
                            <td>
                                <?php echo h($customer['Updater']['name']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2" id="leftCol">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
					<span class="fs1" aria-hidden="true"
                          data-icon="&#xe039;"></span> <?php echo __('Thao tác khác'); ?>
                </div>
            </div>
            <div class="widget-body">
                <ul class="nav nav-stacked" id="sidebar">
                    <li><?php echo $this->Html->link(__('Danh sách khách hàng'), array('action' => 'index')); ?></li>
                    <li><?php echo $this->Html->link(__('Danh sách đơn hàng'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__('Đơn hàng mới'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
                </ul>
            </div>
        </div>

    </div>

    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
					<span class="fs1" aria-hidden="true"
                          data-icon="&#xe039;"></span> <?php echo __('Đơn hàng của khách'); ?>
                    <?php echo $this->Html->link('Tạo mới', array('controller' => 'orders', 'action' => 'add'), array(
                        'class' => 'btn btn-sm btn-success'
                    ));?>
                </div>
            </div>
            <div class="widget-body">
                <?php if (!empty($customer['Order'])): ?>
                    <table class="table table-condensed table-bordered table-hover no-margin">
                        <thead>
                        <tr>
                            <th><?php echo __('Id'); ?></th>
                            <th><?php echo __('Customer Id'); ?></th>
                            <th><?php echo __('User Id'); ?></th>
                            <th><?php echo __('Amount'); ?></th>
                            <th><?php echo __('Ship'); ?></th>
                            <th><?php echo __('Status'); ?></th>
                            <th><?php echo __('Created'); ?></th>
                            <th><?php echo __('Promote Id'); ?></th>
                            <th><?php echo __('Promote Value'); ?></th>
                            <th><?php echo __('Promote Type'); ?></th>
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($customer['Order'] as $order): ?>
                            <tr>
                                <td><?php echo $order['id']; ?></td>
                                <td><?php echo $order['customer_id']; ?></td>
                                <td><?php echo $order['user_id']; ?></td>
                                <td><?php echo $order['amount']; ?></td>
                                <td><?php echo $order['ship']; ?></td>
                                <td><?php echo $order['status']; ?></td>
                                <td><?php echo $order['created']; ?></td>
                                <td><?php echo $order['promote_id']; ?></td>
                                <td><?php echo $order['promote_value']; ?></td>
                                <td><?php echo $order['promote_type']; ?></td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__('View'), array('controller' => 'orders', 'action' => 'view', $order['id'])); ?>
                                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'orders', 'action' => 'edit', $order['id'])); ?>
                                    <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'orders', 'action' => 'delete', $order['id']), array(), __('Are you sure you want to delete # %s?', $order['id'])); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
					<span class="fs1" aria-hidden="true"
                          data-icon="&#xe039;"></span> <?php echo __('Thẻ khuyến mãi của khách'); ?>
                    <?php echo $this->Html->link('Thêm mới', array('controller' => 'customer_promotes', 'action' => 'add'), array(
                        'class' => 'btn btn-sm btn-success'
                    ));?>
                </div>
            </div>
            <div class="widget-body">
                <div class="form-inline" id="data-table_filter"><label>Tìm kiếm
                        <form action="" method="get">
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
                        <th><?php echo $this->Paginator->sort('promote_id', 'Loại giảm giá'); ?></th>
                        <th><?php echo $this->Paginator->sort('promote_code', 'Mã số'); ?></th>
                        <th><?php echo $this->Paginator->sort('used', 'Sử dụng'); ?></th>
                        <th><?php echo $this->Paginator->sort('created', 'Ngày tạo'); ?></th>
                        <th><?php echo $this->Paginator->sort('created_by', 'Người tạo'); ?></th>
                        <th><?php echo $this->Paginator->sort('updated', 'Ngày thay đổi'); ?></th>
                        <th><?php echo $this->Paginator->sort('updated_by', 'Người thay đổi'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($customerPromotes as $customerPromote): ?>
                        <tr>
                            <td><?php echo h($customerPromote['CustomerPromote']['id']); ?>&nbsp;</td>
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
