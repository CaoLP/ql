<?php
App::uses('ComponentCollection', 'Controller');
App::uses('Component', 'Controller');
class MenuComponent extends Component
{
    public function  beforeRender(Controller $controller)
    {
        $isAdmin = !empty($controller->request->params['admin']);
        if ($isAdmin) {
            $group_id = CakeSession::read('Auth.User.group_id');

            if ($controller->name != 'AdminMenus')
                $controller->loadModel('AdminMenu');
            $admin_menu = $controller->AdminMenu->hasMany['ChildAdminMenu']['conditions'] = array('FIND_IN_SET(\'' . $group_id . '\',ChildAdminMenu.group_ids)');
            $admin_menu = $controller->AdminMenu->find('all', array(
                    'conditions' => array(
                        'FIND_IN_SET(\'' . $group_id . '\',AdminMenu.group_ids)',
                        'AdminMenu.parent_id' => ''
                    ),
                    'recursive' => 1,
                )
            );
            $controller->set(compact('admin_menu'));
        }
    }
}