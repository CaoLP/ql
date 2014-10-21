
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>elFinder 2.0</title>
<?php
echo $this->Html->css(
	array(
		 '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css',
		 '/ElFinder/elfinder/css/elfinder.min',
		 '/ElFinder/elfinder/css/theme'
	)
);
echo $this->Html->script(
	array(
		 '//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js',
		 '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js',
		 '/ElFinder/elfinder/js/elfinder.min',
	)
);

?>
	<!-- elFinder initialization (REQUIRED) -->
	<script type="text/javascript" charset="utf-8">
		$().ready(function() {
			var elf = $('#elfinder').elfinder({
				url : 'http://' + window.location.host + '/el_finder/el_finder/connector',  // connector URL (REQUIRED)
				resizable:false
			}).elfinder('instance');
		});
	</script>
</head>
<body>

<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>

</body>
</html>
