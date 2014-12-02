<?php echo $this->Html->css(array('treeview'));?>
<?php echo $this->Html->script(array(
    'jquery.cookie',
    'treeview',
    'acos',
));

?>
<div class="row">
    <div class="col-md-12">
        <div class="">
            <button class="btn danger" id="gen" data-loading-text="loading..." >Generate</button>
        </div>
        <div id="acos">
            <?php echo $this->Tree->generate($results, array('alias' => 'alias', 'model' => 'Aco', 'id' => 'acos-ul', 'element' => '/permission-node')); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() { 
    $("#acos").treeview({collapsed: true});
});
$(function() {
    var btn = $('#gen').click(function () {
        btn.button('loading');
        $.get('<?php echo $this->Html->url(array('admin'=>true,'controller'=>'user_permissions','action'=>'sync'));?>', {},
            function(data){
                btn.button('reset');
                $("#acos").html(data);
            }
        );        
    })
});
</script>
