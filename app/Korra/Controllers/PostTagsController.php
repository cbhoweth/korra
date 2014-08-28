<?php
namespace Korra\Controllers;

use Korra\Models\Interfaces\PostInterface;

//class PostController extends \BaseController {
class PostTagsController extends \Controller {
    protected $postRepo;

    /**
     * @param PostInterface $postRepo
     */
    public function __construct(PostInterface $postRepo) {
        $this->postRepo = $postRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $postId
     * @return \Response
     */
    public function index($postId)
    {
        $tags = $this->postRepo->getTagsByPostId($postId);
        return \Response::json($tags);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $postId
     * @param $tagId
     * @return \Response
     */
    public function destroy($postId, $tagId)
    {
        $this->postRepo->deleteTagByPostId($postId, $tagId);
        return \Response::json('Tag Successfully Deleted from Post with id #' . $postId);
    }
}