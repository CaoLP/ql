<?php
setlocale(LC_MONETARY, "vi_VN");
echo $this->Html->css('product',array('inline'=>false));
echo $this->Html->script('product',array('inline'=>false));
?>
<!-- Row start -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <div class="title pull-right">
                    <?php echo $this->Html->link(
                        '<span aria-hidden="true" class="icon-plus"></span> Tạo mới',
                        array('action' => 'add'),
                        array('class' => 'btn btn-sm btn-success', 'escape' => false));?>
                </div>
                <h3>Danh sách hàng hoá</h3>
            </div>
            <div class="widget-body">
               <div class="row">
                   <div class="col-md-12">
                       <form method="post">
                       <div class="input-group">
                           <input name="data[q]" placeholder="Nhập mã sản phẩm hoặc tên để tìm kiếm" value="<?php
                                if(isset($this->request->data['q'])) echo $this->request->data['q'];
                           ?>" class="form-control">
                           <span class="input-group-btn">
                                    <button class="btn btn-info" type="submit"><i class="icon-search"></i> Tìm kiếm
                                    </button>
                                </span>
                       </div>
                       </form>
                   </div>
               </div>
                <div class="row">
                   <div class="col-md-12">
                       <table class="table table-condensedtable-hover no-margin table-product">
                           <thead>
                           <tr>
                               <th width="80">Ảnh đại diện</th>
                               <th><?php echo $this->Paginator->sort('sku', 'Mã gốc'); ?></th>
                               <th><?php echo $this->Paginator->sort('name', 'Tên Sản phẩm'); ?></th>
                               <th><?php echo $this->Paginator->sort('price', 'Giá'); ?></th>
                               <th><?php echo $this->Paginator->sort('price', 'Giá gốc'); ?></th>
                               <th><?php echo $this->Paginator->sort('created', 'Ngày tạo'); ?></th>
                               <th><?php echo $this->Paginator->sort('created_by', 'Người tạo'); ?></th>
                               <th><?php echo $this->Paginator->sort('updated', 'Ngày cập nhật'); ?></th>
                               <th><?php echo $this->Paginator->sort('updated_by', 'Người cập nhật'); ?></th>
                               <th class="actions"><?php echo __('Actions'); ?></th>
                           </tr>
                           </thead>
                           <tbody>
                           <?php foreach ($products as $product): ?>
                               <tr>
                                   <td>
                                       <a href="javascript:;" class="view-img" data-imagelist='<?php
                                       $img = explode(',',$product['Product']['images']);
                                       echo json_encode($img);
                                       ?>'><img class="thumbnail grid-thumb"
                                            src="<?php echo !empty($product['Product']['thumbnail']) ? $product['Product']['thumbnail'] : '/img/logo.png'; ?>">
                                       </a>
                                   </td>
                                   <td><?php echo h($product['Product']['sku']); ?></td>
                                   <td><?php echo h($product['Product']['name']); ?></td>
                                   <td><span
                                           class="price-text"><?php echo number_format(h($product['Product']['price']), 0, '.', ','); ?></span>
                                   </td>
                                   <td><span
                                           class="price-text"><?php echo number_format(h($product['Product']['source_price']), 0, '.', ','); ?></span>
                                   </td>
                                   <td><?php echo h($product['Product']['created']); ?></td>
                                   <td>
                                       <?php echo $this->Html->link($product['Creater']['name'],
                                           array('controller' => 'users', 'action' => 'view', $product['Creater']['id'])); ?>
                                   </td>
                                   <td><?php echo h($product['Product']['updated']); ?></td>
                                   <td>
                                       <?php echo $this->Html->link($product['Updater']['name'],
                                           array('controller' => 'users', 'action' => 'view', $product['Updater']['id'])); ?>
                                   </td>
                                   <td class="actions">
                                       <?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view', $product['Product']['id']), array('escape' => false, 'title' => 'Xem thông tin')); ?>
                                       <?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit', $product['Product']['id']), array('escape' => false, 'title' => 'Thay đổi thông tin')); ?>
                                       <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $product['Product']['id']), array('escape' => false, 'title' => 'Xoá'), __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?>
                                   </td>
                               </tr>
                           <?php endforeach; ?>
                           </tbody>
                       </table>
                   </div>
               </div>
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
                                echo $this->Paginator->prev(__('&laquo;'), array('tag' => 'li','escape'=>false), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a','escape'=>false));
                                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                                echo $this->Paginator->next(__('&raquo;'), array('tag' => 'li','currentClass' => 'disabled','escape'=>false), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a','escape'=>false));
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this html to your page -->
<div class="modal fade" id="img-view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-original-title="">×
                </button>
                <h4 class="modal-title">Hình ảnh</h4>
            </div>
            <div class="modal-body">
                <div class="widget-body">
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" data-original-title="">Đóng</button>
            </div>
        </div>
    </div>
</div>