<?php

class m131225_064845_AuthItemChild extends CDbMigration
{
	public $version = "ctt_1";
	public function ctt_1( ){
		$this->execute('CREATE TABLE IF NOT EXISTS AuthItemChild (
  parent varchar(64) NOT NULL,
  child varchar(64) NOT NULL,
  PRIMARY KEY (parent,child),
  KEY child (child)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;');
	}

	public function up()
	{
		call_user_func(array($this, $this->version));
	}

	public function down()
	{
		echo "m131225_064845_AuthItemChild does not support migration down.\n";
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