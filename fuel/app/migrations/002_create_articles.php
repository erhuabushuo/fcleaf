<?php

namespace Fuel\Migrations;

class Create_articles
{
	public function up()
	{
		\DBUtil::create_table('articles', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'title' => array('constraint' => 255, 'type' => 'varchar'),
			'summary' => array('type' => 'text'),
			'clicked_num' => array('constraint' => 11, 'type' => 'int'),
			'is_recommmended' => array('type' => 'boolean'),
			'img' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('articles');
	}
}