<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        /* 
            DB::table('users') -> insert(
            [
                'name' => 'Test',
                'email' => 'test_seed@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => 'test_test_test',    
            ]
        );    
        */

        /*
        If you want to create more than one user per db:seed
        factory(\App\User::class, number of users you want) -> create();        
        */

        factory(\App\User::class, 5) -> create()-> each(function($user){
            $user->store()->save(factory(\App\Store::class)->make());
        });


    }
}
