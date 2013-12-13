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


        $connection = Yii::app()->db;
        $query = <<<EO_SQL
DELETE FROM "AuthItem";
EO_SQL;
        $command = $connection->createCommand($query);
        $command->execute();

        $query = <<<EO_SQL
DELETE FROM "AuthItemChild";
EO_SQL;
        $command = $connection->createCommand($query);
        $command->execute();
        # For more information about authorization item, visit Yii's tutorial:
        # http://www.yiiframework.com/doc/guide/1.1/en/topics.auth
        $auth = Yii::app()->authManager;

        

        $bizRule='return !Yii::app()->user->isGuest;';
        $op = $auth->createOperation('viewGroupInternal', 'view Group Internal',$bizRule);
        
        $task=$auth->createTask('a','aaa');
        $task->addChild('viewGroupInternal');
        
        $role=$auth->createRole('authenticated');
        $role->addChild('a');
        #assign admin role by email
        $role=$auth->createRole('admin');
        $auth->assign('admin', 'admin@cogini.com');
    }
}
?>

