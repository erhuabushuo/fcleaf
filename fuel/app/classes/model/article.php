<?php
class Model_Article extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'title',
		'summary',
		'clicked_num' => array(
                    'default' => 0,
                ),
		'is_recommmended' => array(
                    'default' => 0,
                ),
		'img',
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
		$val->add_field('summary', 'Summary', 'required');
		//$val->add_field('clicked_num', 'Clicked Num', 'required|valid_string[numeric]');
		//$val->add_field('is_recommmended', 'Is Recommmended', 'required');
		$val->add_field('img', 'Img', 'required|max_length[255]');

		return $val;
	}

}
