<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2012 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * If you want to override the default configuration, add the keys you
 * want to change here, and assign new values to them.
 */

return array(
		'profiling'  => false,
		'language'           => 'en', // Default language
		'language_fallback'  => 'en', // Fallback language when file isn't available for default language
		'locale'             => 'zh_CN.UTF-8', // PHP set_locale() setting, null to not set
		'server_gmt_offset'  => 8,
		'default_timezone'   => 'PRC',
		'always_load'  => array(
				'packages'  => array(
						'orm',
						'auth',
				),
		),
		'security' => array(
				'whitelisted_classes' => array(
						'Fuel\\Core\\Response',
						'Fuel\\Core\\View',
						'Fuel\\Core\\ViewModel',
						'Fuel\\Core\\Validation',
						'Closure',
				)				
		),
);
