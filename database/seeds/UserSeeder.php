<?php

use App\Cep;
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
            'role'     => 'admin',
            'cep_id'   => 1,
            'phone'    => '31 991640226'
        ];

        $dados_customer = [
            'name'     => 'customer customer',
            'email'    => 'customer@gmail.com',
            'password' => bcrypt('12345678'),
            'role'     => 'customer',
            'cep_id'   => 1,
            'phone'    => '31 991640226'
        ];

        User::create($dados_admin);
        User::create($dados_customer);
        $ceps = Cep::all();

        factory(User::class, 20)->make()->each(function($user) use ($ceps) {
          $ceps->random()->users()->save($user);
        });
    }
}
