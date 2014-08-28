<?php
namespace Korra\Controllers;

use Korra\Models\Interfaces\CategoryInterface;

class CategoryController extends \Controller {
    protected $categoryRepo;

    /**
     * @param CategoryInterface $categoryRepo
     */
    public function __construct(CategoryInterface $categoryRepo) {
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Response
     */
    public function index()
    {
        $categories = $this->categoryRepo->index();
        return \Response::json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Response
     */
    public function store()
    {
        $category = $this->categoryRepo->create(\Input::json()->all());
        return \Response::json($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Response
     */
    public function show($id)
    {
        $category = $this->categoryRepo->show($id);
        return \Response::json($category);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Response
     */
    public function update($id)
    {
        $post = $this->categoryRepo->update($id, \Input::json()->all());
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
        $post = $this->categoryRepo->delete($id);
        return \Response::json('Category Successfully Deleted');
    }
}