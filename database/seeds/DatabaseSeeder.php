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
        $seller_role = Role::create(['name' => 'seller']);
        $admin = User::where('email', 'saydanathanhtike@gmail.com')->first();
        $admin->assignRole($admin_role);

        $seller = User::create([
           'name' => "Seller One",
           'email' => "sellerone@perfect.com",
           'password' => bcrypt('sellerperfect')
        ]);

        $seller->assignRole($seller_role);



    }
}
