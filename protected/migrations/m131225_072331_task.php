<?php

class m131225_072331_task extends CDbMigration
{
	public $version = "ctt_1";
	public function ctt_1( ){
		$this->execute('CREATE TABLE IF NOT EXISTS task (
  id int(11) NOT NULL AUTO_INCREMENT,
  project_id int(11) NOT NULL,
  name varchar(100) NOT NULL,
  description text NOT NULL,
  assignee_id int(11) NOT NULL,
  PRIMARY KEY (id),
  KEY assignee_id (assignee_id),
  KEY project_id (project_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;');
	}

	public function up()
	{
		call_user_func(array($this, $this->version));
	}

	public function down()
	{
		echo "m131225_072331_task does not support migration down.\n";
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