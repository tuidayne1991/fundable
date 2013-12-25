<?php

class m131225_104116_transaction extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE transaction
  ADD CONSTRAINT transaction_ibfk_1 FOREIGN KEY (owner_id) REFERENCES fundy_user (id);');
	}

	public function down()
	{
		echo "m131225_104116_transaction does not support migration down.\n";
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