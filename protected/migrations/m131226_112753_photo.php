<?php

class m131226_112753_photo extends CDbMigration
{
	public function up()
	{
		$this->execute('CREATE TABLE IF NOT EXISTS photo(
  id int(11) NOT NULL AUTO_INCREMENT,
  owner_id int(11) NOT NULL,
  type varchar(100) NOT NULL,
  url text NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;');
	}

	public function down()
	{
		echo "m131226_112753_photo does not support migration down.\n";
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