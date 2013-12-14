<?

class AuthSetupCommand extends CConsoleCommand {
    private $_authManager;
    public function getHelp() {
        return <<<EOD
    USAGE
        authsetup
    DESCRIPTION
        This command generates an initial RBAC authorization hierarchy.
EOD;
    }

    public function run($args) {
        Yii::log('Running command authsetup', 'debug');
        Yii::log('Clearing out old auth data', 'debug');
        if(($this->_authManager=Yii::app()->authManager)===null){    
            echo "Error: an authorization manager, named 'authManager' must be configured to use this command.\n";
            echo "If you already added 'authManager' component in application configuration,\n";
            echo "please quit and re-enter the yiic shell.\n";
return; }

        $connection = Yii::app()->db;
        $query = <<<EO_SQL
DELETE FROM AuthItem;
EO_SQL;
        $command = $connection->createCommand($query);
        $command->execute();

        $query = <<<EO_SQL
DELETE FROM AuthItemChild;
EO_SQL;
        $command = $connection->createCommand($query);
        $command->execute();
        # For more information about authorization item, visit Yii's tutorial:
        # http://www.yiiframework.com/doc/guide/1.1/en/topics.auth
        $auth = Yii::app()->authManager;

        

        $bizRule='return !Yii::app()->user->isGuest && in_array(Yii::app()->user->_id, $params["group"]->getMemberIds());';
        $op = $auth->createOperation('viewGroupInternal', 'view Group Internal',$bizRule);
        
        $task=$auth->createTask('aaa','group aaa');
        $task->addChild('viewGroupInternal');
        
        $role=$auth->createRole('authenticated');
        $role->addChild('aaa');

        $role=$auth->createRole('member');
        #assign admin role by email
    }
}
?>

