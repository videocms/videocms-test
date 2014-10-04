<?php
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
	),

	'modules'=>array(
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
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>FALSE,
			'rules'=>array(
                               'index/'         =>'/',
                               'admin/'         =>'admin/index',
                               '<action:\w+>' => 'site/<action>',
                               '<action:\w+>/<id:\d+>' => 'site/<action>',
			),
                    'urlSuffix'=>'.html',
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=22389.m.tld.pl;dbname=baza89_cmsvideo',
			'emulatePrepare' => true,
			'username' => 'admin89_cmsvideo',
			'password' => 'hasl0d)bAzy1!',
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