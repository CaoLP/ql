<?php
setlocale(LC_MONETARY, "vi_VN");
?>
<!-- Row start -->
<div class="row">
    <div class="col-md-3">
        <div class="widget">
            <div class="widget-header">
                <h3>Tìm kiếm</h3>
            </div>
            <div class="widget-body">
                <form method="post">
                    <input class="form-control" name="data[q]" value="<?php
                    if (isset($this->request->data['q'])) echo $this->request->data['q'];
                    ?>" placeholder="Theo mã đơn hàng">
                    <input type="hidden" name="data[from]" value="<?php
                    if (isset($this->request->data['from'])) echo $this->request->data['from'];
                    ?>">
                    <input type="hidden" name="data[to]" value="<?php
                    if (isset($this->request->data['to'])) echo $this->request->data['to'];
                    ?>">
                </form>
            </div>
        </div>
        <?php
        if($this->Session->read('Auth.User.group_id') == 1){
        ?>
        <div class="widget">
            <div class="widget-header">
                <h3>Cửa hàng</h3>
            </div>
            <div class="widget-body">
                <form method="post">
                    <?php
                    echo $this->Form->input('store_id',array('label'=>false,'div'=>array('class'=>'form-group'),'class'=>'form-control','empty'=>true));
                    ?>
                    <input type="hidden" name="data[q]" value="<?php
                    if (isset($this->request->data['q'])) echo $this->request->data['q'];
                    ?>" placeholder="Theo mã đơn hàng">
                    <input type="hidden" name="data[from]" value="<?php
                    if (isset($this->request->data['from'])) echo $this->request->data['from'];
                    ?>">
                    <input type="hidden" name="data[to]" value="<?php
                    if (isset($this->request->data['to'])) echo $this->request->data['to'];
                    ?>">
                    <button type="submit" class="btn btn-success form-control">Lọc</button>
                </form>
            </div>
        </div>
        <?php
        }
        ?>
        <div class="widget">
            <div class="widget-header">
                <h3>Lọc thời gian</h3>
            </div>
            <div class="widget-body">
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" class="radio-filter" value="1">
                        Toàn thời gian
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" class="radio-filter" value="2">
                        Hôm nay
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" class="radio-filter" value="3">
                        Tuần này
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" class="radio-filter" value="4">
                        Tháng này
                    </label>
                </div>
                <div>
                    <form method="post">
                        <input type="hidden" class="form-control" name="data[q]" value="<?php
                        if (isset($this->request->data['q'])) echo $this->request->data['q'];
                        ?>">
                        <ul class="list-group no-margin">
                            <li class="list-group-item no-padding">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">--Từ ngày-</span>
                                    <input name="data[from]" value="<?php
                                    if (isset($this->request->data['from'])) echo $this->request->data['from'];
                                    ?>" class="form-control datepicker2" readonly="readonly">
                                </div>
                            </li>
                            <li class="list-group-item no-padding">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Đến ngày-</span>
                                    <input name="data[to]" value="<?php
                                    if (isset($this->request->data['to'])) echo $this->request->data['to'];
                                    ?>" class="form-control datepicker2" readonly="readonly">
                                </div>
                            </li>
                            <li class="list-group-item no-padding">
                                <button class="form-control"><i class="icon-search"></i> Tìm</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="widget">
            <div class="widget-header">
                <div class="title pull-right">
                    <?php echo $this->Html->link(
                        '<span aria-hidden="true" class="icon-plus"></span> Tạo mới',
                        array('action' => 'add'),
                        array('class' => 'btn btn-sm btn-success', 'escape' => false));?>
                </div>
                <h3>Danh sách đơn hàng</h3>
            </div>
            <div class="widget-body">
                <table class="table table-condensedtable-hover no-margin">
                    <thead>
                    <tr>
                        <th><?php echo $this->Paginator->sort('code', 'Mã đơn hàng'); ?></th>
                        <th><?php echo $this->Paginator->sort('customer_id', 'Tên khách'); ?></th>
                        <th><?php echo $this->Paginator->sort('status', 'Trạng thái'); ?></th>
                        <th><?php echo $this->Paginator->sort('created_by', 'Người tạo'); ?></th>
                        <th><?php echo $this->Paginator->sort('created', 'Ngày tạo'); ?></th>
                        <th><?php echo $this->Paginator->sort('total', 'Tổng cộng'); ?></th>
                        <th><?php echo $this->Paginator->sort('total_promote', 'Khuyến mãi'); ?></th>
                        <th><?php echo $this->Paginator->sort('amount', 'Thành tiền'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total = 0;
                    foreach ($orders as $order):
                        $total += $order['Order']['amount'];
                        ?>
                        <tr class="table-toggle-expand">
                            <td><?php echo h($order['Order']['code']); ?>&nbsp;</td>
                            <td>
                                <?php echo $this->Html->link($order['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $order['Customer']['id'])); ?>
                            </td>
                            <td><?php echo $statuses[h($order['Order']['status'])]; ?>&nbsp;</td>
                            <td>
                                <?php echo $this->Html->link($order['Creater']['name'],
                                    array('controller' => 'users', 'action' => 'view', $order['Creater']['id'])); ?>
                            </td>
                            <td><?php echo h($order['Order']['created']); ?>&nbsp;</td>
                            <td class="text-right price-text"><?php echo number_format($order['Order']['total'], 0, '.', ',');?></td>
                            <td class="text-right price-text"><?php echo number_format($order['Order']['total_promote'], 0, '.', ',');?></td>
                            <td class="text-right price-text"><?php echo number_format($order['Order']['amount'], 0, '.', ',');?></td>
                            <td class="actions">
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view', $order['Order']['id']), array('escape' => false, 'title' => 'Xem thông tin')); ?>
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit', $order['Order']['id']), array('escape' => false, 'title' => 'Thay đổi thông tin')); ?>
                            </td>
                        </tr>
                        <tr class="table-expandable"></tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="6" class="text-right" style="font-weight: bold; font-size: 14px">Tổng tiền</td>
                        <td colspan="2" class="text-right price-text" style="font-weight: bold; font-size: 14px"><?php echo number_format($total, 0, '.', ',');?></td>
                        <td></td>
                    </tr>
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
