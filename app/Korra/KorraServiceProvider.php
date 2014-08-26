<?php

namespace Korra;

use Illuminate\Support\ServiceProvider;
use Korra\Models\Entities\Post;
use Korra\Models\Repositories\EloquentPostRepository;

class KorraServiceProvider extends ServiceProvider {
    public function register()
    {
        /*
         *  Recipe Bindings
         */
        $this->app->bind('Korra\Models\Interfaces\PostInterface', function($app)
        {
            // Return a new instance of PostRepository with the Post model as the parameter
            return new EloquentPostRepository(new Post);
        });
    }
}