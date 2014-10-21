<?php
$this->Html->addCrumb ('<li>' . $title_for_layout . '</li>', array ('action' => 'index'), array ('escape' => false));
if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb ('<li>Tạo mới sản phẩm</li>', '/'.$this->request->url, array ('escape' => false));
} else {
	$this->Html->addCrumb ('<li>' . $this->request->data['Product']['name'] . '</li>', '/'.$this->request->url, array ('escape' => false));
}

echo $this->Html->css (
	array (
		  '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css',
		  '/ElFinder/elfinder/css/elfinder.min',
		  '/ElFinder/elfinder/css/theme'
	), array ('inline' => false)
);
?>
<script>
	$(document).ready(function () {
		$('#select-button').live('click', function () {
			var elfinderDialog = $("#elfinder-dialog").modal('show');
			var f = $('#elfinder-container').elfinder({
				url: '<?php echo base_URL.$this->Html->url(array(
				'plugin'=>'el_finder',
				'controller'=>'el_finder',
				'action' =>'connector'
			));?>',
				handlers: {
					select: function (event, elfinderInstance) {
						var html = '';
						for (x in event.data.selected) {
							var file = event.data.selected[x];
							var fileInfo = elfinderInstance.file(file);
							if (fileInfo.mime != 'directory') {
								var url = elfinderInstance.url(file);
								html += '<img src="' + url + '" width="50px" height="50px"/>';
							}
						}

						$('#images-list').html(html);
					}
//				dblclick: function(event, elfinderInstance) {
//					fileInfo = elfinderInstance.file(event.data.file);
//
//					if(fileInfo.mime != 'directory') {
////						callback( elfinderInstance.url(event.data.file) ); // get file path..
//						$('#ProductThumbnail').val( elfinderInstance.url(event.data.file));
//						elfinderInstance.destroy();
//						return false; // stop elfinder
//					}
//				},
//				destroy: function(event, elfinderInstance) {
//					elfinderDialog.dialog('close');
//				}
				}
//			height: 490,
//			docked: false,
//			closeOnEditorCallback: true,
//			editorCallback: function(url) {
//				$('#ProductThumbnail').val(url);
//			}
			}).elfinder('instance');

		});
		$("#accept-selected").live('click', function () {
			var image_template =
							'<div class="alert alert-block col-md-2 img-box">' +
									'<input  class="close select-thumb" type="radio" name="proimg" style="float: left;opacity: 1;" data-original-title=""/>' +
									'<button data-dismiss="alert" class="close" type="button" data-original-title="">×</button>' +
									'<img class="thumbnail detail-imgs" width="100%" src="{img}"/>' +
									'</div>',
					output = '';
			$('#images-list img').each(function () {
				var src = $(this).attr('src');
				var build = true;
				$('.detail-imgs').each(function(){
					if($(this).attr('src') == src) build = false;
				});
				if(build)
					output += image_template.replace('{img}', src);
			});
			$(output).appendTo($('#pro-img'));
		});
		$('form').on('submit', function (e) {
			var images = new Array();
			$('.detail-imgs').each(function () {
				var img = $(this).attr('src');
				images.push(img);
			});
			$('#ProductImages').val(images);
		});
		$(document).on('click', '.select-thumb', function () {
			if ($(this).is(':checked')) {
				$('#ProductThumbnail').val($(this).parent().find('.detail-imgs').attr('src'));
			}
		});
	});
</script>
<?php echo $this->Form->create ('Product', array (
												 'class' => 'form-horizontal',
										   ));?>
