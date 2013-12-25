<?php

class m131225_102920_action extends CDbMigration
{
	public function up(){
		$this->execute('ALTER TABLE action
		ADD CONSTRAINT action_user_constraint FOREIGN KEY (owner_id) REFERENCES fundy_user(id);');
	}

	public function down()
	{
		echo "m131225_102920_action does not support migration down.\n";
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