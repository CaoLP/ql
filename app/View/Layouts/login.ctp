<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset (); ?>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <?php
    echo $this->Html->meta ('icon');

    echo $this->Html->script(array(
        'html5-trunk'
    ));

    echo $this->Html->css (array (
        'style',
        'bootstrap',
        'main',
    ));
    echo $this->fetch ('meta');
    echo $this->fetch ('css');
    echo $this->fetch ('script');
    ?>
</head>
<body>
<!-- Main Container start -->
<div class="main-container">
    <?php echo $this->fetch('content'); ?>
</div>
<!-- Main Container end -->

</body>
</html>