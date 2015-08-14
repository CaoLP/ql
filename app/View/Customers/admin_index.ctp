<!-- Row start -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    <?php echo $this->Html->link('Tạo mới', array('action' => 'add'), array(
                        'class' => 'btn btn-sm btn-success'
                    )); ?>
                </div>
            </div>
            <div class="widget-body">
                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                    <div class="dataTables_filter" id="data-table_filter"><label>Tìm theo tên
                            <form
                                action="<?php echo $this->Html->url(array('controller' => 'customers', 'action' => 'search')) ?>"
                                method="post">
                                <div class="input-group">
                                    <input type="text" name="name" class="form-control">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" data-original-title="">Tìm</button>
                      </span>
                                </div>
                            </form>
                        </label></div>
                    <table class="table table-condensed table-bordered table-hover no-margin">
                        <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('id'); ?></th>
                            <th><?php echo $this->Paginator->sort('name', 'Tên'); ?></th>
                            <th><?php echo $this->Paginator->sort('code', 'Code'); ?></th>
                            <th><?php echo $this->Paginator->sort('gender', 'Giới tính'); ?></th>
                            <th><?php echo $this->Paginator->sort('phone', 'Số điện thoại'); ?></th>
                            <th><?php echo $this->Paginator->sort('email', 'Thư điện tử'); ?></th>
                            <th><?php echo $this->Paginator->sort('address', 'Địa chỉ'); ?></th>
                            <th><?php echo $this->Paginator->sort('district', 'Quận'); ?></th>
                            <th><?php echo $this->Paginator->sort('city', 'Thành phố'); ?></th>
                            <th><?php echo $this->Paginator->sort('created', 'Ngày tạo'); ?></th>
                            <th><?php echo $this->Paginator->sort('point', 'Điểm'); ?></th>
                            <th><?php echo $this->Paginator->sort('created_by', 'Tạo bởi'); ?></th>
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><?php echo h($customer['Customer']['id']); ?></td>
                                <td><?php echo h($customer['Customer']['name']); ?></td>
                                <td><?php echo h($customer['Customer']['code']); ?></td>
                                <td><?php echo $customer['Customer']['gender'] == 0 ? 'Nam' : 'Nữ' ?></td>
                                <td><?php echo h($customer['Customer']['phone']); ?></td>
                                <td><?php echo h($customer['Customer']['email']); ?></td>
                                <td><?php echo h($customer['Customer']['address']); ?></td>
                                <td><?php echo h($customer['Customer']['district']); ?></td>
                                <td><?php echo h($customer['Customer']['city']); ?></td>
                                <td><?php echo h($customer['Customer']['created']); ?></td>
                                <td><?php echo number_format($customer['Customer']['point'], 0, '.', ','); ?></td>
                                <td>
                                    <?php echo $this->Html->link($customer['Creater']['name'],
                                        array('controller' => 'users', 'action' => 'view', $customer['Creater']['id'])); ?>
                                </td>
                                <td class="actions">
                                    <?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view', $customer['Customer']['id']), array('escape' => false, 'title' => 'Xem thông tin')); ?>
                                    <?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit', $customer['Customer']['id']), array('escape' => false, 'title' => 'Thay đổi thông tin')); ?>
                                    <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $customer['Customer']['id']), array('escape' => false, 'title' => 'Xoá'), __('Are you sure you want to delete # %s?', $customer['Customer']['id'])); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="" style="margin-top: 20px;"></div>
                                <form method="post">
                                    <div class="form-group">
                                        <select class="form-control input-sm" name="store">
                                            <option value="all">Tất cã shop</option>
                                            <?php
                                            foreach ($stores as $key => $store) {
                                                echo '<option value="' . $key . '">' . $store . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control input-sm" name="phone">
                                            <option value="all">Tất cã hãng điện thoại</option>
                                            <option value="1">Viettel</option>
                                            <option value="2">Mobifone</option>
                                            <option value="3">Vinaphone</option>
                                            <option value="4">Vietnamobile</option>
                                            <option value="5">Beeline</option>
                                            <option value="6">Sfone</option>
                                            <option value="7">Khác</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control input-sm" name="code">
                                            <option value="all">Tất cã khách</option>
                                            <option value="1">Khách hàng thân thiết</option>
                                            <option value="0">Chưa là thành viên</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control input-sm" name="type">
                                            <option value="all">Tất cã giới tính</option>
                                            <option value="0">Nam</option>
                                            <option value="1">Nữ</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Export</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <div class="dataTables_info" id="data-table_info">
                                        <?php
                                        echo $this->Paginator->counter(array(
                                            'format' => __('Showing {:start} to {:end} {:count} entries')
                                        ));
                                        ?>
                                    </div>
                                    <ul class="pagination pull-right">
                                        <?php
                                        echo $this->Paginator->prev(__('&laquo;'), array('tag' => 'li', 'escape' => false), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a', 'escape' => false));
                                        echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
                                        echo $this->Paginator->next(__('&raquo;'), array('tag' => 'li', 'currentClass' => 'disabled', 'escape' => false), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a', 'escape' => false));
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Customer'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->