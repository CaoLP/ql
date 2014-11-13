<?php
echo $this->Form->input('ProductOption.option_id', array(
    'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
    'label' => array('text' => 'Thuộc tính', 'class' => 'col-lg-2 control-label'),
    'type' => 'select',
    'multiple' => 'checkbox',
    'options' => $options,
    'div' => array('class' => 'form-group'),
    'between' => '<div class="col-lg-10 p-t-7">',
    'after' => '</div>',
    'class' => 'checkbox col-lg-2',
    'error' => array(
        'attributes' => array(
            '					wrap' => 'span', 'class' => 'help-inline'
        )
    )
));
//endforeach;
?>