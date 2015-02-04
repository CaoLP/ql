<?php
$this->Html->addCrumb ('<li>' . $title_for_layout . '</li>', array ('action' => 'index'), array ('escape' => false));

if ($this->request->params['action'] == 'admin_add') {
    $this->Html->addCrumb ('<li>Tạo mới ca làm</li>', '/'.$this->request->url, array ('escape' => false));
} else {
    $this->Html->addCrumb ('<li>' . $this->request->data['WorkSession']['name'] . '</li>', '/'.$this->request->url, array ('escape' => false));
}
?>
<?php echo $this->Form->create ('WorkSession', array (
    'class' => 'form-horizontal',
));?>
<!-- Row start -->
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="widget">
                <div class="widget-header">
                    <div class="title">
						<span class="fs1" aria-hidden="true"
                              data-icon="&#xe039;"></span> <?php echo __ ('Thông tin ca làm'); ?>
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
                    echo $this->Form->input('name',array ('label' => array ('text' => 'Ca làm', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('begin',array ('label' => array ('text' => 'Vào làm', 'class' => 'col-lg-2 control-label'),
                        'between' => '<div class="col-lg-10">','class' => 'input-sm','timeFormat' => '24'));
                    echo $this->Form->input('end',array ('label' => array ('text' => 'Ra về', 'class' => 'col-lg-2 control-label'),
                        'between' => '<div class="col-lg-10">','class' => 'input-sm','timeFormat' => '24'));
                    echo $this->Form->input('delay',array ('label' => array ('text' => 'Trể giờ', 'class' => 'col-lg-2 control-label')));
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
</div>