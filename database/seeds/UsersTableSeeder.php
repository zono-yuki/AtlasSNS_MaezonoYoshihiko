<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //初期ユーザー
        DB::table('users')->insert([
            [
                'username' => 'maezono4649',
                'mail' => 'zono@gmail.com',
                'password' => bcrypt('maezonoyoshihiko')
            ],
        ]);
    }
}
