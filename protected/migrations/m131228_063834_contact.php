<?php

class m131228_063834_contact extends CDbMigration
{
	public function up(){
		$this->execute('CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `drstartup_id` int(11) NOT NULL,
  `contact_json` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `fundy_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE  `contact` CHANGE  `drstartup_id`  `email` VARCHAR( 200 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE  `contact` ADD  `name` VARCHAR( 200 ) NOT NULL AFTER  `owner_id` ;');
    }

	public function down()
	{
		echo "m131228_063834_contact does not support migration down.\n";
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