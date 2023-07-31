<?php
namespace Modules\Content\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFeaturedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Content\Entities\ContentFeatured::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $paragraphs = $this->faker->paragraphs(rand(2, 4));
        $body = '';
        foreach ($paragraphs as $para) {
            $body .= "<p>{$para}</p>";
        }

        return [
            'title' => trim($this->faker->text($maxNbChars = 40), '.'),
            'body' => $body,
            'user_id' => 1,
        ];
    }
}

