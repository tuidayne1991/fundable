<?php

class m131225_072159_money_box extends CDbMigration
{
	public $version = "ctt_1";
	public function ctt_1( ){
		$this->execute('CREATE TABLE IF NOT EXISTS money_box (
  id int(11) NOT NULL AUTO_INCREMENT,
  owner_id int(11) NOT NULL,
  source text COLLATE utf8_unicode_ci NOT NULL,
  balance double NOT NULL,
  currency varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id),
  KEY owner_id_3 (owner_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23;');
	}

	public function up()
	{
		call_user_func(array($this, $this->version));
	}

	public function down()
	{
		echo "m131225_072159_money_box does not support migration down.\n";
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