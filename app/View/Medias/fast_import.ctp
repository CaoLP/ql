<script>
    var ajax_media_url = '<?php echo $this->Html->url(array('controller'=>'medias','action'=>'update_media')) ?>';
    var ajax_product_url = '<?php echo $this->Html->url(array('controller'=>'products','action'=>'ajax_index')) ?>';
</script>
<div class="panel-heading">
    <h3 class="panel-title">
        <a href="javascript:void(0);" class="toggle-sidebar">
            <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>
        <?php echo __('Thêm hàng nhanh'); ?>    </h3>
</div>
<div class="panel-body">
<div id="plupload" class="col-md-12">
    <div id="droparea" href="#">
        <h3><?php echo __d('media',"Déplacer les fichiers ici"); ?></h3>
        <?php echo __d('media',"ou"); ?><br/>
        <a id="browse" href="#" class="btn btn-info"><?php echo __d('media',"Parcourir"); ?></a>
        <p class="small">(<?php echo __d('media','%s seulement',implode(', ', $extensions)); ?>)</p>
    </div>
</div>
<div id="filelist" class="col-md-12">
    <?php echo $this->Form->create('Media',array('url'=>array('controller'=>'medias','action'=>'order'))); ?>
    <?php foreach($medias as $media): $media = current($media);  ?>
        <?php require('media2.ctp'); ?>
    <?php endforeach; ?>
    <?php echo $this->Form->end(); ?>
</div>
</div>
<?php $this->Html->script('jquery.form.js',array('inline'=>false)); ?>
<?php $this->Html->script('plupload.js',array('inline'=>false)); ?>
<?php $this->Html->script('plupload.html5.js',array('inline'=>false)); ?>
<?php $this->Html->script('plupload.flash.js',array('inline'=>false)); ?>
<?php $this->Html->script('fast_upload.js',array('inline'=>false)); ?>
<?php $this->Html->scriptStart(array('inline'=>false)); ?>


jQuery(function(){
	var theFrame = $("#medias-<?php echo $ref; ?>-<?php echo $ref_id; ?>", parent.document.body);
	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash',
		container: 'plupload',
		browse_button : 'browse',
		max_file_size : '50mb',
		flash_swf_url : '<?php echo Router::url('/media/js/plupload.flash.swf'); ?>',
		url : '<?php echo Router::url(array('controller'=>'medias','action'=>'upload',$ref,$ref_id,true,'editor'=>$editor,'?' => "id=$id")); ?>',
		 filters : [
			{title : "Accepted files", extensions : "<?php echo implode(',', $extensions); ?>"},
		],
		drop_element : 'droparea',
		multipart:true,
		urlstream_upload:true
	});

	uploader.init();

	uploader.bind('FilesAdded', function(up, files) {
		for (var i in files) {
			$('#filelist>form').append('<div class="item col-md-3 thumbnail" id="' + files[i].id + '">&nbsp; &nbsp;' + files[i].name + ' (' + plupload.formatSize(files[i].size) + ') <div class="progressbar"><div class="progress"></div></div></div>');
		}
		uploader.start();
		$('#droparea').removeClass('dropping');
		theFrame.css({ height:$('body').height() + 40 });

	});

	uploader.bind('UploadProgress', function(up, file) {
		$('#'+file.id).find('.progress').css('width',file.percent+'%')
	});

	uploader.bind('FileUploaded', function(up, file, response){
		var response = jQuery.parseJSON(response.response);
		if(response.error){
			alert(response.error)
		}else{
			$('#'+file.id).before(response.content);
		}
		$('#'+file.id).remove();
	});
	uploader.bind('Error',function(up, err){
		alert(err.message);
		$('#droparea').removeClass('dropping');
		uploader.refresh();
	});
	$('#droparea').bind({
       dragover : function(e){
           $(this).addClass('dropping');
       },
       dragleave : function(e){
           $(this).removeClass('dropping');
       }
	});

	$('a.del').live('click',function(e){
		e.preventDefault();
		elem = $(this);
		if(confirm('<?php echo __d('media',"Bạn có muốn xóa hình này không ?"); ?>')){
			$.post(elem.attr('href'),{},function(data){
				elem.parents('.item').slideUp();
			});
		}
		theFrame.animate({ height:theFrame.height() - 40 });
	});

	$('a.toggle').live('click',function(e){
		e.preventDefault();
		var a = $(this);
		var height = a.parent().parent().find('.expand').outerHeight();
		if(a.text() == '<?php echo __d('media', "Hiện"); ?>'){
			a.text('<?php echo __d('media', "Ẩn"); ?>');
			a.parent().parent().animate({
				height : 40 + height
			});
			theFrame.animate({
				height : theFrame.height() + height
			});
		}else{
			a.text('<?php echo __d('media', "Hiện"); ?>');
			a.parent().parent().animate({
				height : 40
			});
			theFrame.animate({
				height : theFrame.height() - height
			});
		}
	});

	theFrame.height($(document.body).height() + 50);

	<?php if($editor): ?>
		$('a.submit').live('click', function(){
			var $this = $(this);
			var html = createHtmlElement($this);
			var editor = '<?php echo $editor; ?>';
			var win = window.dialogArugments || opener || parent || top;
			win.send_to_<?php echo $editor; ?>(html, window, "<?php echo $id; ?>");
			return false;
		});

		function createHtmlElement($this) {
			var item = $this.parents('.item');
			var type = $('.filetype', item).val();
			if(type === 'pic') {
				var html = '<img src="'+$('.file', item).val()+'"';
				if( $('.alt', item).val() != '' ){
					html += ' alt="'+$('.alt', item).val()+'"';
				}
				if( $('.align:checked', item).val() != 'none' ){
					html += ' class="align'+$('.align:checked', item).val()+'"';
				}
				html += ' />';
				if( $('.href', item).val() != '' ){
					html = '<a href="'+$('.href', item).val()+'" title="'+$('.title', item).val()+'">'+html+'</a>';
				}
			} else {
				html = '<a href="'+$('.href', item).val()+'" title="'+$('.title', item).val()+'">' + $('.title', item).val() + '</a>';
			}
			return html;
		}

	<?php endif; ?>
});

<?php $this->Html->scriptEnd(); ?>
<!-- Modal -->
<div class="modal fade" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <form action="<?php echo $this->Html->url(array(
        'controller' => 'medias',
        'action' => 'update_media'
    ))?>" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Chọn sản phẩm</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="product_name">Tìm sản phẩm</label>
                        <input type="text" class="form-control" id="product_name" placeholder="Nhập tên sản phẩm">
                        <input type="hidden" class="form-control" name="product_id" id="product_id">
                        <input type="hidden" class="form-control" name="media_id" id="media_id">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="use_as_thumb" id="use_as_thumb" value="true"> Làm ảnh đại diện
                        </label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                </div>
            </div>
        </div>
    </form>
</div>
