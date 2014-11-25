<?php
    $info = $this->viewVars['acos_details'][$data['Aco']['id']];
    $return = "<span title=\"{$info['description']}\">";

    if (!$hasChildren && $depth >= 2) {
        $return .= "<a href=\"javascript:;;\" onclick=\"acos.edit('{$this->Html->url(array('admin'=>true,'controller'=>'user_permissions','action'=>'edit'))}','{$data['Aco']['id']}'); return false;\">{$info['name']}</a>";
        //$return .= "&nbsp;&nbsp;".$this->Html->image('/acl_management/img/icons/user.png', array('style'=>'display:none'));
    }else{
        $return .= $info['name'];
    }
    $return .= "</span>";
    $return .= '<div id="aco-edit'.$data['Aco']['id'].'"></div>';
    echo $return;
?>
