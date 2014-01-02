<?php

class m140102_095117_team extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE  `team` ADD  `is_verified` BOOLEAN NOT NULL DEFAULT FALSE AFTER  `description` ;');
	}

	public function down()
	{
		echo "m140102_095117_team does not support migration down.\n";
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