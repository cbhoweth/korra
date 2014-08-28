<?php
namespace Korra\Controllers;

use Korra\Models\Interfaces\TagInterface;

class TagController extends \Controller {
    protected $tagRepo;

    /**
     * @param tagInterface $tagRepo
     */
    public function __construct(TagInterface $tagRepo) {
        $this->tagRepo = $tagRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Response
     */
    public function index()
    {
        $tags = $this->tagRepo->index();
        return \Response::json($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Response
     */
    public function store()
    {
        $tag = $this->tagRepo->create(\Input::json()->all());
        return \Response::json($tag);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Response
     */
    public function show($id)
    {
        $tag = $this->tagRepo->show($id);
        return \Response::json($tag);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Response
     */
    public function update($id)
    {
        $post = $this->tagRepo->update($id, \Input::json()->all());
        return \Response::json($post);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Response
     */
    public function destroy($id)
    {
        $post = $this->tagRepo->delete($id);
        return \Response::json('Tag Successfully Deleted');
    }
}