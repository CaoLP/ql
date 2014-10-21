<?php
$this->set('showActions', false);
$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb('Attachments (elFinder)', array('controller' => 'el_finder', 'action' => 'index'));
?>

<script type="text/javascript" charset="utf-8">
	$().ready(function() {
		var elf = $('#elfinder').elfinder({
			url : '<?php echo $this->Html->url(array('plugin'=>'el_finder','controller'=>'el_finder','action'=>'connector')) ?>'  // connector URL (REQUIRED)
		}).elfinder('instance');			
	});
</script>

<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>