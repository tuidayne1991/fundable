<?php

class m131225_072345_project_user extends CDbMigration
{
	public $version = "ctt_1";
	public function ctt_1( ){
		$this->execute('CREATE TABLE IF NOT EXISTS project_user (
  project_id int(11) NOT NULL,
  user_id int(11) NOT NULL,
  role varchar(100) NOT NULL,
  PRIMARY KEY (project_id,user_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;');
	}

	public function up()
	{
		call_user_func(array($this, $this->version));
	}

	public function down()
	{
		echo "m131225_072345_project_user does not support migration down.\n";
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