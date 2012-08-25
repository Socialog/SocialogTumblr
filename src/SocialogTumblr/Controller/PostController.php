<?php

namespace SocialogTumblr\Controller;

use Socialog\Controller\AbstractController;
use SocialogTumblr\Mapper\PostMapper;

/**
 * Tumblr Post
 */
class PostController extends AbstractController
{
	/**
	 * @var \SocialogTumblr\Mapper\PostMapper 
	 */
	protected $postMapper;

	/**
	 * @return \SocialogTumblr\Mapper\PostMapper
	 */
	public function getPostMapper()
	{
		if (!$this->postMapper) {
			$this->postMapper = $this->getServiceLocator()->get('socialog_tumblr_postmapper');
		}
		
		return $this->postMapper;
	}
	
    /**
     * Overview
     */
    public function indexAction()
    {
		$postMapper = $this->getPostMapper();
		
		var_dump($postMapper->findAllPosts());
		
		exit;
        return array(
			
		);
    }
}
