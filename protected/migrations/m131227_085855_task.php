<?php

class m131227_085855_task extends CDbMigration
{
	public function up()
	{
		$this->execute('
ALTER TABLE  `task` ADD  `progress` INT NOT NULL AFTER  `deadline` ;
ALTER TABLE  `task` CHANGE  `progress`  `progress` INT( 11 ) NOT NULL DEFAULT 0;');
	}

	public function down()
	{
		echo "m131227_085855_task does not support migration down.\n";
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