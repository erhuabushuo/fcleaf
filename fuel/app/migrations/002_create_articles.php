<?php

namespace Fuel\Migrations;

class Create_articles
{
	public function up()
	{
		\DBUtil::create_table('articles', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'category_id' => array('constraint' => 11, 'type' => 'int'),
			'title' => array('constraint' => 255, 'type' => 'varchar'),
			'summary' => array('type' => 'text'),
			'clicked_num' => array('constraint' => 11, 'type' => 'int', 'default' => 0),
			'is_recommended' => array('type' => 'boolean', 'default' => false),
			'img' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'), false, 'InnoDB', 'utf8_unicode_ci', array(
			array(
				array(
					'key' => 'category_id',
					'reference' => array(
						'table' => 'categories',
						'column' => 'id',		
					),		
					'on_update' => 'CASCADE',
					'on_delete' => 'RESTRICT'
				)		
			)	
		));
	}

	public function down()
	{
		\DBUtil::drop_table('articles');
	}
}