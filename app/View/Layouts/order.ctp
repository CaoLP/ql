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
        'order_new',
        '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css',
    ));
    echo $this->fetch('meta');
    echo $this->fetch('css');
    ?>
    <?php
    echo $this->Html->script(array(
        '//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js',
        'bootstrap',
        '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js',
        'tiny-scrollbar',
        'admin',
        'bootstrap-modalmanager',
        'bootstrap-modal',
    ));
    echo $this->fetch('script');
    ?>
    <?php echo $this->fetch('scriptBottom'); ?>
</head>
<body>
<header>
    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div id="navbar" class="">
                <ul class="nav navbar-nav">
                    <li style="width: 440px;">
                        <div class="navbar-form navbar-left" role="search" style="width: 100%">
                            <div class="input-group" style="width: 100%">
                                <input type="text" class="form-control" id="p-search" placeholder="Tìm mặt hàng và khách hàng (F2)">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tìm theo mã<span class="caret"></span></button>
<!--                                    <ul class="dropdown-menu dropdown-menu-right">-->
<!--                                        <li><a href="#">Theo mã hàng</a></li>-->
<!--                                        <li><a href="#">Theo mã và tên</a></li>-->
<!--                                    </ul>-->
                                </div><!-- /btn-group -->
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="javascript:;"><i class="icon icon-question"></i></a></li>
                    <li></li>
                    <li></li>
                    <li>
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon icon-menu-2"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="<?php echo $this->Html->url(array(
                                    'admin' => true,
                                    'controller' => 'dashboard',
                                    'action' => 'index'
                                ));?>">Quay về Dashboard</a></li>
                        </ul>
                    </li>
                    <li></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
</header>
<div class="main-container">
    <!-- Dashboard wrapper start -->
    <div class="dashboard-wrapper container-fluid">
        <div class="col-md-12">
            <?php echo $this->Session->flash(); ?>
        </div>
        <?php echo $this->fetch('content'); ?>
    </div>
</div>
<!-- Main Container end -->
<footer>
    <?php echo $this->element('footer') ?>
</footer>
</body>
</html>
