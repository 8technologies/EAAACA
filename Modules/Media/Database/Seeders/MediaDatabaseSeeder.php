<?php

namespace Modules\Media\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Modules\Media\Entities\Media;

class MediaDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $user = User::get();

        Media::factory()
            ->count(5)
            // ->for($user)
            ->state(new Sequence(
                fn ($sequence) => ['user_id' => $user->random()->id],
            ))
            ->create();

        // $this->call("OthersTableSeeder");
    }
}
