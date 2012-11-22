<?php 

/*
 * Captcha Package
 * 
 * @package Captcha
 * @version 1.0
 */

Autoloader::add_core_namespace('Captcha');

Autoloader::add_classes(array(
	'Captcha\\Captcha' => __DIR__ . '/classes/captcha.php'		
));