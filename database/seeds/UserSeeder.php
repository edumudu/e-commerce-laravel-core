<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados_admin = [
            'name'     => 'admin admin',
            'email'    => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role'     => 'admin'
        ];

        $dados_customer = [
            'name'     => 'customer customer',
            'email'    => 'customer@gmail.com',
            'password' => bcrypt('12345678'),
            'role'     => 'customer'
        ];

        User::create($dados_admin);
        User::create($dados_customer);

        factory(User::class, 20)->create();
    }
}
