<?php

namespace Fuel\Migrations;

class Create_products
{
	public function up()
	{
		\DBUtil::create_table('products', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'title' => array('constraint' => 255, 'type' => 'varchar'),
			'category_id' => array('constraint' => 11, 'type' => 'int'),
			'price' => array('constraint' => '10,2', 'type' => 'decimal'),
			'is_recommended' => array('constraint' => 1, 'type' => 'tinyint'),
			'click_num' => array('constraint' => 11, 'type' => 'int'),
			'img' => array('constraint' => 255, 'type' => 'varchar'),
			'summary' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('products');
	}
}