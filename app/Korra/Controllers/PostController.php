<?php
namespace Korra\Controllers;

use Korra\Models\Interfaces\PostInterface;
use Symfony\Component\HttpFoundation\Response;

//class PostController extends \BaseController {
class PostController extends \Controller {
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
    public function index()
    {
        $posts = $this->postRepo->index();
        return \Response::json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $post = $this->postRepo->create(\Input::json()->all());
        return \Response::json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepo->show($id);
        return \Response::json($post);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $post = $this->postRepo->update($id, \Input::json()->all());
        return \Response::json($post);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy($id)
    {
        $post = $this->postRepo->delete($id);
        return \Response::json('Post Successfully Deleted');
    }
}