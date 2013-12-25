<?php

class m131225_094902_AuthAssignment extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE `AuthAssignment`
  		ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;');
	}

	public function down()
	{
		echo "m131225_094902_AuthAssignment_1 does not support migration down.\n";
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