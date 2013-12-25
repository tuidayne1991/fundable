<?php

class m131225_060226_fundy_user extends CDbMigration
{

	public $version = "ctt_1";
	public function ctt_1( ){
		$this->execute('CREATE TABLE IF NOT EXISTS fundy_user (
id int(11) NOT NULL AUTO_INCREMENT,
email varchar(255) COLLATE utf8_unicode_ci NOT NULL,
name varchar(200) COLLATE utf8_unicode_ci NOT NULL,
currency varchar(100) COLLATE utf8_unicode_ci DEFAULT "VND",
password varchar(255) COLLATE utf8_unicode_ci NOT NULL,
is_activated tinyint(1) NOT NULL DEFAULT 0,
unique_id text COLLATE utf8_unicode_ci NOT NULL,
activation_code text COLLATE utf8_unicode_ci NOT NULL,
PRIMARY KEY (id),
UNIQUE KEY email (email)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38;');

	}
	
	public function up(){
		call_user_func(array($this, $this->version));
	}

	public function down(){
		$this->dropTable('tbl_news');
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