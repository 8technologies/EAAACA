<?php
namespace Modules\Content\Database\factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Media\Entities\Media;
use Modules\Taxonomy\Entities\TaxonomyTerm;

class ContentBlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Content\Entities\ContentBlogPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $paragraphs = $this->faker->paragraphs(rand(10, 15));
        $body = '';
        foreach ($paragraphs as $para) {
            $body .= "<p>{$para}</p>";
        }

        return [
            'title' => trim($this->faker->text($maxNbChars = 70), '.'),
            'body' => $body,
            'user_id' => 1,
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        $tags = TaxonomyTerm::where('taxonomy_type_id', 1)->get();
        $images = Media::where('mime_type', 'like', '%'.'image'.'%')->get();

        return $this->afterMaking(function ($entity) {
            //
        })->afterCreating(function ($entity) use ($tags, $images) {
            //
            $entity->tags()->attach($tags->random()->id);
            if (rand() % 2 == 0) {
                $entity->attachMedia($images->random(), 'images');
            }
        });
    }

}

