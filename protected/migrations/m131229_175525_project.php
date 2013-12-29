<?php

class m131229_175525_project extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE  `project` ADD  `no_task` INT NOT NULL DEFAULT  0 AFTER  `funding_status` ;');
	}

	public function down()
	{
		echo "m131229_175525_project does not support migration down.\n";
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