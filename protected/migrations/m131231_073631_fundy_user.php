<?php

class m131231_073631_fundy_user extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE  `fundy_user` ADD  `json_information` TEXT NOT NULL AFTER `activation_code` ; ;
');
	}

	public function down()
	{
		echo "m131231_073631_fundy_user does not support migration down.\n";
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