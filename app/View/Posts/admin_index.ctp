<?php
foreach ($posts as $post): ?>
<div class="row">
    <div class="col-lg-12">
        <h4><?php echo $post['Post']['title']?></h4>
        <small><?php echo $post['Creater']['name']?></small>
        <small class="pull-right"><span class="glyphicon glyphicon-time"></span> <?php echo date('H\hi\, \n\g\à\y d \t\h\á\n\g m \n\ă\m Y')?></small>
        <hr>
    </div>
    <div class="col-lg-12">
        <?php
        $text = strip_tags($post['Post']['body']);
        if(strlen($text) > 200){
            $text = substr($text,0,200);
        }
        echo $text;
        ?>
    </div>
</div>
<?php endforeach; ?>
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