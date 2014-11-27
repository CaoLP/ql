<?php
setlocale(LC_MONETARY, "vi_VN");
echo $this->Html->css('product',array('inline'=>false));
echo $this->Html->script('product',array('inline'=>false));
?>
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
                                <th><?php echo $this->Paginator->sort('store_id'); ?></th>
                                <th><?php echo $this->Paginator->sort('qty','Số lượng'); ?></th>
                                <th><?php echo $this->Paginator->sort('options'); ?></th>
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
                                    <td>
                                        <?php echo $this->Html->link($warehouse['Store']['name'], array('controller' => 'stores', 'action' => 'view', $warehouse['Store']['id'])); ?>
                                    </td>
                                    <td><?php echo h($warehouse['Warehouse']['qty']); ?>&nbsp;</td>
                                    <td><?php
                                        $arrayOP = explode(',', $warehouse['Warehouse']['options']);
                                        $temp = array();
                                        foreach ($arrayOP as $item) {
                                            $temp[] = $optionsData[$item];
                                        }
                                        echo implode(',', $temp);
                                        ?>
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

























