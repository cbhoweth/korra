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
        return $this->belongsToMany('\Korra\Models\Entities\Category')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany('\Korra\Models\Entities\Tag')->withTimestamps();
    }

    /**
     * A list of allowed URL params a person can use to filter Posts. Used below.
     *
     * @var array
     */
    // protected $allowedFilterParams = ['limit', 'perPage'];

    /**
     * A reusable query to pass params
     *
     * @param array $query
     * @param array $queryFilter
     */
    public function scopeQueryWithParams($query, $queryFilter)
    {

        $limit     = isset($queryFilter['limit']) ? $queryFilter['limit'] : 10;
        $perPage   = isset($queryFilter['perPage']);
        $orderBy   = isset($queryFilter['orderBy']) ? $queryFilter['orderBy'] : 'created_at';
        $sortOrder = isset($queryFilter['sortOrder']) ? $queryFilter['sortOrder'] : 'desc';

        $query->orderBy($orderBy, $sortOrder);

        // Make sure whatever the user submitted is acceptable
        // $filterBy = array_only($queryFilter, $this->allowedFilterParams);
        //
        // foreach($filterBy AS $field => $value) {
        //     $query->where($field, 'LIKE', "%$value%");
        // }

        if ($perPage)
        {
            return $query->paginate($perPage);
        }

        return $query->take($limit)->get();
    }
}

