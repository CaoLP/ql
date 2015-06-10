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
                <h3>Thông báo</h3>
            </div>
            <div class="widget-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-condensedtable-hover no-margin table-product">
                            <thead>
                            <tr>
                                <th class="header"><?php echo $this->Paginator->sort('id'); ?></th>
                                <th class="header"><?php echo $this->Paginator->sort('title'); ?></th>
                                <th class="header"><?php echo $this->Paginator->sort('created'); ?></th>
                                <th class="actions"><?php echo __('Actions'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($posts as $post): ?>
                                <tr>
                                    <td><?php echo h($post['Post']['id']); ?>&nbsp;</td>
                                    <td><?php echo h($post['Post']['title']); ?>&nbsp;</td>
                                    <td><?php echo h($post['Post']['created']); ?>&nbsp;</td>
                                    <td class="actions">
                                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i>', array('action' => 'view', $post['Post']['id']), array('escape' => false, 'title' => 'Xem thông tin')); ?>
                                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i>', array('action' => 'edit', $post['Post']['id']), array('escape' => false, 'title' => 'Thay đổi thông tin')); ?>
                                        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $post['Post']['id']), array('escape' => false, 'title' => 'Xoá'), __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?>
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