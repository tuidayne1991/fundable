<?php

class m131228_122147_task extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE `task` ADD `status` BOOLEAN NOT NULL DEFAULT FALSE AFTER `progress` ;
ALTER TABLE `task` ADD `start_time` DATETIME NOT NULL AFTER `status` ;
ALTER TABLE `task` ADD `end_time` DATETIME NOT NULL AFTER `start_time` ;
ALTER TABLE `task` ADD `duration` BIGINT NOT NULL AFTER `end_time` ;');
	}

	public function down()
	{
		echo "m131228_122147_task does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}