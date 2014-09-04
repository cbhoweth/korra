<?php namespace Korra\Models\Repositories;

use Korra\Models\Interfaces\TagInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Our Tag repository, containing commonly used queries
 */
class EloquentTagRepository implements TagInterface
{
    // Our Eloquent Tag entity
    protected $tagModel;

    /**
     * Setting our class $tagModel to the injected model
     *
     * @param \Eloquent $tag
     */
    public function __construct(\Eloquent $tag)
    {
        $this->tagModel = $tag;
    }


    /**
     * View All Tags
     *
     * @return Object
     * @throws NotFoundHttpException
     */

    public function index()
    {
        $tags = $this->tagModel->orderBy('name')->get();

        if ($tags->count() < 1) {
            throw new NotFoundHttpException("No Tags found.");
        }

        return $tags;
    }

    /**
     * Show Tag Detail
     *
     * @param mixed $id
     * @return Object
     * @throws NotFoundHttpException
     */
    public function show($id)
    {
        $tag = $this->tagModel->find($id);

        if (!$tag) {
            throw new NotFoundHttpException("Tag with id #" . $id . " Not Found");
        }

        return $tag;
    }

    /**
     * Create and return a Tag
     *
     * @param mixed $input
     * @return Object
     * @throws \Exception
     */
    public function create($input)
    {
        $tag = $this->tagModel->create($input);

        // Fire Event
        // $this->events->fire('tag.create', array(json_decode($tag)));

        return $tag;
    }

    /**
     * Delete Tag
     *
     * @param int $id
     * @throws NotFoundHttpException
     */
    public function delete($id) {
        $tag = $this->tagModel->find($id);

        if (!$tag) {
            throw new NotFoundHttpException("Tag with id #" . $id . " Not Found");
        }

        $tag->delete();

        // Fire Event
        // $this->events->fire('tag.deleted', array(json_decode($tag)));
    }

    /**
     * Update Tag and return a Tag
     *
     * @param int $id
     * @param mixed $input
     * @return Object
     * @throws NotFoundHttpException
     */
    public function update($id, $input) {
        $tag = $this->tagModel->find($id);

        if (!$tag) {
            throw new NotFoundHttpException("Tag with id #" . $id . " Not Found");
        }

        $tag->fill($input);
        $tag->save();

        // Fire Event
        // $this->events->fire('tag.updated', array(json_decode($tag)));
        return $tag;
    }
}