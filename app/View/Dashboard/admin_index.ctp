<!-- Row start -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body container-fluid">
                <?php
                if (isset($admin_menu)) {
                    $count = 0;
                    foreach ($admin_menu as $menu_item) {
                        if ($count != 0 && ($count % 4) == 0) echo '</div>';
                        if ($count!= (count($admin_menu)) && ($count % 4) == 0) echo '<div class="row">';

                        ?>
                        <div class="col-md-3 col-sm-12">
                            <div class="panel panel-primary no-margin">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a href="<?php echo $this->Html->url($menu_item['AdminMenu']['url']) ?>">
                                            <div class="icon">
                                                <span class="fs1" aria-hidden="true"
                                                      data-icon="<?php echo $menu_item['AdminMenu']['icon'] ?>"> <?php echo $menu_item['AdminMenu']['name'] ?></span>
                                            </div>

                                        </a>
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <?php
                                    if (count($menu_item['ChildAdminMenu']) > 0) {
                                        ?>
                                        <div class="list-group no-margin">
                                            <?php
                                            foreach ($menu_item['ChildAdminMenu'] as $submenu_item) {
                                                ?>
                                                <?php echo $this->Html->link($submenu_item['name'], $submenu_item['url'], array('class' => 'list-group-item')) ?>
                                            <?php } ?>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $count++;
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>



