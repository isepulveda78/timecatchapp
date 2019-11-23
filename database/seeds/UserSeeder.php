<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('users')->delete();
        
        \DB::table('users')->insert([
            0 => 
            [
                'id' => 1,
                'name' => 'Israel Sepulveda',
                'email' => 'sepulveda.israel@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$WQVXMmpad1bZBdaM6/bmp.LR3ENZ1YxE1Y.EsFfBFcOaT7fSN8fDC',
                'remember_token' => NULL,
                'api_token' => NULL,
                'created_at' => '2019-09-06 20:26:09',
                'updated_at' => '2019-09-06 20:26:28',
            ],
            1 => 
            [
                'id' => 2,
                'name' => 'joeschmoe',
                'email' => 'test@test.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$WQVXMmpad1bZBdaM6/bmp.LR3ENZ1YxE1Y.EsFfBFcOaT7fSN8fDC',
                'remember_token' => NULL,
                'api_token' => NULL,
                'created_at' => '2019-09-06 20:26:09',
                'updated_at' => '2019-09-06 20:26:28',
            ],
            2 => 
            [
                'id' => 3,
                'name' => 'yourmomma',
                'email' => 'momma@test.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$WQVXMmpad1bZBdaM6/bmp.LR3ENZ1YxE1Y.EsFfBFcOaT7fSN8fDC',
                'remember_token' => NULL,
                'api_token' => NULL,
                'created_at' => '2019-09-06 20:26:09',
                'updated_at' => '2019-09-06 20:26:28',
            ]
        ]);

        
    }
}
