<?php

class m131225_101754_connection extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE connection
  ADD CONSTRAINT team_connection_1_constraint FOREIGN KEY (team_1_id) REFERENCES team (id) ON DELETE CASCADE,
  ADD CONSTRAINT team_connection_2_constraint FOREIGN KEY (team_2_id) REFERENCES team (id) ON DELETE CASCADE;');
	}

	public function down()
	{
		echo "m131225_101754_connection does not support migration down.\n";
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