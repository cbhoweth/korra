<?php namespace Korra\Models\Repositories;

use Korra\Models\Interfaces\PostInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Our ingredient repository, containing commonly used queries
 */
class EloquentPostRepository implements PostInterface
{
    // Our Eloquent Post entity
    protected $postModel;

    /**
     * Setting our class $postModel to the injected model
     *
     * @param \Eloquent $post
     */
    public function __construct(\Eloquent $post)
    {
        $this->postModel = $post;
    }


    /**
     * View All Posts
     *
     * @return Model
     * @throws NotFoundHttpException
     */

    public function index()
    {
        $posts = $this->postModel->with('tags', 'categories')->get();

        if ($posts->count() < 1) {
            throw new NotFoundHttpException("No posts found.");
        }

        return $posts;
    }

    /**
     * Show Post Detail
     *
     * @param mixed $id
     * @return Model
     * @throws NotFoundHttpException
     */
    public function show($id)
    {
        $post = $this->postModel->with('tags', 'categories')->find($id);

        if (!$post) {
            throw new NotFoundHttpException("Post with id #" . $id . " Not Found");
        }

        return $post;
    }

    /**
     * Create and return a Post
     *
     * @param mixed $input
     * @throws \Exception
     * @return Model
     */
    public function create($input)
    {
        $post = $this->postModel->create($input);

        // Fire Event
        // $this->events->fire('post.create', array(json_decode($post)));

        return $post;
    }

    /**
     * Delete Post
     *
     * @param int $id
     * @return Model
     * @throws NotFoundHttpException
     */
    public function delete($id) {
        $post = $this->postModel->find($id);

        if (!$post) {
            throw new NotFoundHttpException("Post with id #" . $id . " Not Found");
        }

        $post->delete();

        // Fire Event
        // $this->events->fire('post.deleted', array(json_decode($post)));
    }

    /**
     * Update Post and return a Post
     *
     * @param int $id
     * @param mixed $input
     * @return Model
     * @throws NotFoundHttpException
     */
    public function update($id, $input) {
        $post = $this->postModel->find($id);

        if (!$post) {
            throw new NotFoundHttpException("Post with id #" . $id . " Not Found");
        }

        $post->fill($input);
        $post->save();

        // Fire Event
        // $this->events->fire('post.updated', array(json_decode($post)));
        return $post;
    }

    /**
     * Return a Post's Categories
     *
     * @param int $postId
     * @return Model
     * @throws NotFoundHttpException
     */
    public function getCategoriesByPostId($postId) {
        $post = $this->postModel->find($postId);

        if (!$post) {
            throw new NotFoundHttpException("Post with id #" . $postId . " Not Found");
        }

        $categories = $post->categories();

        if ($categories->count() < 1) {
            throw new NotFoundHttpException("Categories for Post with id #" . $postId . " Not Found");
        }

        return $categories->get();
    }

    /**
     * Return a Post's Tags
     *
     * @param int $postId
     * @return Model
     * @throws NotFoundHttpException
     */
    public function getTagsByPostId($postId) {
        $post = $this->postModel->find($postId);

        if (!$post) {
            throw new NotFoundHttpException("Post with id #" . $postId . " Not Found");
        }

        $tags = $post->tags();

        if ($tags->count() < 1) {
            throw new NotFoundHttpException("Tags for Post with id #" . $postId . " Not Found");
        }

        return $tags->get();
    }
}