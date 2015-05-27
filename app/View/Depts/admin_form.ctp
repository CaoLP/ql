<script>
    var customers = <?php echo json_encode($customers);?>;
    var linkOrder = '<?php echo $this->Html->url(array('controller'=>'orders','action'=>'index'));?>';
</script>
<?php
$this->Html->addCrumb('<li>' . $title_for_layout . '</li>', array('action' => 'index'), array('escape' => false));

if ($this->request->params['action'] == 'admin_add') {
    $this->Html->addCrumb('<li>Tạo phiếu</li>', '/' . $this->request->url, array('escape' => false));
} else {
    $this->Html->addCrumb('<li>' . $this->request->data['Dept']['number'] . '</li>', '/' . $this->request->url, array('escape' => false));
}
echo $this->Html->script(array('jquery.inputmask', 'dept'), array('inline' => false));
?>
<?php echo $this->Form->create('Dept', array(
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
                              data-icon="&#xe039;"></span> <?php echo __('Phiếu Thu - Chi'); ?>
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
                    $value1 = '';
                    echo $this->Form->input('name', array('label' => array('text' => 'Tên', 'class' => 'col-lg-2 control-label')));
                    ?>
                    <div class="form-group">
                        <label for="input-customer" class="col-lg-2 control-label">Khách hàng</label>
                        <div class="col-lg-10">
                            <input id="input-customer" class="form-control" value="<?php
                            if (isset($this->request->data['Dept']['customer_id']) && !empty($this->request->data['Order']['customer_id']))
                                echo $customersl[$this->request->data['Dept']['customer_id']];
                            ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="p-search" class="col-lg-2 control-label">Mã đơn hàng</label>
                        <div class="col-lg-10">
                            <input id="p-search" class="form-control" value="<?php
                            if (isset($this->request->data['Dept']['order_id']) && !empty($this->request->data['Order']['order_id']))
                                echo $customersl[$this->request->data['Dept']['order_id']];
                            ?>">
                        </div>
                    </div>
                    <?php
                    echo $this->Form->input('customer_id', array('type' => 'hidden', 'id' => 'input-customer-id', 'label' => array('text' => 'Khách hàng', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('order_id', array('type' => 'hidden','id' => 'p-search-hide','label' => array('text' => 'Mã đơn hàng', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('total', array(
                            'label' => array('text' => 'Số tiền', 'class' => 'col-lg-2 control-label'),
                            'type' => 'text',
                            'class' => 'form-control price-text',
                            'data-inputmask' => '\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
                        )
                    );
                    echo $this->Form->input('paid', array(
                            'label' => array('text' => 'Đã trả', 'class' => 'col-lg-2 control-label'),
                            'type' => 'text',
                            'class' => 'form-control price-text',
                            'data-inputmask' => '\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
                        )
                    );
                    echo $this->Form->input('pending', array(
                            'label' => array('text' => 'Còn lại', 'class' => 'col-lg-2 control-label'),
                            'type' => 'text',
                            'class' => 'form-control price-text',
                            'data-inputmask' => '\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
                        )
                    );
                    echo $this->Form->input('note', array('label' => array('text' => 'Ghi chú', 'class' => 'col-lg-2 control-label')));

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
</div>
