<?php

class m131225_100611_money_box extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE money_box
  ADD CONSTRAINT money_box_user_constraint FOREIGN KEY (owner_id) REFERENCES fundy_user (id) ON DELETE CASCADE ON UPDATE CASCADE;');
	}

	public function down()
	{
		echo "m131225_100611_money_box_1 does not support migration down.\n";
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