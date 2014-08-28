<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;
use Korra\Models\Entities\Post;
use Korra\Models\Entities\Tag;
use Korra\Models\Entities\Category;

class PostsTableSeeder extends Seeder {

	public function run()
	{
        // clear our database
        DB::table('posts')->delete();

        $faker = Faker::create();

        foreach(range(1, 10) as $index)
        {
            $tag = Tag::create([
                'name' => $faker->domainWord
            ]);

            $category = Category::create([
                'name' => $faker->colorName
            ]);
        };

        foreach(range(1, 10) as $index)
		{
			$post = Post::create([
                'title' => $faker->catchPhrase,
                'body' => $faker->realText()
			]);

            foreach(range(1, 5) as $index)
            {
                $post->tags()->attach($index);
                $post->categories()->attach($index);
            }
		}
	}
}
