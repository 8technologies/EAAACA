<?php

namespace Modules\Content\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\DB;
use Modules\Content\Entities\ContentBlogPost;
use Modules\Content\Entities\ContentEvent;
use Modules\Content\Entities\ContentFeatured;
use Modules\Content\Entities\ContentGallery;
use Modules\Content\Entities\ContentNews;
use Modules\Content\Entities\ContentOurWork;
use Modules\Content\Entities\ContentPage;
use Modules\Content\Entities\ContentPublication;
use Modules\Content\Entities\ContentService;
use Modules\Content\Entities\ContentTestimony;

class ContentDatabaseSeeder extends Seeder
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

        // Page 
        $pages = [
            [
                'title' => 'Home', 
            ],
            [
                'title' => 'About us', 
            ],
            [
                'title' => 'Contact', 
            ],
            [
                'title' => 'Terms of Service', 
            ],
            [
                'title' => 'Privacy Policy', 
            ],
        ];

        DB::transaction(function () use ($pages) {
            foreach ($pages as $item) {
                ContentPage::create(($item));
            } 
        });




        // ContentNews
        ContentNews::factory()
            ->count(15)
            ->state(new Sequence(
                fn ($sequence) => ['user_id' => $user->random()->id],
            ))
            ->create();

        // ContentBlogPost
        ContentBlogPost::factory()
            ->count(20)
            ->state(new Sequence(
                fn ($sequence) => ['user_id' => $user->random()->id],
            ))
            ->create();
        
        // ContentEvent
        ContentEvent::factory()
            ->count(4)
            ->state(new Sequence(
                fn ($sequence) => ['user_id' => $user->random()->id],
            ))
            ->create();

        // ContentFeatured
        ContentFeatured::factory()
            ->count(4)
            ->state(new Sequence(
                fn ($sequence) => ['user_id' => $user->random()->id],
            ))
            ->create();

        // ContentGallery
        ContentGallery::factory()
            ->count(4)
            ->state(new Sequence(
                fn ($sequence) => ['user_id' => $user->random()->id],
            ))
            ->create();

        // ContentPublication
        ContentPublication::factory()
            ->count(8)
            ->state(new Sequence(
                fn ($sequence) => ['user_id' => $user->random()->id],
            ))
            ->create();

        // ContentService
        ContentService::factory()
            ->count(4)
            // ->state(new Sequence(
            //     fn ($sequence) => ['user_id' => $user->random()->id],
            // ))
            ->create();
        
        // ContentOurWork
        ContentOurWork::factory()
            ->count(4)
            ->state(new Sequence(
                fn ($sequence) => ['user_id' => $user->random()->id],
            ))
            ->create();

        // ContentTestimony
        ContentTestimony::factory()
            ->count(4)
            ->state(new Sequence(
                fn ($sequence) => ['user_id' => $user->random()->id],
            ))
            ->create();

        // ContentFeatured
        ContentFeatured::factory()
            ->count(4)
            ->state(new Sequence(
                fn ($sequence) => ['user_id' => $user->random()->id],
            ))
            ->create();

        
        // $this->call("OthersTableSeeder");
    }
}
