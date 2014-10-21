
<ul>
    <li class="active">
        <span class="current-arrow">&nbsp;</span>
        <a href="<?php echo $this->Html->url(array('admin'=>true,'controller'=>'dashboard','action'=>'index'))?>">
            <div class="icon">
                <span class="fs1" aria-hidden="true" data-icon="&#xe0a2;"></span>
            </div>
            Dashboard
        </a>
    </li>

    <?php
    if(isset($admin_menu))
        foreach($admin_menu as $menu_item){
            ?>
            <li>
                <a href="<?php echo $this->Html->url($menu_item['AdminMenu']['url'])?>">
                    <div class="icon">
                        <span class="fs1" aria-hidden="true" data-icon="<?php echo $menu_item['AdminMenu']['icon']?>"></span>
                    </div>
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

