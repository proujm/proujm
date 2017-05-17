<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['title'=>'user']);
        Role::create(['title'=>'admin']);
    }
}
