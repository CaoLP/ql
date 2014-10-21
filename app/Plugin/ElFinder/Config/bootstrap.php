<?php
CroogoNav::add('media.children.el_finder', array(
	'title' => __d('croogo', 'ElFinder'),
	'url' => array(
		'admin' => true,
		'plugin' => 'el_finder',
		'controller' => 'el_finder',
		'action' => 'index',
	),
));

Croogo::hookHelper('*', 'ElFinder.ElFinder');
