<ul class="list-group">
<?php
foreach($result as $res){
?>
    <li class="list-group-item"><a href="<?php echo $this->Html->url(array('admin'=>true,'controller'=>'orders','action'=>'view',$res['Order']['id']));?>"><?php echo $res['Order']['code']; ?></a></li>
<?php
}
?>
</ul>
