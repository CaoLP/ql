<?php
$this->Html->css(array('nestable'), array('inline' => false));
$this->Html->script(array('jquery.nestable', 'admin_menu'), array('inline' => false));
?>
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
                <div class="dd" id="nestable">
                    <ol class="dd-list">
                        <?php foreach($adminMenus as $item){
                            ?>
                            <li class='dd-item nested-list-item' data-id='<?php echo $item['AdminMenu']['id'];?>'>
                                <div class='dd-handle nested-list-handle'>
                                    <span class='glyphicon glyphicon-move'></span>
                                </div>
                                <div class='nested-list-content'><?php echo $item['AdminMenu']['name'];?>
                                    <?php
                                    $groupList = explode(',',$item['AdminMenu']['group_ids']);
                                    $temp = array();
                                    foreach($groupList as $gr_id){
                                        $temp[] = $this->Html->link($groups[$gr_id], array('controller' => 'groups', 'action' => 'view', $gr_id));
                                    }
                                    echo '<span class="nest-group-name">('.implode(',',$temp).')<span>';
                                    ?>
                                    <div class='pull-right'>
                                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit',   $item['AdminMenu']['id']), array('escape' => false,'title'=>'Thay đổi thông tin')); ?>
                                        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete',   $item['AdminMenu']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?',$item['AdminMenu']['id'])); ?>
                                    </div>
                                </div>
                                <?php
                                if(count($item['children'])>0){
                                    ?>
                                    <ol class="dd-list">
                                        <?php
                                        foreach($item['children'] as $child){
                                            ?>
                                            <li class='dd-item nested-list-item' data-id='<?php echo $child['AdminMenu']['id'];?>'>
                                                <div class='dd-handle nested-list-handle'>
                                                    <span class='glyphicon glyphicon-move'></span>
                                                </div>
                                                <div class='nested-list-content'><?php echo $child['AdminMenu']['name'];?>
                                                    <?php
                                                    $groupList = explode(',',$child['AdminMenu']['group_ids']);
                                                    $temp = array();
                                                    foreach($groupList as $gr_id){
                                                        $temp[] = $this->Html->link($groups[$gr_id], array('controller' => 'groups', 'action' => 'view', $gr_id));
                                                    }
                                                    echo '<span class="nest-group-name">('.implode(',',$temp).')<span>';
                                                    ?>
                                                    <div class='pull-right'>
                                                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit',   $child['AdminMenu']['id']), array('escape' => false,'title'=>'Thay đổi thông tin')); ?>
                                                        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete',   $child['AdminMenu']['id']), array('escape' => false,'title'=>'Xoá'), __('Are you sure you want to delete # %s?',$child['AdminMenu']['id'])); ?>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ol>
                                <?php
                                }
                                ?>
                            </li>
                        <?php
                        }
                        ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>