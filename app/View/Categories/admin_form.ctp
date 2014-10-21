<?php
$this->Html->addCrumb ('<li>' . $title_for_layout . '</li>', array ('action' => 'index'), array ('escape' => false));
if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb ('<li>Tạo mới sản phẩm</li>', '/'.$this->request->url, array ('escape' => false));
} else {
	$this->Html->addCrumb ('<li>' . $this->request->data['Category']['name'] . '</li>', '/'.$this->request->url, array ('escape' => false));
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
		$('#pick-img').on('click', function () {
			var elfinderDialog = $("#elfinder-dialog").modal('show');
			var f = $('#elfinder-container').elfinder({
				url: '<?php echo base_URL.$this->Html->url(array(
				'plugin'=>'el_finder',
				'controller'=>'el_finder',
				'action' =>'connector'
			));?>',
				handlers: {
				dblclick: function(event, elfinderInstance) {
					fileInfo = elfinderInstance.file(event.data.file);

					if(fileInfo.mime != 'directory') {
//						callback( elfinderInstance.url(event.data.file) ); // get file path..
						$('#CategoryImages').val( elfinderInstance.url(event.data.file));
						$('#pick-img').attr('src', elfinderInstance.url(event.data.file));
						elfinderInstance.destroy();
						return false; // stop elfinder
					}
				},
				destroy: function(event, elfinderInstance) {
					elfinderDialog.modal('hide');
				}
				}
			}).elfinder('instance');
		});
	});
</script>
<?php echo $this->Form->create ('Category', array (
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
							  data-icon="&#xe039;"></span> <?php echo __ ('Thông tin danh mục'); ?>
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
					echo $this->Form->input('parent_id', array ('empty'=>true,'label' => array ('text' => 'Danh mục cha', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('name', array ('label' => array ('text' => 'Tên danh mục', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('excerpt', array ('label' => array ('text' => 'Mô tả ngắn', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('descriptions', array ('label' => array ('text' => 'Mô tả danh mục', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('status', array ('label' => array ('text' => 'Trạng thái', 'class' => 'col-lg-2 control-label')));
					?>
					<div class="form-group">
						<label class="col-lg-2 control-label">Hình đại diện</label>
						<div class="col-lg-10" style="text-align:center;">
							<img style="cursor: pointer;" src="<?php
							if(!empty($this->request->data['Category']['images'])) echo $this->request->data['Category']['images'];
							else echo '/img/logo.png';
							?>" width="200" id="pick-img">
						</div>
					</div>
					<?php
					echo $this->Form->input('images', array ('type' =>'hidden'));
					?>
					<div class="btn-group" style="position: fixed;bottom: 0; right: 0;z-index: 1;">
						<?php echo $this->Form->submit ('Lưu lại', array ('div' => false, 'class' => 'btn btn-success')) ?>
						<a class="btn btn-danger">Huỷ</a>
					</div>
				</div>
			</div>
		</div>
		<?php echo $this->Form->end (); ?>
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
					<li><?php echo $this->Html->link(__('Danh mục'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__('Thêm mục cha'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
				</ul>
			</div>
		</div>

	</div>
</div>


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
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" data-original-title="">Đóng</button>
			</div>
		</div>
	</div>
</div>






