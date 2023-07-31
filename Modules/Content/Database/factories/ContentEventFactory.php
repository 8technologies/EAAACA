<?php
namespace Modules\Content\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContentEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Content\Entities\ContentEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $paragraphs = $this->faker->paragraphs(rand(2, 5));
        $body = '';
        foreach ($paragraphs as $para) {
            $body .= "<p>{$para}</p>";
        }

        return [
            'title' => trim($this->faker->text($maxNbChars = 50), '.'),
            'starting_date' => $this->faker->date(),
            'ending_date' => $this->faker->date(),
            'location' => $this->faker->address(),
            'body' => $body,
            'user_id' => 1,
        ];
    }
}

