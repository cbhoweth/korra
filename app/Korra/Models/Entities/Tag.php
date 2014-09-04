<?php
namespace Korra\Models\Entities;

class Tag extends \Eloquent {

    protected $fillable = ['name'];

    function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function post()
    {
        return $this->belongsToMany('\Korra\Models\Entities\Post')->withTimestamps();
    }
}