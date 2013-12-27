<?php

class m131225_082158_project extends CDbMigration
{
	public $version = "ctt_1";
	public function ctt_1( ){
		$this->execute('CREATE TABLE IF NOT EXISTS project (
  id int(11) NOT NULL AUTO_INCREMENT,
  team_id int(11) NOT NULL,
  name varchar(200) NOT NULL,
  description text NOT NULL,
  funding_status varchar(20) NOT NULL,
  PRIMARY KEY (id),
  KEY team_id (team_id),
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;');
	}
	
	public function up()
	{
		call_user_func(array($this, $this->version));
	}

	public function down()
	{
		echo "m131225_082158_project does not support migration down.\n";
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