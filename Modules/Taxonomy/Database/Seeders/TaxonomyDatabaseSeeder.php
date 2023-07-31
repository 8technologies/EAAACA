<?php

namespace Modules\Taxonomy\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Taxonomy\Entities\TaxonomyType;

class TaxonomyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->taxonomy();
        // $this->call("OthersTableSeeder");
    }

    /**
     * Run the Permission seeds.
     *
     * @return void
     */
    public function taxonomy()
    {
        $entities = [
            [
                'name' => 'Tags', 
                'description' => 'Use "Tags" for tagging on entities',
                'terms' => [
                    [
                        'name' => 'Health', 
                    ],
                    [
                        'name' => 'Development', 
                    ],
                    [
                        'name' => 'IT', 
                    ],
                ],
            ],
            [
                'name' => 'Titles', 
                'description' => 'Use "Titles" for salutations like Mr., Dr. etc',
                'terms' => [
                    [
                        'name' => 'Mr.', 
                    ],
                    [
                        'name' => 'Mrs', 
                    ],
                    [
                        'name' => 'Dr', 
                    ],
                    [
                        'name' => 'Prof', 
                    ],
                ],
            ],
            [
                'name' => 'News Categories', 
                'description' => 'Use for News Categories',
                'terms' => [
                    [
                        'name' => 'Press Release', 
                    ],
                    [
                        'name' => 'Memo', 
                    ],
                ],
            ],
            [
                'name' => 'Publication Categories', 
                'description' => 'Use for Publication Types/Categories',
            ],
        ];

        DB::transaction(function () use ($entities) {
            foreach ($entities as $item) {
                // Select field to create the taxonomy_type
                $itemFields = array_intersect_key($item, array_flip(array('name', 'description')));
                $entity = TaxonomyType::create(($itemFields));
                
                // create related terms
                if ( isset($item['terms']) && is_array($item['terms']) ) {
                    foreach ($item['terms'] as $key => $value) {
                        $entity->taxonomy_terms()->create($value);
                    }
                }
            } 
        });
    }

}
