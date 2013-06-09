<?php

use Wardrobe\PostRepositoryInterface;

class PostController extends BaseController {

	/**
	 * The post repository implementation.
	 *
	 * @var Wardrobe\PostRepositoryInterface
	 */
	protected $posts;

	/**
	 * Create a new API Posts controller.
	 *
	 * @param  Wardrobe\PostRepositoryInterface  $posts
	 * @return void
	 */
	public function __construct(PostRepositoryInterface $posts)
	{
		parent::__construct();

		$this->posts = $posts;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$posts = $this->posts->active();

		return View::make('themes.'.$this->theme.'.archive')
                                             ->with('posts', $posts);
	}

	public function getTag($tag)
	{
		$posts = $this->posts->activeByTag($tag);

		return View::make('themes.'.$this->theme.'.archive')
                                             ->with('posts', $posts)
                                             ->with('tag', $tag);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($slug)
	{
		$post = $this->posts->findBySlug($slug);

		return View::make('themes.'.$this->theme.'.post')
                                             ->with('post', $post);
	}
}
