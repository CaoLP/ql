<?php
App::uses('AppController','Controller');
class MediasController extends AppController{

    public $order = array('Media.position ASC');

    public function isAuthorized($user = null){
        return true;
    }

    public function canUploadMedias($ref, $ref_id){
        if(method_exists('AppController', 'canUploadMedias')){
            return parent::canUploadMedias($ref, $ref_id);
        }else{
            return false;
        }
    }

    public function beforeFilter(){
        parent::beforeFilter();
        $this->layout = 'uploader';
        if(in_array('Security', $this->components)){
            $this->Security->unlockedActions = array('upload', 'order','index','delete','thumb');
        }
    }

    /**
    * Liste les médias
    **/
    public function admin_index($ref,$ref_id){

        if(!$this->canUploadMedias($ref, $ref_id)){
            throw new ForbiddenException();
        }
        $this->loadModel($ref);
        $this->set(compact('ref', 'ref_id'));
        if(!in_array('Media', $this->$ref->Behaviors->loaded())){
            return $this->render('admin_nobehavior');
        }
        $id = isset($this->request->query['id']) ? $this->request->query['id'] : false;
        $medias = $this->Media->find('all',array(
            'conditions' => array('ref_id' => $ref_id,'ref' => $ref)
        ));
        $thumbID = false;
        if($this->$ref->hasField('media_id')){
            $this->$ref->id = $ref_id;
            $thumbID = $this->$ref->field('media_id');
        }
        $extensions = $this->$ref->medias['extensions'];
        $editor = isset($this->request->params['named']['editor']) ? $this->request->params['named']['editor'] : false;
        $this->set(compact('id', 'medias', 'thumbID', 'editor', 'extensions'));
    }
    public function admin_fast_import($ref = 'Product'){
        $this->layout = 'media';
//        if(!$this->canUploadMedias($ref, $ref_id)){
//            throw new ForbiddenException();
//        }
        $this->loadModel($ref);
        $ref_id = -1;
        $this->set(compact('ref', 'ref_id'));
        if(!in_array('Media', $this->$ref->Behaviors->loaded())){
            return $this->render('admin_nobehavior');
        }
        $id = isset($this->request->query['id']) ? $this->request->query['id'] : false;
        $medias = $this->Media->find('all',array(
            'conditions' => array('ref_id' => $ref_id,'ref' => $ref)
        ));
        $thumbID = false;
        if($this->$ref->hasField('media_id')){
            $this->$ref->id = $ref_id;
            $thumbID = $this->$ref->field('media_id');
        }
        $extensions = $this->$ref->medias['extensions'];
        $editor = isset($this->request->params['named']['editor']) ? $this->request->params['named']['editor'] : false;
        $this->set(compact('id', 'medias', 'thumbID', 'editor', 'extensions'));
    }

    public function admin_update_media($ref = 'Product')
    {
        if ($this->request->is('ajax')) {
            if (!empty($this->request->data['id']) && count($this->request->data['media_id']) > 0) {
                $saveData = array();
                foreach ($this->request->data['media_id'] as $media) {
                    $saveData[] = array(
                        'id' => $media,
                        'ref_id' => $this->request->data['id'],
                    );
                }
                $this->Media->saveMany($saveData);
                $this->loadModel($ref);
                $product = $this->$ref->find('first', array('conditions' => array('Product.id' => $this->request->data['id']), 'recursive' => -1));
                if (empty($product['Product']['media_id'])) {
                    $this->$ref->save(array(
                        'id' => $this->request->data['id'],
                        'media_id' => $this->request->data['media_id'][0],
                    ));
                }
                echo 1;
            }else{
                echo 0;
            }
            die;
        }
    }
    /**
    * Upload (Ajax)
    **/
    public function admin_upload($ref,$ref_id,$mo = false){
        $this->autoRender = false;
        if(!$this->canUploadMedias($ref, $ref_id)){
            throw new ForbiddenException();
        }
        $media = $this->Media->save(array(
            'ref'    => $ref,
            'ref_id' => $ref_id,
            'file'   => $_FILES['file']
        ));
        if(!$media){
            echo json_encode(array('error' => $this->Media->error));
            return false;
        }
        $this->loadModel($ref);
        $media = $this->Media->read();
        $media = $media['Media'];
        $thumbID = $this->$ref->hasField('media_id');
        $editor = isset($this->request->params['named']['editor']) ? $this->request->params['named']['editor'] : false;
        $id = isset($this->request->query['id']) ? $this->request->query['id'] : false;
        $this->set(compact('media', 'thumbID', 'editor', 'id'));
        $this->layout = 'json';
        if($mo)
        $this->render('admin_media2');
        else
        $this->render('admin_media');
        return true;
    }

    /**
    * Suppression (Ajax)
    **/
    public function admin_delete($id){
        $this->autoRender = false;
        $media = $this->Media->findById($id, array('ref','ref_id'));
        if(empty($media)){
            throw new NotFoundException();
        }
        if(!$this->canUploadMedias($media['Media']['ref'], $media['Media']['ref_id'])){
            throw new ForbiddenException();
        }
        $this->Media->delete($id);
        return true;
    }

    /**
    * Met l'image à la une
    **/
    public function admin_thumb($id){
        $this->Media->id = $id;
        $media = $this->Media->findById($id, array('ref','ref_id'));
        if(empty($media)){
            throw new NotFoundException();
        }
        if(!$this->canUploadMedias($media['Media']['ref'], $media['Media']['ref_id'])){
            throw new ForbiddenException();
        }
        $ref = $media['Media']['ref'];
        $ref_id = $media['Media']['ref_id'];
        $this->loadModel($ref);
        $this->$ref->id = $ref_id;
        $this->$ref->saveField('media_id',$id);
        $this->redirect(array('action' => 'index', $ref, $ref_id));
    }

    public function admin_order(){
        if(!empty($this->request->data['Media'])){
            $id = key($this->request->data['Media']);
            $media = $this->Media->findById($id, array('ref','ref_id'));
            if(!$this->canUploadMedias($media['Media']['ref'], $media['Media']['ref_id'])){
                throw new ForbiddenException();
            }
            foreach($this->request->data['Media'] as $k=>$v){
                $this->Media->id = $k;
                $this->Media->saveField('position',$v);
            }
        }
        die;
    }


}
