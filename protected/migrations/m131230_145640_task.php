<?php

class m131230_145640_task extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE  `task` DROP FOREIGN KEY  `task_ibfk_2` ;');
	}

	public function down()
	{
		echo "m131230_145640_task does not support migration down.\n";
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