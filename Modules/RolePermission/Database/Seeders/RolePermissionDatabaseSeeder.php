<?php

namespace Modules\RolePermission\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\DB;
use Modules\RolePermission\Entities\PermissionType;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Modules\RolePermission\Entities\SystemModel;

class RolePermissionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->SystemModels();
        // $this->PermissionTypes();
        // $this->Roles();
        $this->Permissions();
    }

    /**
     * Run the role seeds.
     *
     * @return void
     */
    public function Roles()
    {
        $roles = [
            'Administrator',
            'Editor',
        ];
      
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }

    /**
     * Run the SystemModel seeds.
     *
     * @return void
     */
    public function SystemModels()
    {
        $models = [
            ['name' => 'user', 'description' => 'User Accounts'],
            ['name' => 'model', 'description' => 'System models'],
            ['name' => 'role', 'description' => 'User Roles'],
            ['name' => 'permission', 'description' => 'User Permissions'],
            ['name' => 'media', 'description' => 'Files & Media'],
            ['name' => 'team', 'description' => 'User Teams'],
            ['name' => 'notification', 'description' => 'System notifications'],
            ['name' => 'administration', 'description' => 'Administration links'],
        ];
      
        foreach ($models as $model) {
            SystemModel::create($model);
        }
    }

    /**
     * Run the SystemModel seeds.
     *
     * @return void
     */
    public function PermissionTypes()
    {
        // PermissionTypes 
        $permissionTypes = [
            [
                'name' => '.create',
                'description' => 'Add new items', 
            ],
            [
                'name' => '.view',
                'description' => 'View any item', 
            ],
            [
                'name' => '.update',
                'description' => 'Update any item', 
            ],
            [
                'name' => '.delete',
                'description' => 'Delete any item', 
            ],
            [
                'name' => '.index',
                'description' => 'View all listing page', 
            ],
            [
                'name' => '.*',
                'description' => 'Manage all', 
            ],
            [
                'name' => '.view.own',
                'description' => 'View own items', 
            ],
            [
                'name' => '.update.own',
                'description' => 'Update own items', 
            ],
            [
                'name' => '.delete.own',
                'description' => 'Delete own items', 
            ],
            [
                'name' => '.index.own',
                'description' => 'View own listing page', 
            ],
            [
                'name' => '.*.own',
                'description' => 'Manage own items', 
            ],
        ];

        DB::transaction(function () use ($permissionTypes) {
            foreach ($permissionTypes as $item) {
                PermissionType::create(($item));
            } 
        });
    }

    /**
     * Run the System Permission seeders.
     *
     * @return void
     */
    public function Permissions()
    {
        // Get the administration model_id
        $model = SystemModel::where('name', 'administration')->first();
        $model_id = null;

        if ($model) {
            $model_id = $model->id;
        }

        $items = [
            [
                'name' => 'manage.content', 
                'description' => 'Access "Content"'
            ],
            [
                'name' => 'manage.block', 
                'description' => 'Access "Blocks"'
            ],
            [
                'name' => 'manage.notification', 
                'description' => 'Access "Notifications"'
            ],
            [
                'name' => 'manage.taxonomy', 
                'description' => 'Access "Taxonomy"'
            ],
            [
                'name' => 'manage.user', 
                'description' => 'Access "Users"'
            ],
            [
                'name' => 'manage.role_permission', 
                'description' => 'Access "Roles & Permission"'
            ],
            [
                'name' => 'manage.team_group', 
                'description' => 'Access "Teams & Groups"'
            ],
            [
                'name' => 'manage.media', 
                'description' => 'Access "Media"'
            ],
            [
                'name' => 'manage.layout', 
                'description' => 'Access "Layout"'
            ],
            [
                'name' => 'manage.field', 
                'description' => 'Access "Fields"'
            ],
            [
                'name' => 'manage.system', 
                'description' => 'Access "System"'
            ],
        ];
      
        foreach ($items as $item) {
            $item['model_id'] = $model_id;
            Permission::create($item);
        }
    }

}
