<div class="row">
    <div class="col-lg-12">
      <h4><?php echo $post['Post']['title']?></h4>
        <small><?php echo $post['Creater']['name']?></small>
        <hr>
        <p><span class="glyphicon glyphicon-time"></span> <?php echo date('H\hi\, \n\g\à\y d \t\h\á\n\g m \n\ă\m Y')?></p>
        <hr>
    </div>
    <div class="col-lg-12">
        <?php echo $post['Post']['body']?>
    </div>
</div>