<?php namespace Korra\Models\Repositories;

use Korra\Models\Interfaces\PostInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Our Post repository, containing commonly used queries
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
     * A list of Posts
     *
     * @param $params
     *
     * @return mixed
     * @throws NotFoundHttpException
     */

    public function index($params)
    {

        $posts = $this->postModel->with('tags', 'categories')->queryWithParams($params);

        if ($posts->count() < 1) {
            throw new NotFoundHttpException("No posts found.");
        }

        return $posts;
    }

    /**
     * Show Post Detail
     *
     * @param mixed $id
     * @return Object
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
     * @return Object
     * @throws \Exception
     */
    public function create($input)
    {
        $post = $this->postModel->create($input);

        if (isset($input['categories'])) {
            $post->categories()->sync($input['categories']);
        }

        if (isset($input['tags'])) {
            $post->tags()->sync($input['tags']);
        }

        // Fire Event
        // $this->events->fire('post.create', array(json_decode($post)));

        $post->load('categories', 'tags');
        return $post;
    }

    /**
     * Delete Post
     *
     * @param int $id
     * @return Object
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
     * @return Object
     * @throws NotFoundHttpException
     */
    public function update($id, $input) {
        $post = $this->postModel->find($id);

        if (!$post) {
            throw new NotFoundHttpException("Post with id #" . $id . " Not Found");
        }

        $post->fill($input);
        $post->save();

        if (isset($input['categories'])) {
            $post->categories()->sync($input['categories']);
        }

        if (isset($input['tags'])) {
            $post->tags()->sync($input['tags']);
        }

        // Fire Event
        // $this->events->fire('post.updated', array(json_decode($post)));
        return $post;
    }

    /**
     * Return a Post's Categories
     *
     * @param int $postId
     * @return Object
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
     * Delete a Post's Category
     *
     * @param int $postId
     * @param int $categoryId
     * @throws NotFoundHttpException
     */
    public function deleteCategoryByPostId($postId, $categoryId) {
        $post = $this->postModel->find($postId);

        if (!$post) {
            throw new NotFoundHttpException("Post with id #" . $postId . " Not Found");
        }

        if (!$post->categories->contains($categoryId)) {
            throw new NotFoundHttpException("Category doesn't exist on Post with id #" . $postId);
        }

        $post->categories()->detach($categoryId);
    }

    /**
     * Return a Post's Tags
     *
     * @param int $postId
     * @return Object
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

    /**
     * Delete a Post's Tag
     *
     * @param int $postId
     * @param int $tagId
     * @throws NotFoundHttpException
     */
    public function deleteTagByPostId($postId, $tagId) {
        $post = $this->postModel->find($postId);

        if (!$post) {
            throw new NotFoundHttpException("Post with id #" . $postId . " Not Found");
        }

        if (!$post->tags->contains($tagId)) {
            throw new NotFoundHttpException("Tag doesn't exist on Post with id #" . $postId);
        }

        $post->tags()->detach($tagId);
    }
}