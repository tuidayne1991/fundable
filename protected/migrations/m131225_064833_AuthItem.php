<?php

class m131225_064833_AuthItem extends CDbMigration
{
	public $version = "ctt_1";
	public function ctt_1( ){
		$this->execute('CREATE TABLE IF NOT EXISTS AuthItem (
			name varchar(64) NOT NULL,
			type int(11) NOT NULL,
			description text,
			bizrule text,
			data text,
  			PRIMARY KEY (name)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;');
	}
	/*
	table: uthItem
	from: null
	to: ctt_1
	depends: no
	*/
	public function up()
	{
		call_user_func(array($this, $this->version));
	}

	public function down()
	{
		echo "m131225_064833_AuthItem does not support migration down.\n";
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