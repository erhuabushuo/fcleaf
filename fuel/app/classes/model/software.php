<?php
class Model_Software extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'title',
		'category_id',
		'file',
		'is_recommended',
		'img',
		'summary',
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

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('title', 'Title', 'required|max_length[255]');
		$val->add_field('category_id', 'Category Id', 'required|valid_string[numeric]');
		$val->add_field('file', 'File', 'required|max_length[255]');
		$val->add_field('is_recommended', 'Is Recommended', 'required');
		$val->add_field('img', 'Img', 'required|max_length[255]');
		$val->add_field('summary', 'Summary', 'required');

		return $val;
	}

}
