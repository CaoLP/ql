
<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
setlocale(LC_MONETARY, "vi_VN");
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->script(array(
        'html5-trunk'
    ));

    echo $this->Html->css(array(
        'style',
        'bootstrap.min',
        'main',
        'bootstrap-modal',
        'custom.core',
        'media_custom'
    ));
    echo $this->fetch('meta');
    echo $this->fetch('css');
    ?>

</head>
<body>
<!-- Header start -->
<header>
    <?php echo $this->element('header') ?>
</header>
<!-- Header end -->

<!-- Main Container start -->
<div class="main-container">
    <!-- Dashboard wrapper start -->
    <div class="dashboard-wrapper">
        <div class="container">
            <?php echo $this->element('content_header') ?>
            <div class="row">
                <div class="col-md-12">
                    <?php echo $this->Session->flash(); ?>
                </div>
            </div>
            <?php echo $this->fetch('content'); ?>
        </div>
    </div>
    <!-- Dashboard wrapper end -->
</div>
<!-- Main Container end -->
<footer>
    <?php echo $this->element('footer') ?>
</footer>
<?php
echo $this->Html->script(array('//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js','//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js'));
echo $this->Html->script(array(
    'wysiwyg/wysihtml5-0.3.0',
    'bootstrap',
    'admin',
    'bootstrap-modalmanager',
    'bootstrap-modal',
));
echo $this->Html->script(array('media'));
echo $this->fetch('script');
?>
<?php echo $this->fetch('scriptBottom'); ?>
</body>
</html>
