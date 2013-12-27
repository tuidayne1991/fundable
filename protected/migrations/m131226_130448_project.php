<?php

class m131226_130448_project extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE  `project` CHANGE  `group_id`  `team_id` INT( 11 ) NOT NULL ;');
	}

	public function down()
	{
		echo "m131226_130448_project does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}
;
	public function safeDown()
	{
	}
	*/
}