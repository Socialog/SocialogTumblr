<?php

namespace SocialogTumblr;

use Tumblr;

/**
 * Socialog Tumblr Module
 */
class Module
{
	/**
	 * @return array
	 */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

	/**
	 * Autoloader Configuration
	 * 
	 * @return array
	 */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
	
	/**
	 * Service Configuration

	 * @return array
	 */
	public function getServiceConfig()
	{
		return array(
			'invokables' => array(
				'socialog_tumblr_postmapper' => 'SocialogTumblr\Mapper\PostMapper',
			),
			'factories' => array(
				'socialog_tumblr_client' => function($sm) {
					require_once __DIR__ . '/vendor/tumblrPHP/lib/tumblrPHP.php';
					$config = $sm->get('Config');
					$tumblrCfg = $config['tumblr'];
					$client = new Tumblr($tumblrCfg['key'], $tumblrCfg['secret']);;
					$client->setApiBase('http://api.tumblr.com/v2/blog/' . $tumblrCfg['hostname'] . '.tumblr.com');
					return $client;
				},
			),
		); 
	}
}
