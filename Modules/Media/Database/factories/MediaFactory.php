<?php
namespace Modules\Media\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Media\Entities\Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = $this->faker->image();
        $imageFile = new File($image);

        return [
            // 'name' => $this->faker->name(),
            'file' => Storage::disk('public')->putFile('faker', $imageFile),
            'user_id' => 1,
        ];
    }
}

