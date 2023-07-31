<?php
namespace Modules\Content\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Media\Entities\Media;
use Modules\Taxonomy\Entities\TaxonomyTerm;

class ContentPublicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Content\Entities\ContentPublication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $paragraphs = $this->faker->paragraphs(rand(5, 7));
        $body = '';
        foreach ($paragraphs as $para) {
            $body .= "<p>{$para}</p>";
        }

        return [
            'title' => trim($this->faker->text($maxNbChars = 50), '.'),
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
        $images = Media::get();

        return $this->afterMaking(function ($entity) {
            //
        })->afterCreating(function ($entity) use ($tags, $images) {
            //
            $entity->tags()->attach($tags->random()->id);
            $entity->attachMedia($images->random(), 'attachments');
        });
    }

}

