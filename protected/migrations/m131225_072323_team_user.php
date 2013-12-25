<?php

class m131225_072323_team_user extends CDbMigration
{
	public $version = "ctt_1";
	public function ctt_1( ){
		$this->execute('CREATE TABLE IF NOT EXISTS team_user (
  team_id int(11) NOT NULL,
  user_id int(11) NOT NULL,
  type varchar(100) NOT NULL,
  status varchar(20) NOT NULL DEFAULT "pending",
  PRIMARY KEY (team_id,user_id),
  KEY team_id (team_id),
  KEY user_id (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;');
	}

	public function up()
	{
		call_user_func(array($this, $this->version));
	}

	public function down()
	{
		echo "m131225_072323_group_user does not support migration down.\n";
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