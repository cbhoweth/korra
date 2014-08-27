<?php
namespace Korra\Controllers;

use Korra\Models\Interfaces\PostInterface;

//class PostController extends \BaseController {
class PostCategoriesController extends \Controller {
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
     */
    public function index($postId)
    {
        $categories = $this->postRepo->getCategoriesByPostId($postId);
        return \Response::json($categories);
    }
}