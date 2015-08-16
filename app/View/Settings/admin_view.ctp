<div class="panel-heading">
    <h3 class="panel-title">
        <a href="javascript:void(0);" class="toggle-sidebar">
            <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>
        <?php echo __('Setting'); ?>    </h3>
</div>
<div class="panel-body">
    <div class="col-md-12">
        <ul class="nav nav-pills nav-justified">
            		<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>'.__('Edit Setting'), array('action' => 'edit', $setting['Setting']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>'.__('Delete Setting'), array('action' => 'delete', $setting['Setting']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $setting['Setting']['id'])); ?> </li>
		<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>'.__('List Settings'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>'.__('New Setting'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>'.__('List Settings'), array('controller' => 'settings', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>'.__('New Parent Setting'), array('controller' => 'settings', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>'.__('List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>'.__('New Trackable Creator'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>'.__('List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>'.__('New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>

        </ul>
    </div>
    <div class="col-md-12">
        <table cellpadding="0" cellspacing="0" class="table table-striped">
            <tbody>
            <tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($setting['Setting']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Parent Setting'); ?></th>
		<td>
			<?php echo $this->Html->link($setting['ParentSetting']['name'], array('controller' => 'settings', 'action' => 'view', $setting['ParentSetting']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Lft'); ?></th>
		<td>
			<?php echo h($setting['Setting']['lft']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Rght'); ?></th>
		<td>
			<?php echo h($setting['Setting']['rght']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($setting['Setting']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Descriptions'); ?></th>
		<td>
			<?php echo h($setting['Setting']['descriptions']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Excerpt'); ?></th>
		<td>
			<?php echo h($setting['Setting']['excerpt']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Images'); ?></th>
		<td>
			<?php echo h($setting['Setting']['images']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($setting['Setting']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Trackable Creator'); ?></th>
		<td>
			<?php echo $this->Html->link($setting['TrackableCreator']['name'], array('controller' => 'users', 'action' => 'view', $setting['TrackableCreator']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Updated'); ?></th>
		<td>
			<?php echo h($setting['Setting']['updated']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Trackable Updater'); ?></th>
		<td>
			<?php echo $this->Html->link($setting['TrackableUpdater']['name'], array('controller' => 'users', 'action' => 'view', $setting['TrackableUpdater']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($setting['Setting']['status']); ?>
			&nbsp;
		</td>
</tr>
            </tbody>
        </table>

    </div>

            <div class="related row">
            <div class="col-md-12">
                <h3><?php echo __('Related Settings'); ?></h3>
                <?php if (!empty($setting['ChildSetting'])): ?>
                <table cellpadding = "0" cellspacing = "0" class="table table-striped">
                    <thead>
                    <tr>
                        		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Lft'); ?></th>
		<th><?php echo __('Rght'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Descriptions'); ?></th>
		<th><?php echo __('Excerpt'); ?></th>
		<th><?php echo __('Images'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Updated By'); ?></th>
		<th><?php echo __('Status'); ?></th>
                        <th class="actions"></th>
                    </tr>
                    <thead>
                    <tbody>
                    	<?php foreach ($setting['ChildSetting'] as $childSetting): ?>
		<tr>
			<td><?php echo $childSetting['id']; ?></td>
			<td><?php echo $childSetting['parent_id']; ?></td>
			<td><?php echo $childSetting['lft']; ?></td>
			<td><?php echo $childSetting['rght']; ?></td>
			<td><?php echo $childSetting['name']; ?></td>
			<td><?php echo $childSetting['descriptions']; ?></td>
			<td><?php echo $childSetting['excerpt']; ?></td>
			<td><?php echo $childSetting['images']; ?></td>
			<td><?php echo $childSetting['created']; ?></td>
			<td><?php echo $childSetting['created_by']; ?></td>
			<td><?php echo $childSetting['updated']; ?></td>
			<td><?php echo $childSetting['updated_by']; ?></td>
			<td><?php echo $childSetting['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('controller' => 'settings', 'action' => 'view', $childSetting['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('controller' => 'settings', 'action' => 'edit', $childSetting['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('controller' => 'settings', 'action' => 'delete', $childSetting['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $childSetting['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>

                <div class="actions">
                    <?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>'.__('New Child Setting'), array('controller' => 'settings', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?>                </div>
            </div><!-- end col md 12 -->
        </div>
            <div class="related row">
            <div class="col-md-12">
                <h3><?php echo __('Related Products'); ?></h3>
                <?php if (!empty($setting['Product'])): ?>
                <table cellpadding = "0" cellspacing = "0" class="table table-striped">
                    <thead>
                    <tr>
                        		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Sku'); ?></th>
		<th><?php echo __('Provider Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Retail Price'); ?></th>
		<th><?php echo __('Source Price'); ?></th>
		<th><?php echo __('Excert'); ?></th>
		<th><?php echo __('Descriptions'); ?></th>
		<th><?php echo __('Thumbnail'); ?></th>
		<th><?php echo __('Images'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Updated By'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Setting Id'); ?></th>
                        <th class="actions"></th>
                    </tr>
                    <thead>
                    <tbody>
                    	<?php foreach ($setting['Product'] as $product): ?>
		<tr>
			<td><?php echo $product['id']; ?></td>
			<td><?php echo $product['sku']; ?></td>
			<td><?php echo $product['provider_id']; ?></td>
			<td><?php echo $product['name']; ?></td>
			<td><?php echo $product['price']; ?></td>
			<td><?php echo $product['retail_price']; ?></td>
			<td><?php echo $product['source_price']; ?></td>
			<td><?php echo $product['excert']; ?></td>
			<td><?php echo $product['descriptions']; ?></td>
			<td><?php echo $product['thumbnail']; ?></td>
			<td><?php echo $product['images']; ?></td>
			<td><?php echo $product['created']; ?></td>
			<td><?php echo $product['created_by']; ?></td>
			<td><?php echo $product['updated']; ?></td>
			<td><?php echo $product['updated_by']; ?></td>
			<td><?php echo $product['status']; ?></td>
			<td><?php echo $product['setting_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('controller' => 'products', 'action' => 'view', $product['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('controller' => 'products', 'action' => 'edit', $product['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('controller' => 'products', 'action' => 'delete', $product['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $product['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>

                <div class="actions">
                    <?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>'.__('New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?>                </div>
            </div><!-- end col md 12 -->
        </div>
    
</div>

