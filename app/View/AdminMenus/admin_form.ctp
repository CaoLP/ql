<?php
$this->Html->addCrumb ('<li>' . $title_for_layout . '</li>', array ('action' => 'index'), array ('escape' => false));

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb ('<li>Thêm menu</li>', '/'.$this->request->url, array ('escape' => false));
} else {
	$this->Html->addCrumb ('<li>' . $this->request->data['AdminMenu']['name'] . '</li>', '/'.$this->request->url, array ('escape' => false));
}
?>
<?php echo $this->Form->create ('AdminMenu', array (
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
							  data-icon="&#xe039;"></span> <?php echo __ ('Thông tin menu'); ?>
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
					echo $this->Form->input('icon',array ('label' => array ('text' => 'Icon', 'class' => 'col-lg-2 control-label')));
					echo $this->Form->input('url',array ('label' => array ('text' => 'Đường dẫn', 'class' => 'col-lg-2 control-label')));

					$selected = array();

					if(isset($this->request->data['AdminMenu']['group_ids'])){
						$selected = explode(',',$this->request->data['AdminMenu']['group_ids']);
					}

					echo $this->Form->input('group_ids',array ('label' => array ('text' => 'Nhóm người dùng', 'class' => 'col-lg-2 control-label'),
															  'multiple' => 'checkbox',
															  'options' => $groups,
															  'selected' => $selected,
														));
					echo $this->Form->input('parent_id',array ('empty'=>true,'label' => array ('text' => 'Mục cha', 'class' => 'col-lg-2 control-label')));
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
					<li><?php echo $this->Html->link(__('List Admin Menus'), array('action' => 'index')); ?></li>
					<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
					<li><?php echo $this->Html->link(__('List Admin Menus'), array('controller' => 'admin_menus', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__('New Parent Admin Menu'), array('controller' => 'admin_menus', 'action' => 'add')); ?> </li>
				</ul>
			</div>
		</div>

	</div>
</div>
