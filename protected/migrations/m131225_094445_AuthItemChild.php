<?php

class m131225_094445_AuthItemChild extends CDbMigration
{
	public function up(){
		$this->execute('ALTER TABLE AuthItemChild
	ADD CONSTRAINT authitemchild_ibfk_1 FOREIGN KEY (parent) REFERENCES AuthItem (name) ON DELETE CASCADE ON UPDATE CASCADE,
	ADD CONSTRAINT authitemchild_ibfk_2 FOREIGN KEY (child) REFERENCES AuthItem (name) ON DELETE CASCADE ON UPDATE CASCADE;');
	}

	public function down()
	{
		echo "m131225_094445_AuthItemChild_1 does not support migration down.\n";
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