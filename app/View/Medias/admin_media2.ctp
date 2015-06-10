<?php $sizes = getimagesize(WWW_ROOT.trim($media['file'], '/'));  ?>

<div class="item col-md-3 thumbnail">

		<input type="hidden" value="<?php echo $media['id']; ?>" name="data[Media][id]">

		<div class="visu"><?php echo $this->Html->image($media['icon'],array('class'=>'img-responsive')); ?></div>

		<div class="actions">
			<?php echo $this->Html->link(__d('media',"Xóa"),array('action'=>'delete',$media['id']),array('class'=>'del btn btn-sm btn-danger')); ?>
            <?php echo $this->Html->link(__d('media',"Thêm mới"),array('controller'=>'products','action'=>'add','?'=>array('media_id'=>$media['id'])),array('class'=>'btn btn-sm btn-info')); ?>
            <a href="javascript:;" class="btn btn-sm btn-success import">Cập nhật ảnh <i class="glyphicon glyphicon-import"></i></a>
        </div>
</div>