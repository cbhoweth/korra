<?php namespace Korra\Models\Repositories;

use Korra\Models\Interfaces\CategoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Our Category repository, containing commonly used queries
 */
class EloquentCategoryRepository implements CategoryInterface
{
    // Our Eloquent Category entity
    protected $categoryModel;

    /**
     * Setting our class $categoryModel to the injected model
     *
     * @param \Eloquent $category
     */
    public function __construct(\Eloquent $category)
    {
        $this->categoryModel = $category;
    }


    /**
     * View All Categories
     *
     * @return Object
     * @throws NotFoundHttpException
     */

    public function index()
    {
        $categories = $this->categoryModel->orderBy('name')->get();

        if ($categories->count() < 1) {
            throw new NotFoundHttpException("No Categories found.");
        }

        return $categories;
    }

    /**
     * Show Category Detail
     *
     * @param mixed $id
     * @return Object
     * @throws NotFoundHttpException
     */
    public function show($id)
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            throw new NotFoundHttpException("Category with id #" . $id . " Not Found");
        }

        return $category;
    }

    /**
     * Create and return a Category
     *
     * @param mixed $input
     * @return Object
     */
    public function create($input)
    {
        $category = $this->categoryModel->create($input);

        // Fire Event
        // $this->events->fire('category.create', array(json_decode($category)));

        return $category;
    }

    /**
     * Delete Category
     *
     * @param int $id
     * @throws NotFoundHttpException
     */
    public function delete($id) {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            throw new NotFoundHttpException("Category with id #" . $id . " Not Found");
        }

        $category->delete();

        // Fire Event
        // $this->events->fire('category.deleted', array(json_decode($category)));
    }

    /**
     * Update Category and return a Category
     *
     * @param int $id
     * @param mixed $input
     * @return Object
     * @throws NotFoundHttpException
     */
    public function update($id, $input) {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            throw new NotFoundHttpException("Category with id #" . $id . " Not Found");
        }

        $category->fill($input);
        $category->save();

        // Fire Event
        // $this->events->fire('category.updated', array(json_decode($category)));
        return $category;
    }
}