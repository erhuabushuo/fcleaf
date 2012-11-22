<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'type'			=> 'pdo',
		'connection'  => array(
			'dsn'        => 'mysql:host=localhost;dbname=fcleaf',
			'username'   => 'root',
			'password'   => '',
		),
                'profiling' => true,
	),
);