<!-- Row start -->
<div class="row">
	<div class="col-md-10">
		<div class="row">
			<div class="widget">
				<div class="widget-header">
					<div class="title">
						<span class="fs1" aria-hidden="true"
							  data-icon="&#xe039;"></span> <?php echo __ ('Thông tin sản phẩm'); ?>
					</div>
				</div>
				<div class="widget-body">
					<?php
					echo $this->Form->input ('id');
					$this->Form->inputDefaults (array (
													  'format' => array ('before', 'label', 'between', 'input', 'error', 'after'),
													  'div' => array ('class' => 'form-group'),
													  'label' => array ('class' => 'col-lg-2 control-label'),
													  'between' => '<div class="col-lg-10">',
													  'after' => '</div>',
													  'class' => 'form-control',
													  'error' => array (
														  'attributes' => array (
															  'wrap' => 'span', 'class' => 'help-inline'
														  )
													  ),
												));
					echo $this->Form->input ('sku', array ('label' => array ('text' => 'SKU', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input ('name', array ('label' => array ('text' => 'Tên sản phẩm', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input ('price', array ('label' => array ('text' => 'Giá tiền', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input ('excert', array ('label' => array ('text' => 'Tóm tắt', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input ('descriptions', array ('label' => array ('text' => 'Nội dung', 'class' => 'col-lg-2 control-label')));
					//					echo $this->Form->input ('status', array ('label' => array ('text' => 'status', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input ('thumbnail', array ('type' => 'hidden'));
					echo $this->Form->input ('images', array ('type' => 'hidden'));
					echo $this->Form->input ('category_id', array ('label' => array ('text' => 'Danh mục', 'class' => 'col-lg-2 control-label')));
					//foreach($options as $key=>$option):
					echo $this->Form->input('ProductOption.option_id', array(
																			'format' => array ('before', 'label', 'between', 'input', 'error', 'after'),
																			'label' => array ('text' => 'Thuộc tính', 'class' => 'col-lg-2 control-label'),
																			'type' => 'select', 
																			'multiple' => 'checkbox',
																			'options' => $options,
																			'selected' => $selected,
																			'div' => array ('class' => 'form-group'),
																			'between' => '<div class="col-lg-10 p-t-7">',
																			'after' => '</div>',
																			'class' => 'checkbox col-lg-2',
																			'error' => array (
																			  'attributes' => array (
																				  '					wrap' => 'span', 'class' => 'help-inline'
																									)
																			  )
																		  ));			
					//endforeach;
					?>
					<div class="btn-group" style="position: fixed;bottom: 0; right: 0;z-index: 1;">
						<?php echo $this->Form->submit ('Lưu lại', array ('div' => false, 'class' => 'btn btn-success')) ?>
						<a class="btn btn-danger">Huỷ</a>
					</div>
				</div>
			</div>
		
		
		</div>
		<?php echo $this->Form->end (); ?>
		<div class="row">
			<div class="widget">
				<div class="widget-header">
					<div class="title ">
						<span class="fs1" aria-hidden="true" data-icon="&#xe039;"></span> <?php echo __ ('Hình ảnh'); ?>
					</div>
					<a class="pull-right btn btn-xs btn-success" id="select-button">Thêm ảnh</a>
				</div>
				<div class="widget-body">
					<div class="row" id="pro-img">
						<?php if (isset($this->request->data['Product']['images'])):
							$images = explode (',', $this->request->data['Product']['images']);
							foreach ($images as $img) {
								?>
								<div class="alert alert-block col-md-2 img-box">
									<input class="close select-thumb" type="radio" name="proimg"<?php
									if ($this->request->data['Product']['thumbnail'] == $img) echo ' checked="checked" ';
									?> style="float: left;opacity: 1;" data-original-title=""/>
									<button data-dismiss="alert" class="close" type="button" data-original-title="">×
									</button>
									<img class="thumbnail detail-imgs" width="100%" src="<?php echo $img; ?>"/>
								</div>
							<?php } endif; ?>
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class="col-md-2" id="leftCol">
		<div class="widget">
			<div class="widget-header">
				<div class="title">
					<span class="fs1" aria-hidden="true"
						  data-icon="&#xe039;"></span> <?php echo __ ('Thao tác khác'); ?>
				</div>
			</div>
			<div class="widget-body">
				<ul class="nav nav-stacked" id="sidebar">
					<li><?php echo $this->Html->link (__ ('Hàng hoá'), array ('action' => 'index')); ?></li>
					<li><?php echo $this->Html->link (__ ('Danh mục'), array ('controller' => 'categories', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link (__ ('Thêm danh mục'), array ('controller' => 'categories', 'action' => 'add')); ?> </li>
					<li><?php echo $this->Html->link (__ ('Thuộc tính hàng'), array ('controller' => 'options', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link (__ ('Thêm thuộc tính'), array ('controller' => 'options', 'action' => 'add')); ?> </li>
					<li><?php echo $this->Html->link (__ ('Khuyến mãi'), array ('controller' => 'product_promotes', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link (__ ('Thêm khuyến mãi'), array ('controller' => 'product_promotes', 'action' => 'add')); ?> </li>
					<li><?php echo $this->Html->link (__ ('Kho hàng'), array ('controller' => 'warehouses', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link (__ ('Nhập kho'), array ('controller' => 'warehouses', 'action' => 'add')); ?> </li>
				</ul>
			</div>
		</div>

	</div>
</div>
<!-- Row end -->

<!-- Add this html to your page -->
<div class="modal fade" id="elfinder-dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-original-title="">×
				</button>
				<h4 class="modal-title">Quản lý file</h4>
			</div>
			<div class="modal-body">
				<div class="well-sm">
					<div class="row">
						<div id="elfinder-container"></div>
					</div>
					<div class="row thumbnail"></div>
					<div class="row">
						<div id="images-list">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="accept-selected" data-dismiss="modal"
						data-original-title="">Chấp nhận
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal" data-original-title="">Đóng</button>
			</div>
		</div>
	</div>
</div>