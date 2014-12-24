<?php
$this->Html->addCrumb ('<li>' . $title_for_layout . '</li>', array ('action' => 'index'), array ('escape' => false));

if ($this->request->params['action'] == 'admin_add') {
    $this->Html->addCrumb ('<li>Tạo phiếu</li>', '/'.$this->request->url, array ('escape' => false));
} else {
    $this->Html->addCrumb ('<li>' . $this->request->data['Reex']['number'] . '</li>', '/'.$this->request->url, array ('escape' => false));
}
echo $this->Html->script(array('jquery.inputmask','reex'), array('inline' => false));
?>
<?php echo $this->Form->create ('Reex', array (
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
                              data-icon="&#xe039;"></span> <?php echo __ ('Phiếu Thu - Chi'); ?>
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
                    $value1='';
                    if(isset($this->request->data['Reex']['number'])){
                        $value1 = $this->request->data['Reex']['number'];
                    }
                    if($this->request->params['action'] == 'admin_add'){
                        echo $this->Form->input('number',array (
                            'label' => array ('text' => 'Mã chứng từ', 'class' => 'col-lg-2 control-label'),
                            'placeholder' =>'Bỏ trống nếu muốn sử dụng mã tự động',
                            'value'=>$value1
                        ));
                    }else{
                        echo $this->Form->input('number',array (
                            'label' => array ('text' => 'Mã chứng từ', 'class' => 'col-lg-2 control-label'),
                            'placeholder' =>'Bỏ trống nếu muốn sử dụng mã tự động',
                            'value'=>$value1,
                            'readonly'=>'readonly'
                        ));
                    }
                    if(isset($this->request->data['Reex']['created_date'])){
                        $value = $this->request->data['Reex']['created_date'];
                    }else{
                        $value = date('Y-m-d');
                    }

                    echo $this->Form->input('created_date',array (
                        'label' => array ('text' => 'Ngày tạo', 'class' => 'col-lg-2 control-label'),
                        'type'=>'text',
                        'readonly'=>'readonly',
                        'class'=>'datepicker3 form-control',
                        'value' => $value
                    ));

                    echo $this->Form->input('type',array ('label' => array ('text' => 'Loại chứng từ', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('cause',array ('label' => array ('text' => 'Loại phiếu', 'class' => 'col-lg-2 control-label'),'options'=>$causes));
                    ?>
                    <div class="form-group required" style="display: none;" id="temp_div">
                        <label for="temp" class="col-lg-2 control-label">Loại khác</label>
                        <div class="col-lg-10"><input name="temp" class="form-control" id="temp" required>
                        </div>
                    </div>
                    <?php
                    echo $this->Form->input('store_id',array ('label' => array ('text' => 'Cửa hàng', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('total',array (
                            'label' => array ('text' => 'Số tiền', 'class' => 'col-lg-2 control-label'),
                            'type'=>'text',
                            'class'=>'form-control price-text',
                            'data-inputmask' => '\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digitsOptional\': true, \'placeholder\': \'0\''
                        )
                    );
                    echo $this->Form->input('person_one',array ('label' => array ('text' => 'Người giao', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('person_two',array ('label' => array ('text' => 'Người nhận', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('note',array ('label' => array ('text' => 'Ghi chú', 'class' => 'col-lg-2 control-label')));

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
