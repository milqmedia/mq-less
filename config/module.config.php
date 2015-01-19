<?php


$config = array(
	'mq_util' => array(
		'less' => array(
			'source' => 'assets/less', 
			'import' => array(),
			'outputPath' => 'public/assets/css', 
			'publicPath' => 'assets/css'
		),
		'js' => array(
			'assetsConfigPath' => __DIR__ . '/../../../../public/assets'
		),
	),
	'view_helpers' => array(  
        'invokables' => array(  
            'dateFormat' => 'MQUtil\View\Helper\DateFormat',
        ),
    ),
	'service_manager' => array(
		'invokables' => array(
			'MQUtil\Collector\Milq' => 'MQUtil\Collector\Milq',
		),
		'factories'  => array(
            'MQUtil\Service\Paginator' => 'MQUtil\Service\PaginatorFactory',
        ),
	),
	'view_manager' => array(
	    'template_map' => array(
		    'zend-developer-tools/toolbar/milq' => __DIR__ . '/../view/zend-developer-tools/toolbar/milq.phtml'
		),
	),
);
		
return $config;		