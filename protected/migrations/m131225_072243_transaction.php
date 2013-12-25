<?php

class m131225_072243_transaction extends CDbMigration
{
	public $version = "ctt_1";
	public function ctt_1( ){
		$this->execute('CREATE TABLE IF NOT EXISTS transaction (
  id int(11) NOT NULL AUTO_INCREMENT,
  owner_id int(11) NOT NULL,
  box_id int(11) NOT NULL,
  money double NOT NULL,
  type tinyint(4) DEFAULT NULL,
  description text COLLATE utf8_unicode_ci,
  currency varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY owner_id (owner_id),
  KEY box_id (box_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30;');
	}

	public function up()
	{
		call_user_func(array($this, $this->version));
	}

	public function down()
	{
		echo "m131225_072243_transaction does not support migration down.\n";
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