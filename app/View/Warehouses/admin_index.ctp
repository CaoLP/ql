<?php
setlocale(LC_MONETARY, "vi_VN");
echo $this->Html->css('product',array('inline'=>false));
echo $this->Html->script(array('product','warehouse_edit'),array('inline'=>false));
//http://demo.gawibowo.com/easymenu/emm/
?>
<script>
    var updateLink = '<?php echo $this->Html->url(array('action'=>'edit'))?>';
</script>
<div class="row">
    <div class="col-md-3">
        <div class="widget">
            <div class="widget-header">
                <h3>Tìm kiếm</h3>
            </div>
            <div class="widget-body">
                <form method="post">
                    <div class="form-group">
                        <input name="data[q]" placeholder="Nhập mã hoặc tên để tìm kiếm" value="<?php
                        if(isset($this->request->data['q'])) echo $this->request->data['q'];
                        ?>" class="form-control">
                    </div>
                    <?php
                    echo $this->Form->input('category_id',array('label'=>array('text'=>'Danh mục'),'empty'=>true,'div'=>array('class'=>'form-group'),'class'=>'form-control'));
                    echo $this->Form->input('store_id',array('label'=>array('text'=>'Cửa hàng'),'empty'=>true,'div'=>array('class'=>'form-group'),'class'=>'form-control'));
                    echo $this->Form->input('option_id', array('label'=>array('text'=>'Tuỳ chọn'), 'multiple' => 'checkbox','div'=>array('id'=>'option_group','class'=>'form-group'),'class'=>'form-control'));
                    ?>
                    <div class="form-group">
                        <button class="form-control btn btn-info" type="submit"><i class="icon-search"></i> Tìm kiếm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="widget">
            <div class="widget-header">
                <h3>Kho hàng  <?php
                    echo $this->Paginator->counter(array(
                        'format' => __('hiện có {:count} sản phẩm')
                    ));
                    ?></h3>
            </div>
            <div class="widget-body">
                <div class="row">
                    <div class="col-md-12">

                        <table class="table table-condensedtable-hover no-margin">
                            <thead>
                            <tr>
                                <th><?php echo $this->Paginator->sort('id'); ?></th>
                                <th><?php echo $this->Paginator->sort('code'); ?></th>
                                <th><?php echo $this->Paginator->sort('product_id'); ?></th>
                                <th><?php echo $this->Paginator->sort('price'); ?></th>
                                <th><?php echo $this->Paginator->sort('store_id'); ?></th>
                                <th><?php echo $this->Paginator->sort('qty','Số lượng'); ?></th>
                                <th><?php echo $this->Paginator->sort('options'); ?></th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($warehouses as $warehouse): ?>
                                <tr>
                                    <td><?php echo h($warehouse['Warehouse']['id']); ?>&nbsp;</td>
                                    <td><?php echo h($warehouse['Warehouse']['code']); ?>&nbsp;</td>
                                    <td>
                                        <?php echo $this->Html->link($warehouse['Product']['name'], array('controller' => 'products', 'action' => 'view', $warehouse['Product']['id'])); ?>
                                    </td>
                                    <td><?php echo number_format(h($warehouse['Warehouse']['price']), 0, '.', ','); ?>&nbsp;</td>
                                    <td>
                                        <?php echo $this->Html->link($warehouse['Store']['name'], array('controller' => 'stores', 'action' => 'view', $warehouse['Store']['id'])); ?>
                                    </td>
                                    <td><?php echo h($warehouse['Warehouse']['qty']); ?>&nbsp;</td>
                                    <td><?php
                                        $arrayOP = explode(',', $warehouse['Warehouse']['options']);
                                        $temp = array();
                                        foreach ($arrayOP as $item) {
                                            if(isset($optionsData[$item]))
                                            $temp[] = $optionsData[$item];
                                        }
                                        echo implode(',', $temp);
                                        ?>
                                    </td>
                                    <td>
                                        <a href="javascript:;"  class="btn btn-info btn-xs edit-btn"
                                           data-id="<?php echo $warehouse['Warehouse']['id'];?>"
                                           data-name="<?php echo $warehouse['Product']['name'];?>"
                                           data-sku="<?php echo $warehouse['Warehouse']['code'];?>"
                                           data-price="<?php echo $warehouse['Warehouse']['price'];?>"
                                           data-store="<?php echo $warehouse['Store']['name'];?>"
                                           data-qty="<?php echo $warehouse['Warehouse']['qty'];?>"><i class="icon-pen"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-12">
                                <div class=" pull-right">
                                    <div class="dataTables_info" id="data-table_info">
                                        <?php
                                        echo $this->Paginator->counter(array(
                                            'format' => __('Showing {:start} to {:end} {:count} entries')
                                        ));
                                        ?>
                                    </div>
                                    <ul class="pagination pull-right">
                                        <?php
                                        echo $this->Paginator->prev(__('&laquo;'), array('tag' => 'li', 'escape' => false), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a', 'escape' => false));
                                        echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
                                        echo $this->Paginator->next(__('&raquo;'), array('tag' => 'li', 'currentClass' => 'disabled', 'escape' => false), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a', 'escape' => false));
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>
<div id="dialog-form" title="Thay đổi hàng">
    <p class="validateTips">Không được bỏ trống</p>
    <form>
        <ul class="list-group no-margin">
            <li class="list-group-item">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Mã hàng</span>
                    <input style="z-index: 1003;" type="text" readonly="readonly" class="form-control" name="data[P][sku]" id="p-sku" value="">
                </div>
            </li>
            <li class="list-group-item">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Tên hàng</span>
                    <input style="z-index: 1003;" type="text" readonly="readonly" class="form-control" name="data[P][name]" id="p-name" value="">
                    <input type="hidden" name="data[P][price]" id="hd-price">
                    <input type="hidden" name="data[P][qty]" id="hd-qty">
                    <input type="hidden" name="data[P][store]" id="hd-store">
                </div>
            </li>
            <li class="list-group-item">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Giá</span>
                    <input style="z-index: 1003;" type="text" class="form-control" name="data[Warehouse][price]" id="p-price" value="">
                </div>
            </li>
            <li class="list-group-item">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Số lượng</span>
                    <input style="z-index: 1003;" type="text" class="form-control" name="data[Warehouse][qty]" id="p-qty" value="">
                    <input type="hidden" name="data[Warehouse][id]" id="p-id">
                </div>
            </li>
        </ul>
        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </form>
</div>

























