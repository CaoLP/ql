<?php
$this->Html->addCrumb ('<li>' . $title_for_layout . '</li>', array ('action' => 'index'), array ('escape' => false));

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb ('<li>Thêm cửa hàng</li>', '/'.$this->request->url, array ('escape' => false));
} else {
	$this->Html->addCrumb ('<li>' . $this->request->data['Store']['name'] . '</li>', '/'.$this->request->url, array ('escape' => false));
}
?>
<?php echo $this->Form->create ('Store', array (
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
							  data-icon="&#xe039;"></span> <?php echo __ ('Thông tin cửa hàng'); ?>
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
					echo $this->Form->input('name',array ('label' => array ('text' => 'Tên cửa hàng', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('phone',array ('label' => array ('text' => 'Số điện thoại', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('address',array ('label' => array ('text' => 'Địa chỉ', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('district',array ('label' => array ('text' => 'Quận huyện', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('city',array ('label' => array ('text' => 'Thành phố', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('manager_id');
					echo $this->Form->input('status');
					?>
					<div class="form-group">
						<label for="StoreStatus" class="col-lg-2 control-label">Tổng kho</label>
						<div class="col-lg-10">
							<div class="onoffswitch">
								<?php
								echo $this->Form->input('is_center',array (
																		  'format' => array ('before', 'label', 'between', 'input', 'error', 'after'),
																		  'div' => '',
																		  'between' => '',
																		  'after' => '',
																		  'label' => false,
																		  'class' => 'onoffswitch-checkbox',
																		  'type'=>'checkbox',
																		));
								?>
								<label class="onoffswitch-label" for="StoreIsCenter">
									<div class="onoffswitch-inner"></div>
									<div class="onoffswitch-switch"></div>
								</label>
							</div>
						</div>
					</div>
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
					<li><?php echo $this->Html->link(__('Danh sách cửa hàng'), array('action' => 'index')); ?></li>
					<li><?php echo $this->Html->link(__('Danh sách nhân viên'), array('controller' => 'users', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__('Kiểm kho'), array('controller' => 'warehouses', 'action' => 'index')); ?> </li>
				</ul>
			</div>
		</div>

	</div>
</div>
