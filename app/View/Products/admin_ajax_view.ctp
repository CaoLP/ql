<?php
echo $this->Form->create ('Product', array (
										   'class' => 'form-horizontal',
									 ));
echo $this->Form->input ('id');
$this->Form->inputDefaults (array (
								  'format' => array ('before', 'label', 'between', 'input', 'error', 'after'),
								  'div' => array ('class' => 'form-group'),
								  'label' => array ('class' => 'col-lg-3 control-label'),
								  'between' => '<div class="col-lg-9">',
								  'after' => '</div>',
								  'class' => 'form-control',
								  'error' => array (
									  'attributes' => array (
										  'wrap' => 'span', 'class' => 'help-inline'
									  )
								  ),
							));
echo $this->Form->input ('sku', array ('readonly' => true, 'label' => array ('text' => 'SKU', 'class' => 'col-lg-3 control-label')));
echo $this->Form->input ('name', array ('readonly' => true, 'label' => array ('text' => 'Tên sản phẩm', 'class' => 'col-lg-3 control-label')));
echo $this->Form->input ('price', array ('type'=>'text','readonly' => true, 'label' => array ('text' => 'Giá tiền', 'class' => 'col-lg-3 control-label'), 'class' => 'form-control money'));
?>
<div class="form-group">
	<label for="ProductName" class="col-lg-3 control-label">Thuộc tính</label>

	<div class="col-lg-9">

<?php
foreach ($options as $name => $vals) {
	echo $this->Form->input ('options', array (
											  'format' => array ('before', 'label', 'between', 'input', 'error', 'after'),
											  'label' => array ('text' => $name, 'class' => 'col-lg-12 control-label','style'=>'text-align:center;'),
											  'type' => 'select',
											  'options' => $vals,
											  'div' => array ('class' => 'form-group col-lg-4'),
											  'between' => '<div class="col-lg-12 p-t-7">',
											  'after' => '</div>',
											  'error' => array (
												  'attributes' => array (
													  '					wrap' => 'span', 'class' => 'help-inline'
												  )
											  )
										));
}
?>

	</div>
</div>

<?php
echo $this->Form->input ('note', array ('label' => array ('text' => 'Ghi chú', 'class' => 'col-lg-3 control-label')));
echo $this->Form->input ('qty', array ('type'=>'number','required'=>true,'label' => array ('text' => 'Số lượng', 'class' => 'col-lg-3 control-label')));
echo $this->Form->input ('total', array ('readonly' => true, 'label' => array ('text' => 'Thành tiền', 'class' => 'col-lg-3 control-label'), 'class' => 'form-control money'));
?>
</form>

