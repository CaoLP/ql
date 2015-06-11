<?php
if(isset($news)){
    ?>
    <div class="row">
        <div id="m1"class="col-md-12 marquee text-center" style="display: none">
            <span><a href="<?php echo $this->Html->url(array('controller'=>'posts','action'=>'view',$news['Post']['id']));?>">
                    <i class="icon <?php
                    if($news['Post']['type'] == 0) echo 'blue icon-info';
                    else if($news['Post']['type'] == 1) echo 'warning icon-warning';
                    else echo 'red icon-notification';
                    ?>"></i> <?php echo $news['Post']['title']?></a></span>
        </div>
    </div>
<?php
}
?>
