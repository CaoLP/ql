<?php
$this->Html->script(array('realtime'),array('inline'=>false));
?>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="panel panel-info">
            <div class="panel-heading">
                Thông báo
            </div>
            <div class="panel-body">
                <?php
                foreach ($posts as $post): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="<?php echo $this->Html->url(array('controller'=>'posts','action'=>'view',$post['Post']['id']));?>">
                                <h4><i class="icon <?php
                                    if($post['Post']['type'] == 0) echo 'blue icon-info';
                                    else if($post['Post']['type'] == 1) echo 'warning icon-warning';
                                    else echo 'red icon-notification';
                                    ?>"></i> <?php echo $post['Post']['title']?></h4>
                            </a>
                            <small><?php echo $post['Creater']['name']?></small>
                            <small class="pull-right"><span class="glyphicon glyphicon-time"></span> <?php echo date('H\hi\, \n\g\à\y d \t\h\á\n\g m \n\ă\m Y')?></small>
                        </div>
                        <div class="col-lg-12">
                            <?php
                            $text = strip_tags($post['Post']['body']);
                            if(strlen($text) > 200){
                                $text = substr($text,0,200);
                            }
                            echo $text;
                            ?>
                            <a href="<?php echo $this->Html->url(array('controller'=>'posts','action'=>'view',$post['Post']['id']));?>">Xem thêm</a>
                        </div>
                        <hr>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="panel-footer text-right">
                <a href="<?php echo $this->Html->url(array('controller'=>'posts','action'=>'index'));?>">Xem thêm</a>
            </div>
        </div>
    </div>
    <div class="col-lg-2"></div>
