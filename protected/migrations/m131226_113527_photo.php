<?php

class m131226_113527_photo extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE photo ADD location TEXT NOT NULL AFTER type;');
	}

	public function down()
	{
		echo "m131226_113527_photo does not support migration down.\n";
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