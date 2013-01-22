<?php

namespace Fuel\Migrations;

class Create_softwares
{
	public function up()
	{
		\DBUtil::create_table('softwares', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'title' => array('constraint' => 255, 'type' => 'varchar'),
			'category_id' => array('constraint' => 11, 'type' => 'int'),
			'file' => array('constraint' => 255, 'type' => 'varchar'),
			'is_recommended' => array('constraint' => 1, 'type' => 'tinyint'),
			'img' => array('constraint' => 255, 'type' => 'varchar'),
			'summary' => array('type' => 'text'),
                        'click_num' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('softwares');
	}
}