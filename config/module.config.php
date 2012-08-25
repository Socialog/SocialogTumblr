<?php

return array(

	'router' => array(
		'routes' => array(
			'socialog-tumblr' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/tumblr[/:action]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller'	=> 'socialog_tumblr',
                        'action'		=> 'index',
                    ),
                ),
            ),
		),
	),
	
	'controllers' => array(
		'invokables' => array(
			'socialog_tumblr' => 'SocialogTumblr\Controller\PostController',
		),
	),

    /**
     * ViewManager Configuration
     */
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
