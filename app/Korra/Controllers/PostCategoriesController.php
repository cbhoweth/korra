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
     * @param int $postId
     * @return \Response
     */
    public function index($postId)
    {
        $categories = $this->postRepo->getCategoriesByPostId($postId);
        return \Response::json($categories);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $postId
     * @param int $categoryId
     * @return \Response
     */
    public function destroy($postId, $categoryId)
    {
        $this->postRepo->deleteCategoryByPostId($postId, $categoryId);
        return \Response::json('Category Successfully Deleted from Post with id #' . $postId);
    }
}