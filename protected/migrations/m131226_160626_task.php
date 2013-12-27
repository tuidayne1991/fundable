<?php

class m131226_160626_task extends CDbMigration
{
	public function up(){
		$this->execute('ALTER TABLE `task` ADD `deadline` TIMESTAMP NOT NULL;
			ALTER TABLE `task` ADD `created_at` TIMESTAMP NOT NULL;');
	}

	public function down()
	{
		echo "m131226_160626_task does not support migration down.\n";
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