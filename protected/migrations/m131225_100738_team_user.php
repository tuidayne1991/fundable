<?php

class m131225_100738_team_user extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE team_user
  ADD CONSTRAINT team_constraint FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT user_constraint FOREIGN KEY (user_id) REFERENCES fundy_user (id) ON DELETE CASCADE ON UPDATE NO ACTION;');
	}

	public function down()
	{
		echo "m131225_100738_team_user_1 does not support migration down.\n";
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