<?php
$this->Html->addCrumb ('<li>' . $title_for_layout . '</li>', array ('action' => 'index'), array ('escape' => false));
if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb ('<li>Tạo mới</li>', '/'.$this->request->url, array ('escape' => false));
} else {
	$this->Html->addCrumb ('<li>' . $this->request->data['Setting']['name'] . '</li>', '/'.$this->request->url, array ('escape' => false));
}
echo $this->Html->css (
	array (
		  'Autocomplete'
	), array ('inline' => false)
);
echo $this->Html->script (
	array (
		  'Autocomplete'
	), array ('inline' => false)
);
?>
<script type="text/javascript">
	$(document).ready(function(){
		new Autocomplete("SettingType", {
		srcType : "array",
		srcData : <?php echo $jsontype; ?>
		});
	});
</script>
<?php echo $this->Form->create ('Setting', array (
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
							  data-icon="&#xe039;"></span> <?php echo __ ('Thông tin tuỳ chỉnh'); ?>
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
					echo $this->Form->input('name',array ('label' => array ('text' => 'Tên', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('value',array ('label' => array ('text' => 'Giá trị', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('type',array ('autocomplete'=>'off','label' => array ('text' => 'Loại', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('description',array ('label' => array ('text' => 'Ghi chú', 'class' => 'col-lg-2 control-label')));
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
					<li><?php echo $this->Html->link(__('Tuỳ chỉnh'), array('action' => 'index')); ?></li>
				</ul>
			</div>
		</div>

	</div>
</div>