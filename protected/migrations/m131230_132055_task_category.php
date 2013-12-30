<?php

class m131230_132055_task_category extends CDbMigration
{
	public function up()
	{
		$this->execute('CREATE TABLE IF NOT EXISTS `task_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
		INSERT INTO `task_category` (`id`, `name`) VALUES
(1, "Education"),
(2, "Food & drink"),
(3, "Entertainment"),
(4, "Shopping"),
(5, "Transport");');
	}

	public function down()
	{
		echo "m131230_132055_task_category does not support migration down.\n";
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