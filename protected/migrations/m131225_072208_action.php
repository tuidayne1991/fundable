<?php

class m131225_072208_action extends CDbMigration
{
	public $version = "ctt_1";
	public function ctt_1( ){
		$this->execute('CREATE TABLE IF NOT EXISTS action (
  id int(11) NOT NULL AUTO_INCREMENT,
  owner_id int(11) NOT NULL,
  name varchar(100) NOT NULL,
  description text NOT NULL,
  begin_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  duration int(11) NOT NULL,
  start_time timestamp NOT NULL DEFAULT "0000-00-00 00:00:00",
  end_time timestamp NOT NULL DEFAULT "0000-00-00 00:00:00",
  status tinyint(1) NOT NULL DEFAULT "0",
  created_at timestamp NOT NULL DEFAULT "0000-00-00 00:00:00",
  PRIMARY KEY (id),
  KEY action_user_constraint (owner_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;
	}');
}
	public function up()
	{
		call_user_func(array($this, $this->version));
	}

	public function down()
	{
		echo "m131225_072208_action does not support migration down.\n";
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
