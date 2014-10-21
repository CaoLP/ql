<?php
$this->Html->addCrumb ('<li>' . $title_for_layout . '</li>', array ('action' => 'index'), array ('escape' => false));

$ud = false;
if ($this->request->params['action'] == 'admin_add') {
    $this->Html->addCrumb ('<li>Thêm khuyến mãi cho khách hàng</li>', '/'.$this->request->url, array ('escape' => false));
} else {
    $this->Html->addCrumb ('<li>' . $this->request->data['Customer']['name'] . '</li>', '/'.$this->request->url, array ('escape' => false));
    $ud = true;
}
echo $this->Html->css (
    array (
        'select2'
    ), array ('inline' => false)
);
echo $this->Html->script (
    array (
        'select2',
        //		  'jquery.maskMoney.min'
    ), array ('block' => 'scriptBottom')
);
?>
<?php echo $this->Form->create ('CustomerPromote', array (
    'class' => 'form-horizontal',
));?>
<style>
    .select2-choice{
        position: initial !important;
        border: none !important;
        line-height: 20px !important;
    }
</style>
<!-- Row start -->
<div class="row">
    <div class="col-md-10">
        <div class="row">
            <div class="widget">
                <div class="widget-header">
                    <div class="title">
						<span class="fs1" aria-hidden="true"
                              data-icon="&#xe039;"></span> <?php echo __ ('Thông tin'); ?>
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
                    echo $this->Form->input('customer_id',array ('label' => array ('text' => 'Tên khách', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('promote_id',array ('label' => array ('text' => 'Loại khuyến mãi', 'class' => 'col-lg-2 control-label')));
                    if($ud)
                    echo $this->Form->input('used',array ('options'=>$statuses,'label' => array ('text' => 'Sử dụng', 'class' => 'col-lg-2 control-label')));
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
                    <li><?php echo $this->Html->link(__('Danh sách khuyên mãi'), array('action' => 'index')); ?></li>
                </ul>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function(){
        $('#CustomerPromoteCustomerId').select2();
    })
</script>