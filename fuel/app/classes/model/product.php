<?php
class Model_Product extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'title',
		'category_id',
		'price',
		'is_recommended' => array(
			'default' => 0,		
		),
		'click_num' => array(
			'default' => 0,	
		),
		'img',
		'summary',
		'created_at',
		'updated_at',
	);
	
	protected static $_belongs_to = array(
		'category' => array(
			'key_from' => 'category_id',
			'model_to' => 'Model_Category',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),		
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
		$val->add_field('title', '标题', 'required|max_length[255]');
		$val->add_field('category_id', '分类', 'required|valid_string[numeric]');
		$val->add_field('price', '价格', 'required');
		//$val->add_field('is_recommended', 'Is Recommended', 'required');
		//$val->add_field('click_num', 'Click Num', 'required|valid_string[numeric]');
		//$val->add_field('img', 'Img', 'required|max_length[255]');
		$val->add_field('summary', '内容', 'required');

		return $val;
	}

}
