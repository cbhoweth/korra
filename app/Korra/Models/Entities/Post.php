<?php
namespace Korra\Models\Entities;

class Post extends \Eloquent {

    protected $fillable = ['title', 'body'];

    function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function categories()
    {
        return $this->belongsToMany('\Korra\Models\Entities\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('\Korra\Models\Entities\Tag');
    }
}