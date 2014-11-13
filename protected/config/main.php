<?php
                    include 'db.php';
//
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'VideoCMS',
        'language' => 'pl',
       // 'defaultController' => 'site',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'ext.easyimage.EasyImage',
                'application.modules.likedislikedis.models.*',
	),

	'modules'=>array(
            
		'likedislike',
                 'likedislikedis',
	
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(
                    'cache'=>array( 
                        'class'=>'system.caching.CDbCache'
                     ),
		'user'=>array(
                    // 'class' => 'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                            'loginUrl' => array('admin/login'),
                              'class'=>'rWebUser',
		),
            
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>FALSE,
			'rules'=>array(
                               'index/'         =>'/',
                               'admin/'         =>'admin/index',
                               '<action:\w+>' => 'site/<action>',
                               '<action:\w+>/<id:\d+>' => 'site/<action>',   // category ID
                               '<action:\w+>/<id:\d+>-<video_alias:[a-zA-Z0-9-]+>' => 'site/<action>', /// this
                            '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                            '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                            '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                            
			),
                 //   'urlSuffix'=>'.html',
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
               
		'db'=>array(
			'connectionString' => 'mysql:host='.$host.';dbname='.$dbname.'',
			'emulatePrepare' => true,
			'username' => $username,
			'password' => $password,
			'charset' => 'utf8',
                        'enableProfiling' => true,
                        'enableParamLogging' => true,
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
					'levels'=>'error, warning',
				),
                             array(
                                  'class'=>'ext.LogDb',
                                  'autoCreateLogTable'=>true,
                                  'connectionID'=>'db',
                                  'enabled'=>true,
                                  'levels'=>'error',//You can replace trace,info,warning,error
                ),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
            
            'session'=>array(
                    'class'=> 'CDbHttpSession',
                    'connectionID' => 'db',
                    'sessionTableName' => 'VideoCMS_sesja',
                    'timeout' => 900, //czas w sekundach
            ), 
            
             'easyImage' => array(
                    'class' => 'application.extensions.easyimage.EasyImage',
                    //'driver' => 'GD',
                    //'quality' => 100,
                    //'cachePath' => '/assets/easyimage/',
                    //'cacheTime' => 2592000,
                    //'retinaSupport' => false,
            ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'redakcja@timeto.pl',
	),
    
);