<?php
$this->Html->addCrumb ('<li>' . $title_for_layout . '</li>', array ('action' => 'index'), array ('escape' => false));

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb ('<li>Thêm khách hàng</li>', '/'.$this->request->url, array ('escape' => false));
} else {
	$this->Html->addCrumb ('<li>' . $this->request->data['Customer']['name'] . '</li>', '/'.$this->request->url, array ('escape' => false));
}
?>
<?php echo $this->Form->create ('Customer', array (
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
							  data-icon="&#xe039;"></span> <?php echo __ ('Thông tin khách hàng'); ?>
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
					echo $this->Form->input('name',array ('label' => array ('text' => 'Tên khách', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('code',array ('label' => array ('text' => 'Code', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('birthday',array ('label' => array ('text' => 'Ngày sinh', 'class' => 'col-lg-2 control-label'),'class'=>''));
                    echo $this->Form->input('gender', array(
                            'options' => array(
                                '0' => 'Nam',
                                '1' => 'Nữ'
                            ),
                            'before' => '<div class="col-lg-2 control-label"><strong>Giới tính</strong></div><div class="col-lg-5">',
                            'separator' => '</div><div class="col-lg-5">',
                            'after' => '</div>',
                            'type'  => 'radio',
                            'class' => 'input-sm col-lg-2',
                            'label' => array ('class' => 'col-lg-2 control-label'),
                            'legend' => false
                        )
                    );
					echo $this->Form->input('phone',array ('label' => array ('text' => 'Số điện thoại', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('email',array ('label' => array ('text' => 'Email', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('facebook',array ('label' => array ('text' => 'Facebook', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('address',array ('label' => array ('text' => 'Địa chỉ', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('district',array ('label' => array ('text' => 'Quận huyện', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('city',array ('label' => array ('text' => 'Thành phố', 'class' => 'col-lg-2 control-label')));
					?>
					<div class="btn-group" style="position: fixed;bottom: 0; right: 0;z-index: 1;">
						<?php echo $this->Form->submit ('Lưu lại', array ('div' => false, 'class' => 'btn btn-success')) ?>
						<a href="<?php echo $this->Html->url(array('action'=>'index'))?>" class="btn btn-danger">Huỷ</a>
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
					<li><?php echo $this->Html->link(__('Danh sách khách hàng'), array('action' => 'index')); ?></li>
					<li><?php echo $this->Html->link(__('Danh sách đơn hàng'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__('Đơn hàng mới'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
				</ul>
			</div>
		</div>

	</div>
</div>