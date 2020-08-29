<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::create(['name' => 'admin']);


        $admin = User::create([
           'name' => "Admin",
           'email' => "admin@saytanar.com",
           'password' => bcrypt('01268268')
        ]);

        $admin->assignRole($admin_role);



    }
}
