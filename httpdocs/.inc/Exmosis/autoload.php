<?php

namespace Exmosis;

spl_autoload_register(function($class) {
	$class = preg_replace('/^' . __NAMESPACE__ . '\\\/', '', $class);
	$file = dirname(__FILE__) . DIRECTORY_SEPARATOR . $class . '.php';
	$file = preg_replace('/\\\\/', DIRECTORY_SEPARATOR, $file);
	require($file);
});

