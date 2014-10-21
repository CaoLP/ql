<?php
$this->Html->addCrumb ('<li>' . $title_for_layout . '</li>', array ('action' => 'index'), array ('escape' => false));
if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb ('<li>Tạo mới sản phẩm</li>', '/'.$this->request->url, array ('escape' => false));
} else {
	$this->Html->addCrumb ('<li>' . $this->request->data['OptionGroup']['name'] . '</li>', '/'.$this->request->url, array ('escape' => false));
}
?>
<?php echo $this->Form->create ('OptionGroup', array (
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
							  data-icon="&#xe039;"></span> <?php echo __ ('Nhóm thuộc tính'); ?>
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
					echo $this->Form->input('name', array ('label' => array ('text' => 'Tên nhóm', 'class' => 'col-lg-2 control-label')));
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
					<li><?php echo $this->Html->link(__('Nhóm thuộc tính'), array('action' => 'index')); ?></li>
					<li><?php echo $this->Html->link(__('Thuộc tính'), array('controller' => 'options', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__('Thêm thuộc tính'), array('controller' => 'options', 'action' => 'add')); ?> </li>
				</ul>
			</div>
		</div>

	</div>
</div>
