<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Dr.Startup',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.msfundy.controllers.*',
		'application.vendor.*',
		'ext.yii-mail.YiiMailMessage',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'abc123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'mrtime' => array(),
		'msfundy' => array(), 
	),

	// application components
	'components'=>array(
		'clientScript'=>array(
			'class' => 'CClientScript',
			'scriptMap' => array(
				'jquery.js'=>false,
			),
			'coreScriptPosition' => CClientScript::POS_BEGIN,
		),
		'mail' => array(
                'class' => 'ext.yii-mail.YiiMail',
                'transportType'=>'smtp',
                'transportOptions'=>array(
                        'host'=>'smtp.mail.yahoo.com',
                        'username'=>'noreply.fundy@yahoo.com',
                        'password'=>'Abcd1234',
                        'port'=>'465',
                        'encryption' => 'ssl',                 
                ),
                'viewPath' => 'application.views.mails',             
        ),

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			'showScriptName'=>false,
			'caseSensitive' => false,
		),
		'authManager' => array(
			'class' => 'CDbAuthManager',
            'connectionID'=>'db',
            'itemTable'=>'AuthItem',
			'itemChildTable'=>'AuthItemChild',
			'assignmentTable'=>'AuthAssignment',
			'defaultRoles'=>array('authenticated', 'guest'),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			//'connectionString' => 'mysql:unix_socket=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock;dbname=fundy',
			'connectionString' => 'mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=drstartup',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'abc123',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, info, debug',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
	
		'adminEmail'=>'noreply.fundy@yahoo.com',
	),


);
