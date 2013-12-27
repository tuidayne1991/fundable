<?php

class m131225_102706_project extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE project
  ADD CONSTRAINT group_project_constraint FOREIGN KEY (team_id) REFERENCES team(id) ON DELETE CASCADE ON UPDATE CASCADE;');
	}

	public function down()
	{
		echo "m131225_102706_project does not support migration down.\n";
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