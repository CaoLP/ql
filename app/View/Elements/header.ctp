
<!-- Logo start -->
<div class="logo">
    <a href="/"><img src="/img/logo.png"/></a>
</div>
<!-- Logo end -->

<!-- Optional Dropdown start -->
<div id="optional-dropdown">
    <ul>
        <?php
        if(isset($admin_menu))
            foreach($admin_menu as $menu_item){
                ?>
                <li>
                    <a href="<?php echo $this->Html->url($menu_item['AdminMenu']['url'])?>">
                        <span class="fs1" aria-hidden="true" data-icon="<?php echo $menu_item['AdminMenu']['icon']?>"></span>
                        <?php echo $menu_item['AdminMenu']['name']?>
                    </a>
                    <?php
                    if(count($menu_item['ChildAdminMenu']) > 0){?>
                        <ul>
                            <?php
                            foreach($menu_item['ChildAdminMenu'] as $submenu_item){
                                ?>
                                <li>
                                    <?php echo $this->Html->link($submenu_item['name'],$submenu_item['url'])?>
                                </li>
                            <?php }?>
                        </ul>
                    <?php
                    }
                    ?>

                </li>
            <?php
            }
        ?>

    </ul>
</div>
<!-- Optional Dropdown end -->



<!-- Mini navigation start -->
<div id="mini-nav" class="hidden-phone">
    <ul>
        <li class="attendance">
            <a href="<?php echo $this->Html->url(array('admin'=>true,'controller'=>'staff_attendances','action'=>'add'))?>" data-toggle="modal">
                <i class="fs1 icon-star-3" aria-hidden="true" data-icon="&#xe088;"></i>
                <span class="will-hidden">Điểm danh</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="text-label will-hidden"><?php echo $this->Session->read ('Auth.User.name'); ?></span><span class="fs1" aria-hidden="true"
                                                                                                            data-icon="&#xe088;"></span>
            </a>
            <ul class="user-summary">
                <li>
                    <div class="summary">
                        <div class="user-pic">
                            <img src="/img/logo.png" alt="<?php echo $this->Session->read ('Auth.User.name'); ?>"/>
                        </div>
                        <div class="basic-details">
                            <h4 class="no-margin"><?php echo $this->Session->read ('Auth.User.name'); ?></h4>
                            <h5 class="no-margin"><?php echo $this->Session->read ('Auth.User.Store.name'); ?></h5>
                            <h5 class="no-margin">Mã nhân viên: <?php echo $this->Session->read ('Auth.User.code'); ?></h5>
                            <small><?php echo $this->Session->read ('Auth.User.phone'); ?></small>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </li>
                <li class="text-right">
                    <a href="<?php
                    echo $this->Html->url(array(
                        'controller'=>'users',
                        'action'=>'change'
                    ));
                    ?>">Thay đổi thông tin</a>
                </li>
                <li class="text-right">
                    <a href="<?php
                    echo $this->Html->url(array(
                        'controller'=>'orders',
                        'action'=>'user_orders'
                    ));
                    ?>">Đơn hàng của bạn</a>
                </li>
                <li class="text-right">
                    <a href="<?php
                    echo $this->Html->url(array(
                        'controller'=>'staff_attendances',
                        'action'=>'index'
                    ));
                    ?>">Thông tin điểm danh</a>
                </li>
                <li>
                    <button class="btn btn-xs btn-danger pull-right" onclick="location.href='<?php echo $this->Html->url(array('admin'=>true,'controller'=>'users','action'=>'logout'))?>'">Logout
                    </button>
                    <span class="clearfix"></span>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!-- Mini navigation end -->
