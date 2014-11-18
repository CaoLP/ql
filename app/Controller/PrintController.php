<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class PrintController extends AppController
{
    public $layout = 'print';

    public function admin_fillwarehouse($id = null)
    {
        $this->loadModel('InoutWarehouse');
        $data = $this->InoutWarehouse->find('first',
            array(
                'conditions' => array(
                    'InoutWarehouse.id' => $id
                )
            )
        );
        $this->set(compact('data'));
    }

    public function admin_transferwarehouse($id = null)
    {
        $this->loadModel('InoutWarehouse');
        $data = $this->InoutWarehouse->find('first',
            array(
                'conditions' => array(
                    'InoutWarehouse.id' => $id
                )
            )
        );
        $this->set(compact('data'));
    }

    public function admin_checkwarehouse()
    {

    }

    public function admin_paymentvoucher()
    {

    }

    public function admin_receivevoucher()
    {

    }
}