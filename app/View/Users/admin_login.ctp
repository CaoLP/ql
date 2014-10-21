<div class="row">
    <?php echo $this->Form->create('User', array('class'=>'login-wrapper')); ?>
        <div class="header">
            <div class="row">
                <div class="col-md-12">
                    <h3>Đăng nhập<img src="/img/logo.png" alt="Logo" class="pull-right"></h3>
                    <p>Điền thông tin đăng nhập bên dưới</p>
                    <?php
                    echo $this->Session->flash();
                    ?>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <?php echo $this->Form->input('username',array(
                        'class'=>'input col-md-12 col-sm-12',
                        'placeholder'=>'Tên đăng nhập',
                        'required'=>'required',
                        'label'=>false,
                        'div'=>false
                    ));?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <?php echo $this->Form->input('password',array(
                        'class'=>'input col-md-12 col-sm-12',
                        'placeholder'=>'********',
                        'required'=>'required',
                        'label'=>false,
                        'div'=>false
                    ));?>
                </div>
            </div>
        </div>
        <div class="actions">
            <?php echo $this->Form->button('Login',array('class'=>'btn btn-danger'))?>
            <a class="link" href="<?php echo $this->Html->url(array('admin'=>true,'controller'=>'users','action'=>'register'))?>">Đăng ký mới</a>
            <div class="clearfix"></div>
        </div>
        <?php echo $this->Form->end(); ?>
</div>
