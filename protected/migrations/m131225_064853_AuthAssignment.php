<?php

class m131225_064853_AuthAssignment extends CDbMigration
{
	public $version = "ctt_1";
	public function ctt_1( ){
		$this->execute('CREATE TABLE IF NOT EXISTS AuthAssignment (
  itemname varchar(64) NOT NULL,
  userid varchar(64) NOT NULL,
  bizrule text,
  data text,
  PRIMARY KEY (itemname,userid)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;');

	}

	public function up()
	{
		call_user_func(array($this, $this->version));
	}

	public function down()
	{
		echo "m131225_064853_AuthAssignment does not support migration down.\n";
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