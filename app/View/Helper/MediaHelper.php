<?php
class MediaHelper extends AppHelper
{

    public $helpers = array('Html', 'Form');
    public $javascript = false;
    public $explorer = false;

    public function tinymce($field, $options = array())
    {
        $this->Html->script('/js/tinymce/tiny_mce.js', array('inline' => false));
        return $this->textarea($field, 'tinymce', $options);
    }

    public function textarea($field, $editor = false, $options = array())
    {
        $options = array_merge(array('label' => false, 'style' => 'width:100%;height:500px', 'row' => 160, 'type' => 'textarea', 'class' => "wysiwyg $editor"), $options);
        $html = $this->Form->input($field, $options);
        $models = $this->Form->_models;
        $model = key($models);
        if (isset($this->request->data[$model]['id']) && !$this->explorer) {
            $html .= '<input type="hidden" id="explorer" value="' . $this->Html->url(array('controller'=>'medias','action'=>'index',$model,$this->request->data[$model]['id'])) . '">';
            $this->explorer = true;
        }
        return $html;
    }

    public function ckeditor($field, $options = array())
    {
        $model = $this->Form->_models;
        $model = key($model);
        $this->Html->script('/js/ckeditor/ckeditor.js', array('inline' => false));
        return $this->textarea($field, 'ckeditor', $options);
    }

    public function redactor($field, $options = array())
    {
        $model = $this->Form->_models;
        $model = key($model);
        $this->Html->script('/js/redactor/redactor.min.js', array('inline' => false));
        $this->Html->css('/js/redactor/redactor.css', null, array('inline' => false));
        return $this->textarea($field, 'redactor', $options);
    }

    public function iframe($ref, $ref_id)
    {
        return '<iframe src="' . $this->Html->url("/medias/index/$ref/$ref_id") . '" style="width:100%;border:1px solid;padding-right:10px;" id="medias-' . $ref . '-' . $ref_id . '"></iframe>';
    }
    /**
     * Generate an image with a specific size
     * @param  string   $image   Path of the image (from the webroot directory)
     * @param  int      $width
     * @param  int      $height
     * @param  array    $options Options (same that HtmlHelper::image)
     * @param  int      $quality
     * @return string   <img> tag
     */
    public function image($image, $width, $height, $options = array(), $quality = 100){
        $options['width'] = $width;
        $options['height'] = $height;
        return $this->Html->image($this->resizedUrl($image, $width, $height, $quality), $options);
    }
    /**
     * Create an image with a specific size
     * @param  string   $file   Path of the image (from the webroot directory)
     * @param  int      $width
     * @param  int      $height
     * @param  array    $options Options (same that HtmlHelper::image)
     * @param  int      $quality
     * @return string   image path
     */
    public function resizedUrl($file, $width, $height, $quality = 100){
        # We define the image dir include Theme support
        $imageDir = (!isset($this->theme)) ? IMAGES : APP.'View'.DS.'Themed'.DS.$this->theme.DS.'webroot'.DS;
        $imageDir = str_replace('img/','',$imageDir);
        # We find the right file
        $pathinfo   = pathinfo(trim($file, '/'));
        $file       = $imageDir . trim($file, '/');
        $output     = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '_' . $width . 'x' . $height . '.' . $pathinfo['extension'];
        if (!file_exists($imageDir . $output)) {
            # Setting defaults and meta

            $info  = getimagesize($file);
            list($width_old, $height_old) = $info;
            # Create image ressource
            switch ( $info[2] ) {
                case IMAGETYPE_GIF:   $image = imagecreatefromgif($file);   break;
                case IMAGETYPE_JPEG:  $image = imagecreatefromjpeg($file);  break;
                case IMAGETYPE_PNG:   $image = imagecreatefrompng($file);   break;
                default: return false;
            }
            # We find the right ratio to resize the image before cropping
            $heightRatio = $height_old / $height;
            $widthRatio  = $width_old /  $width;
            $optimalRatio = $widthRatio;
            if ($heightRatio < $widthRatio) {
                $optimalRatio = $heightRatio;
            }
            $height_crop = ($height_old / $optimalRatio);
            $width_crop  = ($width_old  / $optimalRatio);
            # The two image ressources needed (image resized with the good aspect ratio, and the one with the exact good dimensions)
            $image_crop = imagecreatetruecolor( $width_crop, $height_crop );
            $image_resized = imagecreatetruecolor($width, $height);
            # This is the resizing/resampling/transparency-preserving magic
            if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
                $transparency = imagecolortransparent($image);
                if ($transparency >= 0) {
                    $transparent_color  = imagecolorsforindex($image, $trnprt_indx);
                    $transparency       = imagecolorallocate($image_crop, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                    imagefill($image_crop, 0, 0, $transparency);
                    imagecolortransparent($image_crop, $transparency);
                    imagefill($image_resized, 0, 0, $transparency);
                    imagecolortransparent($image_resized, $transparency);
                }elseif ($info[2] == IMAGETYPE_PNG) {
                    imagealphablending($image_crop, false);
                    imagealphablending($image_resized, false);
                    $color = imagecolorallocatealpha($image_crop, 0, 0, 0, 127);
                    imagefill($image_crop, 0, 0, $color);
                    imagesavealpha($image_crop, true);
                    imagefill($image_resized, 0, 0, $color);
                    imagesavealpha($image_resized, true);
                }
            }
            imagecopyresampled($image_crop, $image, 0, 0, 0, 0, $width_crop, $height_crop, $width_old, $height_old);
            imagecopyresampled($image_resized, $image_crop, 0, 0, ($width_crop - $width) / 2, ($height_crop - $height) / 2, $width, $height, $width, $height);
            # Writing image according to type to the output destination and image quality
            switch ( $info[2] ) {
                case IMAGETYPE_GIF:   imagegif($image_resized, $imageDir . $output, $quality);    break;
                case IMAGETYPE_JPEG:  imagejpeg($image_resized, $imageDir . $output, $quality);   break;
                case IMAGETYPE_PNG:   imagepng($image_resized, $imageDir . $output, 9);    break;
                default: return false;
            }
        }
        $output = str_replace('img/','',$output);
        return $output;
    }
}
