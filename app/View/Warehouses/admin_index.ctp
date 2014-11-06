<table class="table table-condensedtable-hover no-margin">
    <thead>
    <tr>
        <th><?php echo $this->Paginator->sort('id'); ?></th>
        <th><?php echo $this->Paginator->sort('store_id'); ?></th>
        <th><?php echo $this->Paginator->sort('product_id'); ?></th>
        <th><?php echo $this->Paginator->sort('qty','Số lượng'); ?></th>
        <th><?php echo $this->Paginator->sort('options'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($warehouses as $warehouse): ?>
        <tr>
            <td><?php echo h($warehouse['Warehouse']['id']); ?>&nbsp;</td>
            <td>
                <?php echo $this->Html->link($warehouse['Store']['name'], array('controller' => 'stores', 'action' => 'view', $warehouse['Store']['id'])); ?>
            </td>
            <td>
                <?php echo $this->Html->link($warehouse['Product']['name'], array('controller' => 'products', 'action' => 'view', $warehouse['Product']['id'])); ?>
            </td>
            <td><?php echo h($warehouse['Warehouse']['qty']); ?>&nbsp;</td>
            <td><?php
                $arrayOP = explode(',', $warehouse['Warehouse']['options']);
                foreach ($arrayOP as $item) {
                    echo $options[$item] . ', ';
                }
                ?>
            </td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
    ));
    ?>    </p>
<div class="paging">
    <?php
    echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
