<?php $sizes = getimagesize(WWW_ROOT.trim($media['file'], '/'));  ?>

<div class="item col-md-3 thumbnail">

		<input type="hidden" value="<?php echo $media['position']; ?>" name="data[Media][<?php echo $media['id']; ?>]">

		<div class="visu"><?php echo $this->Html->image($media['icon'],array('class'=>'img-responsive')); ?></div>

		<div class="actions">
			<?php echo $this->Html->link(__d('media',"Xóa"),array('action'=>'delete',$media['id']),array('class'=>'del btn btn-sm btn-danger')); ?>
            <?php echo $this->Html->link(__d('media',"Thêm hàng"),array('controller'=>'products','action'=>'add','?'=>array('media_id'=>$media['id'])),array('class'=>'btn btn-sm btn-info')); ?>
		    <a href="#" data-event="modal" data-toggle="modal" data-target="#product-modal" data-id="<?php echo $media['id'];?>" class="btn btn-sm btn-success">Hàng đã có</a>
        </div>
</div>