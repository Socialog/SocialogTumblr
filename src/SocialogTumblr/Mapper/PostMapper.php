<?php

namespace SocialogTumblr\Mapper;

use Socialog\Cache\CacheAwareInterface;
use Socialog\Entity\Post;
use Socialog\Mapper\PostMapperInterface;
use Socialog\Service\AbstractService;
use Tumblr;
use Zend\Cache\Storage\StorageInterface;

class PostMapper extends AbstractService implements 
	PostMapperInterface,
	CacheAwareInterface
{
	/**
	 * Tumblr Client
	 * @var Tumblr 
	 */
	protected $tumblrClient;
	
	protected $cacheStorage;
	
	/**
	 * Tumblr Client
	 * 
	 * @return Tumblr
	 */
	public function getTumblrClient()
	{
		if (!$this->tumblrClient) {
			$this->tumblrClient = $this->getServiceLocator()->get('socialog_tumblr_client');
		}

		return $this->tumblrClient;
	}
	
	/**
	 * @return array
	 */
	public function findAllPosts()
	{
		$cache = $this->getCacheStorage();

		if ($cache->hasItem('tumblr-posts')) {
			$posts = $cache->getItem('tumblr-posts');
		} else {
			$client = $this->getTumblrClient();
			$tumblrPosts = $client->get('/posts');
			$posts = $tumblrPosts['response']['posts'];
			$cache->setItem('tumblr-posts', $posts);
		}

		$result = array();
		foreach ( $posts as $post ) {
			$postEntity = new Post;
			$postEntity->setTitle($post['title']);
			$postEntity->setContent($post['body']);
			$result[] = $postEntity;
		}

		return $result;
	}
	
	/**
	 * Find post by id
	 * 
	 * @param integer $id
	 */
	public function findById($id)
	{
		
	}
	
	/**
	 * 
	 * @return StorageInterface
	 */
	public function getCacheStorage()
	{
		return $this->cacheStorage;
	}
	
	/**
	 * @param StorageInterface $storage
	 */
	public function setCacheStorage(StorageInterface $storage)
	{
		$this->cacheStorage = $storage;
	}
}