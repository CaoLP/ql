<?php
setlocale(LC_MONETARY, "vi_VN");
$this->Html->script(array('timesheets'), array('inline' => false));
$this->Html->css(array('timesheets'), array('inline' => false));
?>
<div class="row">
    <div class="col-md-3">
        <form method="post">
            <div class="widget">
                <div class="widget-header">
                    <h3>Tìm kiếm</h3>
                </div>
                <div class="widget-body">
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon">Nhân viên</span>
                        <?php
                        echo $this->Form->input('user_id', array('div' => false, 'label' => false, 'class' => 'form-control', 'empty' => 'Toàn bộ'));
                        ?>
                    </div>
                </div>
            </div>
            <div class="widget">
                <div class="widget-header">
                    <h3>Lọc thời gian</h3>
                </div>
                <?php
                $value = 2;
                if (isset($this->request->data['optionsRadios'])) {
                    $value = $this->request->data['optionsRadios'];
                }
                ?>
                <div class="widget-body">

                    <div class="radio">
                        <label>
                            <input type="radio" name="data[optionsRadios]" class="radio-filter"
                                   value="2" <?php if ($value == 2) echo 'checked'; ?>>
                            Hôm nay
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="data[optionsRadios]" class="radio-filter"
                                   value="3" <?php if ($value == 3) echo 'checked'; ?>>
                            Tuần này
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="data[optionsRadios]" class="radio-filter"
                                   value="4" <?php if ($value == 4) echo 'checked'; ?>>
                            Tháng này
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="data[optionsRadios]" class="radio-filter"
                                   value="5" <?php if ($value == 5) echo 'checked'; ?>>
                            Tuỳ chọn
                        </label>
                    </div>
                    <div>
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
                                <button type="submit" class="form-control"><i class="icon-search"></i> Tìm</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
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
                <h3>Danh sách điểm danh của []</h3>
            </div>
            <div class="widget-body">
                <table class="table table-condensedtable-hover no-margin">
                    <thead>
                    <tr>
                        <th><?php echo 'Nhân viên'; ?></th>
                        <th><?php echo 'Loại'; ?></th>
                        <th><?php echo 'Thời gian'; ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($timesheets as $timesheet):
                        ?>
                        <tr class="table-toggle-expand">
                            <td><?php echo h($timesheet['User']['name']); ?></td>
                            <td><?php echo $types[$timesheet['StaffTimesheet']['type']]; ?></td>
                            <td><?php echo h($timesheet['StaffTimesheet']['time']); ?></td>
                            <td class="actions">
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view', $timesheet['StaffTimesheet']['id']), array('escape' => false, 'title' => 'Xem thông tin')); ?>
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit', $timesheet['StaffTimesheet']['id']), array('escape' => false, 'title' => 'Thay đổi thông tin')); ?>
                            </td>
                        </tr>
                        <tr class="table-expandable"></tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>