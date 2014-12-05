<?php foreach($action_logs as $log){
    ?>
    <div class="alert alert-info" role="alert">
        <?php echo date('d/m/Y h:m:s \:', strtotime($log['ActionLog']['created']) ) ?>
        <br>
        <?php echo $log['ActionLog']['message'];?>
    </div>
<?php
}?>
