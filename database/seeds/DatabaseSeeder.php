<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // \App\Order::factory(10)->create();

        $user = [
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('Jakarta2024!@#'),
            ]
        ];

        DB::table('users')->insert($user);

        $settings = [
            [
                'name' => 'Prefix Jobstreet',
                'key' => 'JOBSTREET_PREFIX',
                "value" => '._1i38d6g0'
            ],
            [
                'name' => 'Linkedin Client ID',
                'key' => 'LINKEDIN_CLIENT_SECRET',
                "value" => '-'
            ],
            [
                'name' => 'Linkedin Access Token',
                'key' => 'LINKEDIN_ACCESS_TOKEN',
                "value" => '-'
            ]
        ];

        DB::table('settings')->insert($settings);
    }
}
