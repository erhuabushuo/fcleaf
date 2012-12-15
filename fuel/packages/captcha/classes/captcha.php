<?php

/*
 *  @package    Fuel
 *  @subpackage Packages
 *  @category   Captcha
 *  @auth       aidan <erhuabushuo@gmail.com>
 */
namespace Captcha;

class Captcha
{
	public static function instance()
	{
		static $instance = null;
		if ($instance == null)
			$instance = new static;
		return $instance;
	}
	
	public static function _init()
	{
		\Config::load('captcha', true);
	}
	
	public function generate()
	{
		$session_name = \Config::get('captcha.session_name');
		$width = \Config::get('captcha.width');
		$height = \Config::get('captcha.height'); 
		$operator = \Config::get('captcha.operator');
		
		$code = array();
		$code[] = mt_rand(1, 9);
		$code[] = $operator{mt_rand(0, 2)};
		$code[] = mt_rand(1, 9);
		//$code[] = $operator{mt_rand(0, 2)};
		//$code[] = mt_rand(1, 9);
		$codestr = implode('', $code);
		eval("\$result = " . $codestr . ";");
		//$code[] = '=';
		
		\Session::set($session_name, $result);
		
		$img = imagecreate($width, $height);
		imagecolorallocate($img, mt_rand(230, 250), mt_rand(230, 250), mt_rand(230, 250));
		$color = imagecolorallocate($img, 0, 0, 0);
		
		$offset = 0;
		foreach ($code as $char)
		{
			$offset += 20;
			$txtColor = imagecolorallocate($img, mt_rand(0, 255), mt_rand(0, 150), mt_rand(0, 255));
			imagechar($img, mt_rand(3, 5), $offset, mt_rand(1, 5), $char, $txtColor);
		}
		
		for ($i = 0; $i < 100; $i++)
		{
			$pxcolor = imagecolorallocate($img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
			imagesetpixel($img, mt_rand(0, $width), mt_rand(0, $height), $pxcolor);
		}
		
		header('Content-type: image/png');
		imagepng($img);
	}
}