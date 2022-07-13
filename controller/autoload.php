<?php
session_start();
/**
* An example of a project-specific implementation.
*
* After registering this autoload function with SPL, the following line
* would cause the function to attempt to load the \Foo\Bar\Baz\Qux class
* from /path/to/project/src/Baz/Qux.php:
*
* new \Foo\Bar\Baz\Qux;
*
* @param string $class The fully qualified class name.
* @return void
*/

spl_autoload_register(function($class) {
	// project-specific namespace prefix
	$prefix = 'model/';
	$prefix2 = '../model/';
	// base directory for the namespace prefix
	$base_dir = '';
	// get the relative class name
	//$relative_class = substr($class, $len);
	// replace the namespace prefix with the base directory, replace namespace
	// separators with directory separators in the relative class name, append
	// with .php
	$file = $base_dir.$prefix.str_replace('\\', '/', $class) . '.php';
	// if the file exists, require it
	$file2 = $base_dir.$prefix2.str_replace('\\', '/', $class) . '.php';
	if (file_exists($file)) {
		require $file;
	}elseif(file_exists($file2)){
		require $file2;
	}
});
/**
function __autoload($class){
	include_once("model/{$class}.php") ;
}
*/
?>