<?php
$this->Html->addCrumb('<li>' . $title_for_layout . '</li>', array('action' => 'index'), array('escape' => false));
$pw = true;
if ($this->request->params['action'] == 'admin_add') {
    $this->Html->addCrumb('<li>Thêm nhân viên</li>', '/' . $this->request->url, array('escape' => false));
} else {
    $pw = false;
    $this->Html->addCrumb('<li>' . $this->request->data['User']['name'] . '</li>', '/' . $this->request->url, array('escape' => false));
}
?>
<?php echo $this->Form->create('User', array(
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
                              data-icon="&#xe039;"></span> <?php echo __('Thông tin nhân viên'); ?>
                    </div>
                </div>
                <div class="widget-body">
                    <?php
                    echo $this->Form->input('id');
                    $this->Form->inputDefaults(array(
                        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                        'div' => array('class' => 'form-group'),
                        'label' => array('class' => 'col-lg-2 control-label'),
                        'between' => '<div class="col-lg-10">',
                        'after' => '</div>',
                        'class' => 'form-control',
                        'error' => array(
                            'attributes' => array(
                                'wrap' => 'span', 'class' => 'help-inline'
                            )
                        ),
                    ));
                    if ($pw)
                        echo $this->Form->input('username', array('label' => array('text' => 'Tên đăng nhập',
                            'class' => 'col-lg-2 control-label')));
                    else
                        echo $this->Form->input('username', array('label' => array('text' => 'Tên đăng nhập',
                            'class' => 'col-lg-2 control-label'), 'readonly' => 'readonly'));

                    if (!$pw){
                        echo $this->Form->input('password_update',
                            array('label' => array(
                                'text'=>'Mật khẩu mới',
                                'class' => 'col-lg-2 control-label'
                            ),
                                'maxLength' => 255, 'type' => 'password', 'required' => 0,'placeholder'=>'Bỏ trống nếu không thay đổi'));
                        echo $this->Form->input('password_confirm_update',
                            array(
                                'label' => array(
                                    'text'=>'Nhập lại mật khẩu',
                                    'class' => 'col-lg-2 control-label'
                                ),
                                'maxLength' => 255, 'title' => 'Confirm New password', 'type' => 'password',
                                'required' => 0,'placeholder'=>'Bỏ trống nếu không thay đổi'
                            ));
                    }else{
                        echo $this->Form->input('password', array('label' => array('text' => 'Mật khẩu', 'class' => 'col-lg-2 control-label')));
                        echo $this->Form->input('password_confirm',
                            array(
                                'label' => array(
                                    'text'=>'Nhập lại mật khẩu',
                                    'class' => 'col-lg-2 control-label'
                                ),
                                'maxLength' => 255, 'title' => 'Confirm password', 'type' => 'password'));
                    }
                    echo $this->Form->input('name', array('label' => array('text' => 'Tên nhân viên', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('code', array('label' => array('text' => 'Mã nhân viên', 'class' => 'col-lg-2 control-label'), 'readonly' => 'readonly'));
                    echo $this->Form->input('phone', array('label' => array('text' => 'Số điện thoại', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('address', array('label' => array('text' => 'Địa chỉ', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('district', array('label' => array('text' => 'Quận huyện', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('city', array('label' => array('text' => 'Thành phố', 'class' => 'col-lg-2 control-label')));
                    ?>
                    <div class="btn-group" style="position: fixed;bottom: 0; right: 0;z-index: 1;">
                        <?php echo $this->Form->submit('Lưu lại', array('div' => false, 'class' => 'btn btn-success')) ?>
                        <a class="btn btn-danger">Huỷ</a>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="col-md-2" id="leftCol">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
					<span class="fs1" aria-hidden="true"
                          data-icon="&#xe039;"></span> <?php echo __('Thao tác khác'); ?>
                </div>
            </div>
            <div class="widget-body">
                <ul class="nav nav-stacked" id="sidebar">
                    <li><?php echo $this->Html->link(__('Đơn hàng của bạn'), array('controller' => 'orders','action' => 'user_orders')); ?></li>
                    <li><?php echo $this->Html->link(__('Phiếu nhập của bạn'), array('controller' => 'inout_warehouses', 'action' => 'user_ins')); ?> </li>
                    <li><?php echo $this->Html->link(__('Phiếu chuyển kho'), array('controller' => 'inout_warehouses', 'action' => 'user_transferred')); ?> </li>
                </ul>
            </div>
        </div>

    </div>
</div>