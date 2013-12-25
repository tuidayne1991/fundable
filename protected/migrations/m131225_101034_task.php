<?php

class m131225_101034_task extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE task
  ADD CONSTRAINT task_ibfk_1 FOREIGN KEY (assignee_id) REFERENCES fundy_user(id) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT task_ibfk_2 FOREIGN KEY (project_id) REFERENCES project(id) ON DELETE CASCADE ON UPDATE NO ACTION;');
	}

	public function down()
	{
		echo "m131225_101034_task does not support migration down.\n";
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