<a href="javascript:;;"
   onclick="admin.toggle('<?php echo $this->Html->url(
       array(
           'admin' => true,
           'controller' => 'customer_promotes',
           'action' => 'toggle',
           $id,
           $tog,
       )
   );?>',<?php echo $id; ?>);return false;">
    <?php echo $this->Html->image('/img/icons/allow-' . $tog . '.png'); ?>
</a>