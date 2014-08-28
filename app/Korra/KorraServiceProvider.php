<?php

namespace Korra;

use Illuminate\Support\ServiceProvider;
use Korra\Models\Entities\Post;
use Korra\Models\Entities\Category;
use Korra\Models\Entities\Tag;
use Korra\Models\Repositories\EloquentPostRepository;
use Korra\Models\Repositories\EloquentCategoryRepository;
use Korra\Models\Repositories\EloquentTagRepository;

class KorraServiceProvider extends ServiceProvider {
    public function register()
    {
        /*
         *  Post Bindings
         */
        $this->app->bind('Korra\Models\Interfaces\PostInterface', function($app)
        {
            // Return a new instance of PostRepository with the Post model as the parameter
            return new EloquentPostRepository(new Post);
        });

        /*
         *  Category Bindings
         */
        $this->app->bind('Korra\Models\Interfaces\CategoryInterface', function($app)
        {
            // Return a new instance of CategoryRepository with the Category model as the parameter
            return new EloquentCategoryRepository(new Category);
        });

        /*
         *  Tag Bindings
         */
        $this->app->bind('Korra\Models\Interfaces\TagInterface', function($app)
        {
            // Return a new instance of TagRepository with the Tag model as the parameter
            return new EloquentTagRepository(new Tag);
        });
    }
}