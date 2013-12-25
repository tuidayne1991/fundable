<?php

class m131225_072317_team extends CDbMigration
{
	public $version = "ctt_1";
	public function ctt_1( ){
		$this->execute('CREATE TABLE IF NOT EXISTS team (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(200) NOT NULL,
  description text NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25;');
}

	public function up()
	{
		call_user_func(array($this, $this->version));
	}

	public function down()
	{
		echo "m131225_072317_group does not support migration down.\n";
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