<?php
setlocale(LC_MONETARY, "vi_VN");
$this->Html->script(array('timesheets'),array('inline'=>false));
$this->Html->css(array('timesheets'),array('inline'=>false));
?>
<!-- Row start -->
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
                <h3>Danh sách điểm danh của []</h3>
            </div>
            <div class="widget-body">
                <div class="col-md-12">
                    <section style="margin: 30px" class="container-xs-height">
                        <div class="bhoechie-tab-container row-xs-height">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu col-xs-height">
                                <div class="list-group">
                                    <div class="list-group-item idp-group-item">
                                        <input class="form-control">
                                    </div>
                                    <?php foreach($users as $key => $user){
                                        ?>
                                        <a href="javascript:;" class="list-group-item idp-group-item text-right">
                                            <strong><?php echo $user?></strong>
                                        </a>
                                    <?php
                                    }?>
<!--                                    <a href="#" class="list-group-item idp-group-item active text-center">-->
<!--                                        <strong>Label A</strong><br/>-->
<!--                                        Label A Desc-->
<!--                                    </a>-->

                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab col-xs-height col-middle">
                                <!-- flight section -->
                                <div class="bhoechie-tab-content active">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Collapsible Group Item #1
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingTwo">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Collapsible Group Item #2
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                <div class="panel-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingThree">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        Collapsible Group Item #3
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                <div class="panel-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

</div>
<hr>
<div class="col-md-12">
    <form method="post">
        <div class="widget">
            <div class="widget-header">
                <h3>Tìm kiếm</h3>
            </div>
            <div class="widget-body">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Nhân viên</span>
                    <?php
                    echo $this->Form->input('user_id',array('div'=>false,'label'=>false,'class'=>'form-control','empty'=>'Toàn bộ'));
                    ?>
                </div>
            </div>
        </div>
        <div class="widget">
            <div class="widget-header">
                <h3>Lọc thời gian</h3>
            </div>
            <?php
            $value = 1;
            if(isset($this->request->data['optionsRadios'])){
                $value = $this->request->data['optionsRadios'];
            }
            ?>
            <div class="widget-body">
                <div class="radio">
                    <label>
                        <input type="radio" name="data[optionsRadios]" class="radio-filter" value="1" <?php if($value==1) echo 'checked';?>>
                        Toàn thời gian
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="data[optionsRadios]" class="radio-filter" value="2" <?php if($value==2) echo 'checked';?>>
                        Hôm nay
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="data[optionsRadios]" class="radio-filter" value="3" <?php if($value==3) echo 'checked';?>>
                        Tuần này
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="data[optionsRadios]" class="radio-filter" value="4" <?php if($value==4) echo 'checked';?>>
                        Tháng này
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="data[optionsRadios]" class="radio-filter" value="5" <?php if($value==5) echo 'checked';?>>
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


<!--..-->
<table class="table table-condensedtable-hover no-margin">
    <thead>
    <tr>
        <th><?php echo 'Nhân viên'; ?></th>
        <th><?php echo  'Loại'; ?></th>
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
            <td><?php echo h($timesheet['StaffTimesheet']['type']); ?></td>
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