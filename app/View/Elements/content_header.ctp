
<!-- Page title start -->
<div class="row page-title">
    <h2>
        <?php echo $title_for_layout?>
        <small>
            <ul>
                <?php
                echo $this->Html->getCrumbs('<li>/</li>', array('text'=>'<li>Home</li>','escape' => false));
                ?>
            </ul>
        </small>
    </h2>
    <ul class="stats hidden-xs">
        <!--<li class="ruby-red-bg">
            <div class="details">
                <span class="big">$8,597</span>
                <span class="small">Current Sale</span>
            </div>
        </li>-->
        <li class="light-grey-bg">
            <div class="details">
                <span class="big"><?php echo $this->Session->read ('Auth.User.name'); ?></span>
                <span class="small"><?php echo $this->Session->read ('Auth.User.Store.name'); ?></span>
            </div>
        </li>
    </ul>
</div>
<!-- Page title end -->
