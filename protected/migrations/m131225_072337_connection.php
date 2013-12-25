<?php

class m131225_072337_connection extends CDbMigration
{
	public $version = "ctt_1";
	public function ctt_1( ){
		$this->execute('CREATE TABLE IF NOT EXISTS connection (
  team_1_id int(11) NOT NULL,
  team_2_id int(11) NOT NULL,
  status varchar(100) NOT NULL,
  KEY team_1_id (team_1_id),
  KEY team_2_id (team_2_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;');
	}

	public function up()
	{
		call_user_func(array($this, $this->version));
	}

	public function down()
	{
		echo "m131225_072337_connection does not support migration down.\n";
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