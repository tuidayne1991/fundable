<?php

class m131229_175534_task extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE  `task` ADD  `task_code` INT NOT NULL AFTER  `id` ;
			ALTER TABLE  `task` ADD  `type` VARCHAR( 100 ) NOT NULL DEFAULT  "user" COMMENT  "include 2 type: user and team" AFTER  `description` ;');
	}

	public function down()
	{
		echo "m131229_175534_task does not support migration down.\n";
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