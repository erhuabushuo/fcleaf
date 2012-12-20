<?php

class Model_Category extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'pid',
		'type',
		'title',
		'struct',
		'order',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);
	
	public static $_types = array(
		'文章',
		'产品',		
		'软件',
	);
	
	public static function getAllCategories($type = 0)
	{
		$sql = "SELECT `id`, `title`, `pid`, `order`, `type`, 
				concat(`struct`, '-', `id`) as `structs` , `created_at`, `updated_at`
				FROM `categories` where type=:type order by `structs` asc, `order` asc";
		$result = DB::query($sql)->bind('type', $type)->execute();
		return $result;
	}
	
	public static function getAll()
	{
		$sql = "SELECT `id`, `title`, `pid`, `order`, `type`,
		concat(`struct`, '-', `id`) as `structs` , `created_at`, `updated_at`
		FROM `categories` order by `structs` asc, `order` asc";
		$result = DB::query($sql)->execute();
		return $result;
	}
	
	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('title', 'Title', 'required|max_length[255]');
		$val->add_field('type', 'Type', 'required');
		$val->add_field('pid', 'Parent Category', 'required');
		return $val;
	}
}
