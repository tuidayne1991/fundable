<?php

class m131225_072300_event extends CDbMigration
{
	public $version = "ctt_1";
	public function ctt_1( ){
		$this->execute('CREATE TABLE IF NOT EXISTS event (
  id int(11) NOT NULL AUTO_INCREMENT,
  owner_id int(11) NOT NULL,
  name varchar(200) NOT NULL,
  type varchar(100) NOT NULL,
  location text NOT NULL,
  start_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  end_time timestamp NOT NULL DEFAULT "0000-00-00 00:00:00",
  description text NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12;');
	}

	public function up()
	{
		call_user_func(array($this, $this->version));
	}

	public function down()
	{
		echo "m131225_072300_event does not support migration down.\n";
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