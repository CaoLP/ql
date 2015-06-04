<?php
$this->Html->addCrumb('<li>' . $title_for_layout . '</li>', array('action' => 'index'), array('escape' => false));
if ($this->request->params['action'] == 'admin_add') {
    $this->Html->addCrumb('<li>Tạo mới sản phẩm</li>', '/' . $this->request->url, array('escape' => false));
} else {
    $this->Html->addCrumb('<li>' . $this->request->data['Product']['name'] . '</li>', '/' . $this->request->url, array('escape' => false));
}

echo $this->Html->script(
    array(
        'product'
    )
    , array(
        'inline' => false
    )
);
?>
<?php echo $this->Form->create('Product', array(
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
                              data-icon="&#xe039;"></span> <?php echo __('Thông tin sản phẩm'); ?>
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
                    echo $this->Form->input('sku', array('label' => array('text' => 'Mã sản phẩm', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('name', array('label' => array('text' => 'Tên sản phẩm', 'class' => 'col-lg-2 control-label')));
                    ?>
                    <div class="form-group">
                        <label for="ProductProviderId" class="col-lg-2 control-label">Nhà cung cấp</label>

                        <div class="col-lg-10">
                            <div class="input-group">
                                <?php
                                echo $this->Form->input('provider_id', array('label' => false, 'div' => false, 'class' => 'form-control', 'after' => false, 'between' => false));
                                ?>
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button" data-toggle="modal"
                                            data-target="#provider"><i class="icon-plus"></i> Thêm mới
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php
                    echo $this->Form->input('price', array('label' => array('text' => 'Giá bán lẻ', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('retail_price', array('label' => array('text' => 'Giá bán sỉ', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('source_price', array('label' => array('text' => 'Giá tiền gốc', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('excert', array('label' => array('text' => 'Tóm tắt', 'class' => 'col-lg-2 control-label')));
                    ?>
                    <div class="form-group">
                        <?php echo $this->Media->ckeditor('descriptions', array('label' => array('text' => 'Nội dung', 'class' => 'col-lg-2 control-label')));?>
                    </div>
                    <?php
//                    echo $this->Form->input('descriptions', array('label' => array('text' => 'Nội dung', 'class' => 'col-lg-2 control-label')));
                    //					echo $this->Form->input ('status', array ('label' => array ('text' => 'status', 'class' => 'col-lg-2 control-label')));
                    echo $this->Form->input('thumbnail', array('type' => 'hidden'));
                    echo $this->Form->input('images', array('type' => 'hidden'));
                    echo $this->Form->input('category_id', array('label' => array('text' => 'Danh mục', 'class' => 'col-lg-2 control-label')));
                    //foreach($options as $key=>$option):
                    ?>
                    <div id="option-list">
                        <?php
                        echo $this->Form->input('ProductOption.option_id', array(
                            'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                            'label' => array('text' => 'Thuộc tính', 'class' => 'col-lg-2 control-label'),
                            'type' => 'select',
                            'multiple' => 'checkbox',
                            'options' => $options,
                            'selected' => $selected,
                            'div' => array('class' => 'form-group'),
                            'between' => '<div class="col-lg-10 p-t-7">',
                            'after' => '</div>',
                            'class' => 'checkbox col-lg-2',
                            'error' => array(
                                'attributes' => array(
                                    'wrap' => 'span', 'class' => 'help-inline'
                                )
                            )
                        ));
                        //endforeach;
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="ProductName" class="col-lg-2 control-label"></label>

                        <div class="col-lg-10">
                            <button class="btn btn-sm btn-success form-control" type="button" data-toggle="modal"
                                    data-target="#option">
                                <i class="icon-plus"></i> Thêm mới thuộc tính
                            </button>
                        </div>
                    </div>
                    <div class="btn-group" style="position: fixed;bottom: 0; right: 0;z-index: 1;">
                        <?php echo $this->Form->submit('Lưu lại', array('div' => false, 'class' => 'btn btn-success')) ?>
                        <a class="btn btn-danger">Huỷ</a>
                    </div>
                </div>
            </div>


        </div>
        <?php echo $this->Form->end(); ?>
        <div class="row">
            <div class="widget">
                <div class="widget-header">
                    <div class="title ">
                        <span class="fs1" aria-hidden="true" data-icon="&#xe039;"></span> <?php echo __('Hình ảnh'); ?>
                    </div>
                </div>
                <div class="widget-body">
                    <?php echo $this->Media->iframe('Product', $this->request->data['Product']['id']); ?>
                </div>
            </div>

        </div>
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
                    <li><?php echo $this->Html->link(__('Hàng hoá'), array('action' => 'index')); ?></li>
                    <li><?php echo $this->Html->link(__('Danh mục'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__('Thêm danh mục'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
                    <li><?php echo $this->Html->link(__('Thuộc tính hàng'), array('controller' => 'options', 'action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__('Thêm thuộc tính'), array('controller' => 'options', 'action' => 'add')); ?> </li>
                    <li><?php echo $this->Html->link(__('Khuyến mãi'), array('controller' => 'product_promotes', 'action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__('Thêm khuyến mãi'), array('controller' => 'product_promotes', 'action' => 'add')); ?> </li>
                    <li><?php echo $this->Html->link(__('Kho hàng'), array('controller' => 'warehouses', 'action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__('Nhập kho'), array('controller' => 'warehouses', 'action' => 'add')); ?> </li>
                </ul>
            </div>
        </div>

    </div>
</div>
<!-- Row end -->

<!-- Add this html to your page -->
<div class="modal fade" id="provider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-original-title="">×
                </button>
                <h4 class="modal-title">Thêm mới nhà cung cấp</h4>
            </div>
            <div class="modal-body">
                <div class="widget-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Tên nhà cung cấp</div>
                                <input name="data[Provider][name]" class="form-control" maxlength="50"
                                       type="text" id="ProviderName" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Mã nhà cung cấp</div>
                                <input name="data[Provider][code]" class="form-control" maxlength="10"
                                       type="text" id="ProviderCode" required="required">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submit-provider" data-dismiss="modal"
                        data-original-title="">Thêm mới
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal" data-original-title="">Đóng</button>
            </div>
        </div>
    </div>
</div>

<!-- Add this html to your page -->
<div class="modal fade" id="option" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-original-title="">×
                </button>
                <h4 class="modal-title">Thêm mới tuỳ chọn</h4>
            </div>
            <div class="modal-body">
                <div class="widget-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Nhóm thuộc tính</div>
                                <?php
                                echo $this->Form->input('Option.option_group_id', array('label' => false, 'div' => false, 'before' => false, 'between'=>false, 'after' => false));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Tên thuộc tính</div>
                                <input name="data[Provider][name]" class="form-control" maxlength="50"
                                       type="text" id="OptionName" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Mã thuộc tính</div>
                                <input name="data[Provider][code]" class="form-control" maxlength="10"
                                       type="text" id="OptionCode" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">Mở rộng</div>
                                <input name="data[Provider][code]" class="form-control" maxlength="50"
                                       type="text" id="OptionOther" required="required">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submit-option" data-dismiss="modal"
                        data-original-title="">Thêm mới
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal" data-original-title="">Đóng</button>
            </div>
        </div>
    </div>
</div>