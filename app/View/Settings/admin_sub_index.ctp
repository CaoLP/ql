<div class="panel-heading">
    <h3 class="panel-title">
        <a href="javascript:void(0);" class="toggle-sidebar">
            <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>
        <?php echo $title_for_layout; ?>    </h3>
</div>
<div class="panel-body">
    <div class="col-md-12">
        <ul class="nav nav-pills nav-justified">
            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>'.__('Thêm') .' ' . $title_for_layout, array('action' => 'add_sub', $key), array('escape' => false)); ?></li>
        </ul>
    </div>
    <div class="col-md-12">
        <?php echo $this->Session->flash(); ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('parent_id'); ?></th>
                <th><?php echo $this->Paginator->sort('name'); ?></th>
                <th><?php echo $this->Paginator->sort('key'); ?></th>
                <th class="actions"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($settings as $setting): ?>
                <tr>
                    <td><?php if ($setting['Thumb']['file']) echo $this->Media->image($setting['Thumb']['file'], 50, 50, array('class' => 'thumbnail'));?></td>
                    <td><?php echo h($setting['Setting']['id']); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Html->link($setting['ParentSetting']['name'], array('controller' => 'settings', 'action' => 'view', $setting['ParentSetting']['id'])); ?>
                    </td>
                    <td><?php echo h($setting['Setting']['name']); ?>&nbsp;</td>
                    <td><?php echo h($setting['Setting']['key']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php
                        if(empty($setting['ParentSetting']['parent_id']))
                            echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>', array('action' => 'index', $setting['Setting']['key']), array('escape' => false));
                        ?>
                        <?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'add_sub', $setting['Setting']['key'], 'edit', $key), array('escape' => false)); ?>
                        <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $setting['Setting']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $setting['Setting']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <p>
            <small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}'))); ?></small>
        </p>

        <?php
        $params = $this->Paginator->params();
        if ($params['pageCount'] > 1) {
            ?>
            <ul class="pagination pagination-sm">
                <?php
                echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev', 'tag' => 'li', 'escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'a'));
                echo $this->Paginator->next('Next &rarr;', array('class' => 'next', 'tag' => 'li', 'escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled', 'tag' => 'li', 'escape' => false));
                ?>
            </ul>
        <?php } ?>
    </div>
</div>

