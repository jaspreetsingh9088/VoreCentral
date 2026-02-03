<?php

namespace Database\Seeders;

use App\Enum\TabTypeEnum;
use App\Models\Tab;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Tab::get() as $key) {
            $key->delete();
        }
        Tab::insert([
            [
                'id'            => 1,
                'url'           => 'dashboard',
                'icon'          => '<i class="nav-icon fas fa-tachometer-alt"></i>',
                'name'          => 'Dashboard',
                'status'        => true,
                'position'      => 1,
                'type'          => TabTypeEnum::MAIN,
                'tab_id'        => null,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 2,
                'url'           => null,
                'icon'          => '<i class="nav-icon fas fa-users-cog"></i>',
                'name'          => 'Admin Management',
                'status'        => true,
                'position'      => 3,
                'type'          => TabTypeEnum::TABMAIN,
                'tab_id'        => null,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 3,
                'url'           => 'roles',
                'icon'          => '<i class="nav-icon fas fa-user-tie"></i>',
                'name'          => 'Role',
                'status'        => true,
                'position'      => 1,
                'type'          => TabTypeEnum::TAB,
                'tab_id'        => 2,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 4,
                'url'           => 'employees',
                'icon'          => '<i class="nav-icon fas fa-users"></i>',
                'name'          => 'Employee',
                'status'        => true,
                'position'      => 2,
                'type'          => TabTypeEnum::TAB,
                'tab_id'        => 2,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 5,
                'url'           => 'users',
                'icon'          => '<i class="nav-icon fas fa-user"></i>',
                'name'          => 'Users',
                'status'        => true,
                'position'      => 3,
                'type'          => TabTypeEnum::MAIN,
                'tab_id'        => null,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 6,
                'url'           => 'tags',
                'icon'          => '<i class="nav-icon fa fa-tag"></i>',
                'name'          => 'Tags',
                'status'        => true,
                'position'      => 4,
                'type'          => TabTypeEnum::MAIN,
                'tab_id'        => null,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
             [
                'id'            => 7,
                'url'           => 'subscription',
                'icon'          => '<i class="nav-icon fa fa-bars"></i>',
                'name'          => 'Subscription',
                'status'        => true,
                'position'      => 5,
                'type'          => TabTypeEnum::MAIN,
                'tab_id'        => null,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
             [
                'id'            => 8,
                'url'           => 'cms',
                'icon'          => '<i class="nav-icon fa th-list"></i>',
                'name'          => 'Contant Management',
                'status'        => true,
                'position'      => 6,
                'type'          => TabTypeEnum::MAIN,
                'tab_id'        => null,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
             [
                'id'            => 9,
                'url'           => 'section',
                'icon'          => '<i class="nav-icon fa th-list"></i>',
                'name'          => 'CMS Section',
                'status'        => true,
                'position'      => 7,
                'type'          => TabTypeEnum::MAIN,
                'tab_id'        => null,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
        ]);
    }
}