</div>
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
</div>
<?php
if(isset($this->request->query['icon'])){
?>

    <div class="col-lg-12">
    <ul>
    <li class="icondemo"><i class="icon-home"></i></br>icon-home</li>
    <li class="icondemo"><i class="icon-home-2"></i></br>icon-home-2</li>
    <li class="icondemo"><i class="icon-home-3"></i></br>icon-home-3</li>
    <li class="icondemo"><i class="icon-office"></i></br>icon-office</li>
    <li class="icondemo"><i class="icon-newspaper"></i></br>icon-newspaper</li>
    <li class="icondemo"><i class="icon-pencil"></i></br>icon-pencil</li>
    <li class="icondemo"><i class="icon-pencil-2"></i></br>icon-pencil-2</li>
    <li class="icondemo"><i class="icon-quill"></i></br>icon-quill</li>
    <li class="icondemo"><i class="icon-pen"></i></br>icon-pen</li>
    <li class="icondemo"><i class="icon-blog"></i></br>icon-blog</li>
    <li class="icondemo"><i class="icon-droplet"></i></br>icon-droplet</li>
    <li class="icondemo"><i class="icon-paint-format"></i></br>icon-paint-format</li>
    <li class="icondemo"><i class="icon-image"></i></br>icon-image</li>
    <li class="icondemo"><i class="icon-image-2"></i></br>icon-image-2</li>
    <li class="icondemo"><i class="icon-images"></i></br>icon-images</li>
    <li class="icondemo"><i class="icon-camera"></i></br>icon-camera</li>
    <li class="icondemo"><i class="icon-music"></i></br>icon-music</li>
    <li class="icondemo"><i class="icon-headphones"></i></br>icon-headphones</li>
    <li class="icondemo"><i class="icon-play"></i></br>icon-play</li>
    <li class="icondemo"><i class="icon-film"></i></br>icon-film</li>
    <li class="icondemo"><i class="icon-camera-2"></i></br>icon-camera-2</li>
    <li class="icondemo"><i class="icon-dice"></i></br>icon-dice</li>
    <li class="icondemo"><i class="icon-pacman"></i></br>icon-pacman</li>
    <li class="icondemo"><i class="icon-spades"></i></br>icon-spades</li>
    <li class="icondemo"><i class="icon-clubs"></i></br>icon-clubs</li>
    <li class="icondemo"><i class="icon-diamonds"></i></br>icon-diamonds</li>
    <li class="icondemo"><i class="icon-pawn"></i></br>icon-pawn</li>
    <li class="icondemo"><i class="icon-bullhorn"></i></br>icon-bullhorn</li>
    <li class="icondemo"><i class="icon-connection"></i></br>icon-connection</li>
    <li class="icondemo"><i class="icon-podcast"></i></br>icon-podcast</li>
    <li class="icondemo"><i class="icon-feed"></i></br>icon-feed</li>
    <li class="icondemo"><i class="icon-book"></i></br>icon-book</li>
    <li class="icondemo"><i class="icon-books"></i></br>icon-books</li>
    <li class="icondemo"><i class="icon-library"></i></br>icon-library</li>
    <li class="icondemo"><i class="icon-file"></i></br>icon-file</li>
    <li class="icondemo"><i class="icon-profile"></i></br>icon-profile</li>
    <li class="icondemo"><i class="icon-file-2"></i></br>icon-file-2</li>
    <li class="icondemo"><i class="icon-file-3"></i></br>icon-file-3</li>
    <li class="icondemo"><i class="icon-file-4"></i></br>icon-file-4</li>
    <li class="icondemo"><i class="icon-copy"></i></br>icon-copy</li>
    <li class="icondemo"><i class="icon-copy-2"></i></br>icon-copy-2</li>
    <li class="icondemo"><i class="icon-copy-3"></i></br>icon-copy-3</li>
    <li class="icondemo"><i class="icon-paste"></i></br>icon-paste</li>
    <li class="icondemo"><i class="icon-paste-2"></i></br>icon-paste-2</li>
    <li class="icondemo"><i class="icon-paste-3"></i></br>icon-paste-3</li>
    <li class="icondemo"><i class="icon-stack"></i></br>icon-stack</li>
    <li class="icondemo"><i class="icon-folder"></i></br>icon-folder</li>
    <li class="icondemo"><i class="icon-folder-open"></i></br>icon-folder-open</li>
    <li class="icondemo"><i class="icon-tag"></i></br>icon-tag</li>
    <li class="icondemo"><i class="icon-tags"></i></br>icon-tags</li>
    <li class="icondemo"><i class="icon-barcode"></i></br>icon-barcode</li>
    <li class="icondemo"><i class="icon-qrcode"></i></br>icon-qrcode</li>
    <li class="icondemo"><i class="icon-ticket"></i></br>icon-ticket</li>
    <li class="icondemo"><i class="icon-cart"></i></br>icon-cart</li>
    <li class="icondemo"><i class="icon-cart-2"></i></br>icon-cart-2</li>
    <li class="icondemo"><i class="icon-cart-3"></i></br>icon-cart-3</li>
    <li class="icondemo"><i class="icon-coin"></i></br>icon-coin</li>
    <li class="icondemo"><i class="icon-credit"></i></br>icon-credit</li>
    <li class="icondemo"><i class="icon-calculate"></i></br>icon-calculate</li>
    <li class="icondemo"><i class="icon-support"></i></br>icon-support</li>
    <li class="icondemo"><i class="icon-phone"></i></br>icon-phone</li>
    <li class="icondemo"><i class="icon-phone-hang-up"></i></br>icon-phone-hang-up</li>
    <li class="icondemo"><i class="icon-address-book"></i></br>icon-address-book</li>
    <li class="icondemo"><i class="icon-notebook"></i></br>icon-notebook</li>
    <li class="icondemo"><i class="icon-envelop"></i></br>icon-envelop</li>
    <li class="icondemo"><i class="icon-pushpin"></i></br>icon-pushpin</li>
    <li class="icondemo"><i class="icon-location"></i></br>icon-location</li>
    <li class="icondemo"><i class="icon-location-2"></i></br>icon-location-2</li>
    <li class="icondemo"><i class="icon-compass"></i></br>icon-compass</li>
    <li class="icondemo"><i class="icon-map"></i></br>icon-map</li>
    <li class="icondemo"><i class="icon-map-2"></i></br>icon-map-2</li>
    <li class="icondemo"><i class="icon-history"></i></br>icon-history</li>
    <li class="icondemo"><i class="icon-clock"></i></br>icon-clock</li>
    <li class="icondemo"><i class="icon-clock-2"></i></br>icon-clock-2</li>
    <li class="icondemo"><i class="icon-alarm"></i></br>icon-alarm</li>
    <li class="icondemo"><i class="icon-alarm-2"></i></br>icon-alarm-2</li>
    <li class="icondemo"><i class="icon-bell"></i></br>icon-bell</li>
    <li class="icondemo"><i class="icon-stopwatch"></i></br>icon-stopwatch</li>
    <li class="icondemo"><i class="icon-calendar"></i></br>icon-calendar</li>
    <li class="icondemo"><i class="icon-calendar-2"></i></br>icon-calendar-2</li>
    <li class="icondemo"><i class="icon-print"></i></br>icon-print</li>
    <li class="icondemo"><i class="icon-keyboard"></i></br>icon-keyboard</li>
    <li class="icondemo"><i class="icon-screen"></i></br>icon-screen</li>
    <li class="icondemo"><i class="icon-laptop"></i></br>icon-laptop</li>
    <li class="icondemo"><i class="icon-mobile"></i></br>icon-mobile</li>
    <li class="icondemo"><i class="icon-mobile-2"></i></br>icon-mobile-2</li>
    <li class="icondemo"><i class="icon-tablet"></i></br>icon-tablet</li>
    <li class="icondemo"><i class="icon-tv"></i></br>icon-tv</li>
    <li class="icondemo"><i class="icon-cabinet"></i></br>icon-cabinet</li>
    <li class="icondemo"><i class="icon-drawer"></i></br>icon-drawer</li>
    <li class="icondemo"><i class="icon-drawer-2"></i></br>icon-drawer-2</li>
    <li class="icondemo"><i class="icon-drawer-3"></i></br>icon-drawer-3</li>
    <li class="icondemo"><i class="icon-box-add"></i></br>icon-box-add</li>
    <li class="icondemo"><i class="icon-box-remove"></i></br>icon-box-remove</li>
    <li class="icondemo"><i class="icon-download"></i></br>icon-download</li>
    <li class="icondemo"><i class="icon-upload"></i></br>icon-upload</li>
    <li class="icondemo"><i class="icon-disk"></i></br>icon-disk</li>
    <li class="icondemo"><i class="icon-storage"></i></br>icon-storage</li>
    <li class="icondemo"><i class="icon-undo"></i></br>icon-undo</li>
    <li class="icondemo"><i class="icon-redo"></i></br>icon-redo</li>
    <li class="icondemo"><i class="icon-flip"></i></br>icon-flip</li>
    <li class="icondemo"><i class="icon-flip-2"></i></br>icon-flip-2</li>
    <li class="icondemo"><i class="icon-undo-2"></i></br>icon-undo-2</li>
    <li class="icondemo"><i class="icon-redo-2"></i></br>icon-redo-2</li>
    <li class="icondemo"><i class="icon-forward"></i></br>icon-forward</li>
    <li class="icondemo"><i class="icon-reply"></i></br>icon-reply</li>
    <li class="icondemo"><i class="icon-bubble"></i></br>icon-bubble</li>
    <li class="icondemo"><i class="icon-bubbles"></i></br>icon-bubbles</li>
    <li class="icondemo"><i class="icon-bubbles-2"></i></br>icon-bubbles-2</li>
    <li class="icondemo"><i class="icon-bubble-2"></i></br>icon-bubble-2</li>
    <li class="icondemo"><i class="icon-bubbles-3"></i></br>icon-bubbles-3</li>
    <li class="icondemo"><i class="icon-bubbles-4"></i></br>icon-bubbles-4</li>
    <li class="icondemo"><i class="icon-user"></i></br>icon-user</li>
    <li class="icondemo"><i class="icon-users"></i></br>icon-users</li>
    <li class="icondemo"><i class="icon-user-2"></i></br>icon-user-2</li>
    <li class="icondemo"><i class="icon-users-2"></i></br>icon-users-2</li>
    <li class="icondemo"><i class="icon-user-3"></i></br>icon-user-3</li>
    <li class="icondemo"><i class="icon-user-4"></i></br>icon-user-4</li>
    <li class="icondemo"><i class="icon-quotes-left"></i></br>icon-quotes-left</li>
    <li class="icondemo"><i class="icon-busy"></i></br>icon-busy</li>
    <li class="icondemo"><i class="icon-spinner"></i></br>icon-spinner</li>
    <li class="icondemo"><i class="icon-spinner-2"></i></br>icon-spinner-2</li>
    <li class="icondemo"><i class="icon-spinner-3"></i></br>icon-spinner-3</li>
    <li class="icondemo"><i class="icon-spinner-4"></i></br>icon-spinner-4</li>
    <li class="icondemo"><i class="icon-spinner-5"></i></br>icon-spinner-5</li>
    <li class="icondemo"><i class="icon-spinner-6"></i></br>icon-spinner-6</li>
    <li class="icondemo"><i class="icon-binoculars"></i></br>icon-binoculars</li>
    <li class="icondemo"><i class="icon-search"></i></br>icon-search</li>
    <li class="icondemo"><i class="icon-zoom-in"></i></br>icon-zoom-in</li>
    <li class="icondemo"><i class="icon-zoom-out"></i></br>icon-zoom-out</li>
    <li class="icondemo"><i class="icon-expand"></i></br>icon-expand</li>
    <li class="icondemo"><i class="icon-contract"></i></br>icon-contract</li>
    <li class="icondemo"><i class="icon-expand-2"></i></br>icon-expand-2</li>
    <li class="icondemo"><i class="icon-contract-2"></i></br>icon-contract-2</li>
    <li class="icondemo"><i class="icon-key"></i></br>icon-key</li>
    <li class="icondemo"><i class="icon-key-2"></i></br>icon-key-2</li>
    <li class="icondemo"><i class="icon-lock"></i></br>icon-lock</li>
    <li class="icondemo"><i class="icon-lock-2"></i></br>icon-lock-2</li>
    <li class="icondemo"><i class="icon-unlocked"></i></br>icon-unlocked</li>
    <li class="icondemo"><i class="icon-wrench"></i></br>icon-wrench</li>
    <li class="icondemo"><i class="icon-settings"></i></br>icon-settings</li>
    <li class="icondemo"><i class="icon-equalizer"></i></br>icon-equalizer</li>
    <li class="icondemo"><i class="icon-cog"></i></br>icon-cog</li>
    <li class="icondemo"><i class="icon-cogs"></i></br>icon-cogs</li>
    <li class="icondemo"><i class="icon-cog-2"></i></br>icon-cog-2</li>
    <li class="icondemo"><i class="icon-hammer"></i></br>icon-hammer</li>
    <li class="icondemo"><i class="icon-wand"></i></br>icon-wand</li>
    <li class="icondemo"><i class="icon-aid"></i></br>icon-aid</li>
    <li class="icondemo"><i class="icon-bug"></i></br>icon-bug</li>
    <li class="icondemo"><i class="icon-pie"></i></br>icon-pie</li>
    <li class="icondemo"><i class="icon-stats"></i></br>icon-stats</li>
    <li class="icondemo"><i class="icon-bars"></i></br>icon-bars</li>
    <li class="icondemo"><i class="icon-bars-2"></i></br>icon-bars-2</li>
    <li class="icondemo"><i class="icon-gift"></i></br>icon-gift</li>
    <li class="icondemo"><i class="icon-trophy"></i></br>icon-trophy</li>
    <li class="icondemo"><i class="icon-glass"></i></br>icon-glass</li>
    <li class="icondemo"><i class="icon-mug"></i></br>icon-mug</li>
    <li class="icondemo"><i class="icon-food"></i></br>icon-food</li>
    <li class="icondemo"><i class="icon-leaf"></i></br>icon-leaf</li>
    <li class="icondemo"><i class="icon-rocket"></i></br>icon-rocket</li>
    <li class="icondemo"><i class="icon-meter"></i></br>icon-meter</li>
    <li class="icondemo"><i class="icon-meter2"></i></br>icon-meter2</li>
    <li class="icondemo"><i class="icon-dashboard"></i></br>icon-dashboard</li>
    <li class="icondemo"><i class="icon-hammer-2"></i></br>icon-hammer-2</li>
    <li class="icondemo"><i class="icon-fire"></i></br>icon-fire</li>
    <li class="icondemo"><i class="icon-lab"></i></br>icon-lab</li>
    <li class="icondemo"><i class="icon-magnet"></i></br>icon-magnet</li>
    <li class="icondemo"><i class="icon-remove"></i></br>icon-remove</li>
    <li class="icondemo"><i class="icon-remove-2"></i></br>icon-remove-2</li>
    <li class="icondemo"><i class="icon-briefcase"></i></br>icon-briefcase</li>
    <li class="icondemo"><i class="icon-airplane"></i></br>icon-airplane</li>
    <li class="icondemo"><i class="icon-truck"></i></br>icon-truck</li>
    <li class="icondemo"><i class="icon-road"></i></br>icon-road</li>
    <li class="icondemo"><i class="icon-accessibility"></i></br>icon-accessibility</li>
    <li class="icondemo"><i class="icon-target"></i></br>icon-target</li>
    <li class="icondemo"><i class="icon-shield"></i></br>icon-shield</li>
    <li class="icondemo"><i class="icon-lightning"></i></br>icon-lightning</li>
    <li class="icondemo"><i class="icon-switch"></i></br>icon-switch</li>
    <li class="icondemo"><i class="icon-power-cord"></i></br>icon-power-cord</li>
    <li class="icondemo"><i class="icon-signup"></i></br>icon-signup</li>
    <li class="icondemo"><i class="icon-list"></i></br>icon-list</li>
    <li class="icondemo"><i class="icon-list-2"></i></br>icon-list-2</li>
    <li class="icondemo"><i class="icon-numbered-list"></i></br>icon-numbered-list</li>
    <li class="icondemo"><i class="icon-menu"></i></br>icon-menu</li>
    <li class="icondemo"><i class="icon-menu-2"></i></br>icon-menu-2</li>
    <li class="icondemo"><i class="icon-tree"></i></br>icon-tree</li>
    <li class="icondemo"><i class="icon-cloud"></i></br>icon-cloud</li>
    <li class="icondemo"><i class="icon-cloud-download"></i></br>icon-cloud-download</li>
    <li class="icondemo"><i class="icon-cloud-upload"></i></br>icon-cloud-upload</li>
    <li class="icondemo"><i class="icon-download-2"></i></br>icon-download-2</li>
    <li class="icondemo"><i class="icon-upload-2"></i></br>icon-upload-2</li>
    <li class="icondemo"><i class="icon-download-3"></i></br>icon-download-3</li>
    <li class="icondemo"><i class="icon-upload-3"></i></br>icon-upload-3</li>
    <li class="icondemo"><i class="icon-globe"></i></br>icon-globe</li>
    <li class="icondemo"><i class="icon-earth"></i></br>icon-earth</li>
    <li class="icondemo"><i class="icon-link"></i></br>icon-link</li>
    <li class="icondemo"><i class="icon-flag"></i></br>icon-flag</li>
    <li class="icondemo"><i class="icon-attachment"></i></br>icon-attachment</li>
    <li class="icondemo"><i class="icon-eye"></i></br>icon-eye</li>
    <li class="icondemo"><i class="icon-eye-blocked"></i></br>icon-eye-blocked</li>
    <li class="icondemo"><i class="icon-eye-2"></i></br>icon-eye-2</li>
    <li class="icondemo"><i class="icon-bookmark"></i></br>icon-bookmark</li>
    <li class="icondemo"><i class="icon-bookmarks"></i></br>icon-bookmarks</li>
    <li class="icondemo"><i class="icon-brightness-medium"></i></br>icon-brightness-medium</li>
    <li class="icondemo"><i class="icon-brightness-contrast"></i></br>icon-brightness-contrast</li>
    <li class="icondemo"><i class="icon-contrast"></i></br>icon-contrast</li>
    <li class="icondemo"><i class="icon-star"></i></br>icon-star</li>
    <li class="icondemo"><i class="icon-star-2"></i></br>icon-star-2</li>
    <li class="icondemo"><i class="icon-star-3"></i></br>icon-star-3</li>
    <li class="icondemo"><i class="icon-heart"></i></br>icon-heart</li>
    <li class="icondemo"><i class="icon-heart-2"></i></br>icon-heart-2</li>
    <li class="icondemo"><i class="icon-heart-broken"></i></br>icon-heart-broken</li>
    <li class="icondemo"><i class="icon-thumbs-up"></i></br>icon-thumbs-up</li>
    <li class="icondemo"><i class="icon-thumbs-up-2"></i></br>icon-thumbs-up-2</li>
    <li class="icondemo"><i class="icon-happy"></i></br>icon-happy</li>
    <li class="icondemo"><i class="icon-happy-2"></i></br>icon-happy-2</li>
    <li class="icondemo"><i class="icon-smiley"></i></br>icon-smiley</li>
    <li class="icondemo"><i class="icon-smiley-2"></i></br>icon-smiley-2</li>
    <li class="icondemo"><i class="icon-tongue"></i></br>icon-tongue</li>
    <li class="icondemo"><i class="icon-tongue-2"></i></br>icon-tongue-2</li>
    <li class="icondemo"><i class="icon-sad"></i></br>icon-sad</li>
    <li class="icondemo"><i class="icon-sad-2"></i></br>icon-sad-2</li>
    <li class="icondemo"><i class="icon-wink"></i></br>icon-wink</li>
    <li class="icondemo"><i class="icon-wink-2"></i></br>icon-wink-2</li>
    <li class="icondemo"><i class="icon-grin"></i></br>icon-grin</li>
    <li class="icondemo"><i class="icon-grin-2"></i></br>icon-grin-2</li>
    <li class="icondemo"><i class="icon-cool"></i></br>icon-cool</li>
    <li class="icondemo"><i class="icon-cool-2"></i></br>icon-cool-2</li>
    <li class="icondemo"><i class="icon-angry"></i></br>icon-angry</li>
    <li class="icondemo"><i class="icon-angry-2"></i></br>icon-angry-2</li>
    <li class="icondemo"><i class="icon-evil"></i></br>icon-evil</li>
    <li class="icondemo"><i class="icon-evil-2"></i></br>icon-evil-2</li>
    <li class="icondemo"><i class="icon-shocked"></i></br>icon-shocked</li>
    <li class="icondemo"><i class="icon-shocked-2"></i></br>icon-shocked-2</li>
    <li class="icondemo"><i class="icon-confused"></i></br>icon-confused</li>
    <li class="icondemo"><i class="icon-confused-2"></i></br>icon-confused-2</li>
    <li class="icondemo"><i class="icon-neutral"></i></br>icon-neutral</li>
    <li class="icondemo"><i class="icon-neutral-2"></i></br>icon-neutral-2</li>
    <li class="icondemo"><i class="icon-wondering"></i></br>icon-wondering</li>
    <li class="icondemo"><i class="icon-wondering-2"></i></br>icon-wondering-2</li>
    <li class="icondemo"><i class="icon-point-up"></i></br>icon-point-up</li>
    <li class="icondemo"><i class="icon-point-right"></i></br>icon-point-right</li>
    <li class="icondemo"><i class="icon-point-down"></i></br>icon-point-down</li>
    <li class="icondemo"><i class="icon-point-left"></i></br>icon-point-left</li>
    <li class="icondemo"><i class="icon-warning"></i></br>icon-warning</li>
    <li class="icondemo"><i class="icon-notification"></i></br>icon-notification</li>
    <li class="icondemo"><i class="icon-question"></i></br>icon-question</li>
    <li class="icondemo"><i class="icon-info"></i></br>icon-info</li>
    <li class="icondemo"><i class="icon-info-2"></i></br>icon-info-2</li>
    <li class="icondemo"><i class="icon-blocked"></i></br>icon-blocked</li>
    <li class="icondemo"><i class="icon-cancel-circle"></i></br>icon-cancel-circle</li>
    <li class="icondemo"><i class="icon-checkmark-circle"></i></br>icon-checkmark-circle</li>
    <li class="icondemo"><i class="icon-spam"></i></br>icon-spam</li>
    <li class="icondemo"><i class="icon-close"></i></br>icon-close</li>
    <li class="icondemo"><i class="icon-checkmark"></i></br>icon-checkmark</li>
    <li class="icondemo"><i class="icon-checkmark-2"></i></br>icon-checkmark-2</li>
    <li class="icondemo"><i class="icon-spell-check"></i></br>icon-spell-check</li>
    <li class="icondemo"><i class="icon-minus"></i></br>icon-minus</li>
    <li class="icondemo"><i class="icon-plus"></i></br>icon-plus</li>
    <li class="icondemo"><i class="icon-enter"></i></br>icon-enter</li>
    <li class="icondemo"><i class="icon-exit"></i></br>icon-exit</li>
    <li class="icondemo"><i class="icon-play-2"></i></br>icon-play-2</li>
    <li class="icondemo"><i class="icon-pause"></i></br>icon-pause</li>
    <li class="icondemo"><i class="icon-stop"></i></br>icon-stop</li>
    <li class="icondemo"><i class="icon-backward"></i></br>icon-backward</li>
    <li class="icondemo"><i class="icon-forward-2"></i></br>icon-forward-2</li>
    <li class="icondemo"><i class="icon-play-3"></i></br>icon-play-3</li>
    <li class="icondemo"><i class="icon-pause-2"></i></br>icon-pause-2</li>
    <li class="icondemo"><i class="icon-stop-2"></i></br>icon-stop-2</li>
    <li class="icondemo"><i class="icon-backward-2"></i></br>icon-backward-2</li>
    <li class="icondemo"><i class="icon-forward-3"></i></br>icon-forward-3</li>
    <li class="icondemo"><i class="icon-first"></i></br>icon-first</li>
    <li class="icondemo"><i class="icon-last"></i></br>icon-last</li>
    <li class="icondemo"><i class="icon-previous"></i></br>icon-previous</li>
    <li class="icondemo"><i class="icon-next"></i></br>icon-next</li>
    <li class="icondemo"><i class="icon-eject"></i></br>icon-eject</li>
    <li class="icondemo"><i class="icon-volume-high"></i></br>icon-volume-high</li>
    <li class="icondemo"><i class="icon-volume-medium"></i></br>icon-volume-medium</li>
    <li class="icondemo"><i class="icon-volume-low"></i></br>icon-volume-low</li>
    <li class="icondemo"><i class="icon-volume-mute"></i></br>icon-volume-mute</li>
    <li class="icondemo"><i class="icon-volume-mute-2"></i></br>icon-volume-mute-2</li>
    <li class="icondemo"><i class="icon-volume-increase"></i></br>icon-volume-increase</li>
    <li class="icondemo"><i class="icon-volume-decrease"></i></br>icon-volume-decrease</li>
    <li class="icondemo"><i class="icon-loop"></i></br>icon-loop</li>
    <li class="icondemo"><i class="icon-loop-2"></i></br>icon-loop-2</li>
    <li class="icondemo"><i class="icon-loop-3"></i></br>icon-loop-3</li>
    <li class="icondemo"><i class="icon-shuffle"></i></br>icon-shuffle</li>
    <li class="icondemo"><i class="icon-arrow-up-left"></i></br>icon-arrow-up-left</li>
    <li class="icondemo"><i class="icon-arrow-up"></i></br>icon-arrow-up</li>
    <li class="icondemo"><i class="icon-arrow-up-right"></i></br>icon-arrow-up-right</li>
    <li class="icondemo"><i class="icon-arrow-right"></i></br>icon-arrow-right</li>
    <li class="icondemo"><i class="icon-arrow-down-right"></i></br>icon-arrow-down-right</li>
    <li class="icondemo"><i class="icon-arrow-down"></i></br>icon-arrow-down</li>
    <li class="icondemo"><i class="icon-arrow-down-left"></i></br>icon-arrow-down-left</li>
    <li class="icondemo"><i class="icon-arrow-left"></i></br>icon-arrow-left</li>
    <li class="icondemo"><i class="icon-arrow-up-left-2"></i></br>icon-arrow-up-left-2</li>
    <li class="icondemo"><i class="icon-arrow-up-2"></i></br>icon-arrow-up-2</li>
    <li class="icondemo"><i class="icon-arrow-up-right-2"></i></br>icon-arrow-up-right-2</li>
    <li class="icondemo"><i class="icon-arrow-right-2"></i></br>icon-arrow-right-2</li>
    <li class="icondemo"><i class="icon-arrow-down-right-2"></i></br>icon-arrow-down-right-2</li>
    <li class="icondemo"><i class="icon-arrow-down-2"></i></br>icon-arrow-down-2</li>
    <li class="icondemo"><i class="icon-arrow-down-left-2"></i></br>icon-arrow-down-left-2</li>
    <li class="icondemo"><i class="icon-arrow-left-2"></i></br>icon-arrow-left-2</li>
    <li class="icondemo"><i class="icon-arrow-up-left-3"></i></br>icon-arrow-up-left-3</li>
    <li class="icondemo"><i class="icon-arrow-up-3"></i></br>icon-arrow-up-3</li>
    <li class="icondemo"><i class="icon-arrow-up-right-3"></i></br>icon-arrow-up-right-3</li>
    <li class="icondemo"><i class="icon-arrow-right-3"></i></br>icon-arrow-right-3</li>
    <li class="icondemo"><i class="icon-arrow-down-right-3"></i></br>icon-arrow-down-right-3</li>
    <li class="icondemo"><i class="icon-arrow-down-3"></i></br>icon-arrow-down-3</li>
    <li class="icondemo"><i class="icon-arrow-down-left-3"></i></br>icon-arrow-down-left-3</li>
    <li class="icondemo"><i class="icon-arrow-left-3"></i></br>icon-arrow-left-3</li>
    <li class="icondemo"><i class="icon-tab"></i></br>icon-tab</li>
    <li class="icondemo"><i class="icon-checkbox-checked"></i></br>icon-checkbox-checked</li>
    <li class="icondemo"><i class="icon-checkbox-unchecked"></i></br>icon-checkbox-unchecked</li>
    <li class="icondemo"><i class="icon-checkbox-partial"></i></br>icon-checkbox-partial</li>
    <li class="icondemo"><i class="icon-radio-checked"></i></br>icon-radio-checked</li>
    <li class="icondemo"><i class="icon-radio-unchecked"></i></br>icon-radio-unchecked</li>
    <li class="icondemo"><i class="icon-crop"></i></br>icon-crop</li>
    <li class="icondemo"><i class="icon-scissors"></i></br>icon-scissors</li>
    <li class="icondemo"><i class="icon-filter"></i></br>icon-filter</li>
    <li class="icondemo"><i class="icon-filter-2"></i></br>icon-filter-2</li>
    <li class="icondemo"><i class="icon-font"></i></br>icon-font</li>
    <li class="icondemo"><i class="icon-text-height"></i></br>icon-text-height</li>
    <li class="icondemo"><i class="icon-text-width"></i></br>icon-text-width</li>
    <li class="icondemo"><i class="icon-bold"></i></br>icon-bold</li>
    <li class="icondemo"><i class="icon-underline"></i></br>icon-underline</li>
    <li class="icondemo"><i class="icon-italic"></i></br>icon-italic</li>
    <li class="icondemo"><i class="icon-strikethrough"></i></br>icon-strikethrough</li>
    <li class="icondemo"><i class="icon-omega"></i></br>icon-omega</li>
    <li class="icondemo"><i class="icon-sigma"></i></br>icon-sigma</li>
    <li class="icondemo"><i class="icon-table"></i></br>icon-table</li>
    <li class="icondemo"><i class="icon-table-2"></i></br>icon-table-2</li>
    <li class="icondemo"><i class="icon-insert-template"></i></br>icon-insert-template</li>
    <li class="icondemo"><i class="icon-pilcrow"></i></br>icon-pilcrow</li>
    <li class="icondemo"><i class="icon-left-to-right"></i></br>icon-left-to-right</li>
    <li class="icondemo"><i class="icon-right-to-left"></i></br>icon-right-to-left</li>
    <li class="icondemo"><i class="icon-paragraph-left"></i></br>icon-paragraph-left</li>
    <li class="icondemo"><i class="icon-paragraph-center"></i></br>icon-paragraph-center</li>
    <li class="icondemo"><i class="icon-paragraph-right"></i></br>icon-paragraph-right</li>
    <li class="icondemo"><i class="icon-paragraph-justify"></i></br>icon-paragraph-justify</li>
    <li class="icondemo"><i class="icon-paragraph-left-2"></i></br>icon-paragraph-left-2</li>
    <li class="icondemo"><i class="icon-paragraph-center-2"></i></br>icon-paragraph-center-2</li>
    <li class="icondemo"><i class="icon-paragraph-right-2"></i></br>icon-paragraph-right-2</li>
    <li class="icondemo"><i class="icon-paragraph-justify-2"></i></br>icon-paragraph-justify-2</li>
    <li class="icondemo"><i class="icon-indent-increase"></i></br>icon-indent-increase</li>
    <li class="icondemo"><i class="icon-indent-decrease"></i></br>icon-indent-decrease</li>
    <li class="icondemo"><i class="icon-new-tab"></i></br>icon-new-tab</li>
    <li class="icondemo"><i class="icon-embed"></i></br>icon-embed</li>
    <li class="icondemo"><i class="icon-code"></i></br>icon-code</li>
    <li class="icondemo"><i class="icon-console"></i></br>icon-console</li>
    <li class="icondemo"><i class="icon-share"></i></br>icon-share</li>
    <li class="icondemo"><i class="icon-mail"></i></br>icon-mail</li>
    <li class="icondemo"><i class="icon-mail-2"></i></br>icon-mail-2</li>
    <li class="icondemo"><i class="icon-mail-3"></i></br>icon-mail-3</li>
    <li class="icondemo"><i class="icon-mail-4"></i></br>icon-mail-4</li>
    <li class="icondemo"><i class="icon-google"></i></br>icon-google</li>
    <li class="icondemo"><i class="icon-google-plus"></i></br>icon-google-plus</li>
    <li class="icondemo"><i class="icon-google-plus-2"></i></br>icon-google-plus-2</li>
    <li class="icondemo"><i class="icon-google-plus-3"></i></br>icon-google-plus-3</li>
    <li class="icondemo"><i class="icon-google-plus-4"></i></br>icon-google-plus-4</li>
    <li class="icondemo"><i class="icon-google-drive"></i></br>icon-google-drive</li>
    <li class="icondemo"><i class="icon-facebook"></i></br>icon-facebook</li>
    <li class="icondemo"><i class="icon-facebook-2"></i></br>icon-facebook-2</li>
    <li class="icondemo"><i class="icon-facebook-3"></i></br>icon-facebook-3</li>
    <li class="icondemo"><i class="icon-instagram"></i></br>icon-instagram</li>
    <li class="icondemo"><i class="icon-twitter"></i></br>icon-twitter</li>
    <li class="icondemo"><i class="icon-twitter-2"></i></br>icon-twitter-2</li>
    <li class="icondemo"><i class="icon-twitter-3"></i></br>icon-twitter-3</li>
    <li class="icondemo"><i class="icon-feed-2"></i></br>icon-feed-2</li>
    <li class="icondemo"><i class="icon-feed-3"></i></br>icon-feed-3</li>
    <li class="icondemo"><i class="icon-feed-4"></i></br>icon-feed-4</li>
    <li class="icondemo"><i class="icon-youtube"></i></br>icon-youtube</li>
    <li class="icondemo"><i class="icon-youtube-2"></i></br>icon-youtube-2</li>
    <li class="icondemo"><i class="icon-vimeo"></i></br>icon-vimeo</li>
    <li class="icondemo"><i class="icon-vimeo2"></i></br>icon-vimeo2</li>
    <li class="icondemo"><i class="icon-vimeo-2"></i></br>icon-vimeo-2</li>
    <li class="icondemo"><i class="icon-lanyrd"></i></br>icon-lanyrd</li>
    <li class="icondemo"><i class="icon-flickr"></i></br>icon-flickr</li>
    <li class="icondemo"><i class="icon-flickr-2"></i></br>icon-flickr-2</li>
    <li class="icondemo"><i class="icon-flickr-3"></i></br>icon-flickr-3</li>
    <li class="icondemo"><i class="icon-flickr-4"></i></br>icon-flickr-4</li>
    <li class="icondemo"><i class="icon-picassa"></i></br>icon-picassa</li>
    <li class="icondemo"><i class="icon-picassa-2"></i></br>icon-picassa-2</li>
    <li class="icondemo"><i class="icon-dribbble"></i></br>icon-dribbble</li>
    <li class="icondemo"><i class="icon-dribbble-2"></i></br>icon-dribbble-2</li>
    <li class="icondemo"><i class="icon-dribbble-3"></i></br>icon-dribbble-3</li>
    <li class="icondemo"><i class="icon-forrst"></i></br>icon-forrst</li>
    <li class="icondemo"><i class="icon-forrst-2"></i></br>icon-forrst-2</li>
    <li class="icondemo"><i class="icon-deviantart"></i></br>icon-deviantart</li>
    <li class="icondemo"><i class="icon-deviantart-2"></i></br>icon-deviantart-2</li>
    <li class="icondemo"><i class="icon-steam"></i></br>icon-steam</li>
    <li class="icondemo"><i class="icon-steam-2"></i></br>icon-steam-2</li>
    <li class="icondemo"><i class="icon-github"></i></br>icon-github</li>
    <li class="icondemo"><i class="icon-github-2"></i></br>icon-github-2</li>
    <li class="icondemo"><i class="icon-github-3"></i></br>icon-github-3</li>
    <li class="icondemo"><i class="icon-github-4"></i></br>icon-github-4</li>
    <li class="icondemo"><i class="icon-github-5"></i></br>icon-github-5</li>
    <li class="icondemo"><i class="icon-wordpress"></i></br>icon-wordpress</li>
    <li class="icondemo"><i class="icon-wordpress-2"></i></br>icon-wordpress-2</li>
    <li class="icondemo"><i class="icon-joomla"></i></br>icon-joomla</li>
    <li class="icondemo"><i class="icon-blogger"></i></br>icon-blogger</li>
    <li class="icondemo"><i class="icon-blogger-2"></i></br>icon-blogger-2</li>
    <li class="icondemo"><i class="icon-tumblr"></i></br>icon-tumblr</li>
    <li class="icondemo"><i class="icon-tumblr-2"></i></br>icon-tumblr-2</li>
    <li class="icondemo"><i class="icon-yahoo"></i></br>icon-yahoo</li>
    <li class="icondemo"><i class="icon-tux"></i></br>icon-tux</li>
    <li class="icondemo"><i class="icon-apple"></i></br>icon-apple</li>
    <li class="icondemo"><i class="icon-finder"></i></br>icon-finder</li>
    <li class="icondemo"><i class="icon-android"></i></br>icon-android</li>
    <li class="icondemo"><i class="icon-windows"></i></br>icon-windows</li>
    <li class="icondemo"><i class="icon-windows8"></i></br>icon-windows8</li>
    <li class="icondemo"><i class="icon-soundcloud"></i></br>icon-soundcloud</li>
    <li class="icondemo"><i class="icon-soundcloud-2"></i></br>icon-soundcloud-2</li>
    <li class="icondemo"><i class="icon-skype"></i></br>icon-skype</li>
    <li class="icondemo"><i class="icon-reddit"></i></br>icon-reddit</li>
    <li class="icondemo"><i class="icon-linkedin"></i></br>icon-linkedin</li>
    <li class="icondemo"><i class="icon-lastfm"></i></br>icon-lastfm</li>
    <li class="icondemo"><i class="icon-lastfm-2"></i></br>icon-lastfm-2</li>
    <li class="icondemo"><i class="icon-delicious"></i></br>icon-delicious</li>
    <li class="icondemo"><i class="icon-stumbleupon"></i></br>icon-stumbleupon</li>
    <li class="icondemo"><i class="icon-stumbleupon-2"></i></br>icon-stumbleupon-2</li>
    <li class="icondemo"><i class="icon-stackoverflow"></i></br>icon-stackoverflow</li>
    <li class="icondemo"><i class="icon-pinterest"></i></br>icon-pinterest</li>
    <li class="icondemo"><i class="icon-pinterest-2"></i></br>icon-pinterest-2</li>
    <li class="icondemo"><i class="icon-xing"></i></br>icon-xing</li>
    <li class="icondemo"><i class="icon-xing-2"></i></br>icon-xing-2</li>
    <li class="icondemo"><i class="icon-flattr"></i></br>icon-flattr</li>
    <li class="icondemo"><i class="icon-foursquare"></i></br>icon-foursquare</li>
    <li class="icondemo"><i class="icon-foursquare-2"></i></br>icon-foursquare-2</li>
    <li class="icondemo"><i class="icon-paypal"></i></br>icon-paypal</li>
    <li class="icondemo"><i class="icon-paypal-2"></i></br>icon-paypal-2</li>
    <li class="icondemo"><i class="icon-paypal-3"></i></br>icon-paypal-3</li>
    <li class="icondemo"><i class="icon-yelp"></i></br>icon-yelp</li>
    <li class="icondemo"><i class="icon-libreoffice"></i></br>icon-libreoffice</li>
    <li class="icondemo"><i class="icon-file-pdf"></i></br>icon-file-pdf</li>
    <li class="icondemo"><i class="icon-file-openoffice"></i></br>icon-file-openoffice</li>
    <li class="icondemo"><i class="icon-file-word"></i></br>icon-file-word</li>
    <li class="icondemo"><i class="icon-file-excel"></i></br>icon-file-excel</li>
    <li class="icondemo"><i class="icon-file-zip"></i></br>icon-file-zip</li>
    <li class="icondemo"><i class="icon-file-powerpoint"></i></br>icon-file-powerpoint</li>
    <li class="icondemo"><i class="icon-file-xml"></i></br>icon-file-xml</li>
    <li class="icondemo"><i class="icon-file-css"></i></br>icon-file-css</li>
    <li class="icondemo"><i class="icon-html5"></i></br>icon-html5</li>
    <li class="icondemo"><i class="icon-html5-2"></i></br>icon-html5-2</li>
    <li class="icondemo"><i class="icon-css3"></i></br>icon-css3</li>
    <li class="icondemo"><i class="icon-chrome"></i></br>icon-chrome</li>
    <li class="icondemo"><i class="icon-firefox"></i></br>icon-firefox</li>
    <li class="icondemo"><i class="icon-IE"></i></br>icon-IE</li>
    <li class="icondemo"><i class="icon-opera"></i></br>icon-opera</li>
    <li class="icondemo"><i class="icon-safari"></i></br>icon-safari</li>
    <li class="icondemo"><i class="icon-IcoMoon"></i></br>icon-IcoMoon</li>
    <li class="icondemo"><i class="icon-comment"></i></br>icon-comment</li>
    <li class="icondemo"><i class="icon-mic"></i></br>icon-mic</li>
    <li class="icondemo"><i class="icon-envelope"></i></br>icon-envelope</li>
    <li class="icondemo"><i class="icon-briefcase-2"></i></br>icon-briefcase-2</li>
    <li class="icondemo"><i class="icon-cart-4"></i></br>icon-cart-4</li>
    <li class="icondemo"><i class="icon-locked"></i></br>icon-locked</li>
    <li class="icondemo"><i class="icon-apple-2"></i></br>icon-apple-2</li>
    <li class="icondemo"><i class="icon-chart"></i></br>icon-chart</li>
    <li class="icondemo"><i class="icon-warning-2"></i></br>icon-warning-2</li>
    <li class="icondemo"><i class="icon-keyboard-2"></i></br>icon-keyboard-2</li>
    <li class="icondemo"><i class="icon-stats-2"></i></br>icon-stats-2</li>
    <li class="icondemo"><i class="icon-list-3"></i></br>icon-list-3</li>
    <li class="icondemo"><i class="icon-grid"></i></br>icon-grid</li>
    <li class="icondemo"><i class="icon-address-book-2"></i></br>icon-address-book-2</li>
    <li class="icondemo"><i class="icon-left-quote-alt"></i></br>icon-left-quote-alt</li>
    <li class="icondemo"><i class="icon-right-quote-alt"></i></br>icon-right-quote-alt</li>
    <li class="icondemo"><i class="icon-umbrella"></i></br>icon-umbrella</li>
    <li class="icondemo"><i class="icon-left-quote"></i></br>icon-left-quote</li>
    <li class="icondemo"><i class="icon-right-quote"></i></br>icon-right-quote</li>
    <li class="icondemo"><i class="icon-eyedropper"></i></br>icon-eyedropper</li>
    <li class="icondemo"><i class="icon-pen-alt-stroke"></i></br>icon-pen-alt-stroke</li>
    <li class="icondemo"><i class="icon-pen-alt-fill"></i></br>icon-pen-alt-fill</li>
    <li class="icondemo"><i class="icon-unlock-fill"></i></br>icon-unlock-fill</li>
    <li class="icondemo"><i class="icon-cloudy"></i></br>icon-cloudy</li>
    <li class="icondemo"><i class="icon-cloud-2"></i></br>icon-cloud-2</li>
    <li class="icondemo"><i class="icon-rainy"></i></br>icon-rainy</li>
    </ul>

    </div>




<?php
}
?>

