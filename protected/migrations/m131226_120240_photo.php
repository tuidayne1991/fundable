<?php

class m131226_120240_photo extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE photo ADD status BOOLEAN NOT NULL ;');
	}

	public function down()
	{
		echo "m131226_120240_photo does not support migration down.\n";
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