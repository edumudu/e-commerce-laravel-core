<?php

use App\Address;
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
            'cpf'      => '02339024650',
            'role'     => 'admin',
            'phone'    => '31 991640226'
        ];

        $dados_customer = [
            'name'     => 'customer customer',
            'email'    => 'customer@gmail.com',
            'password' => bcrypt('12345678'),
            'cpf'      => '45422230000',
            'role'     => 'customer',
            'phone'    => '31 991640226'
        ];

        $addresses = Address::all();
        $addresses->random()->users()->create($dados_admin);
        $addresses->random()->users()->create($dados_customer);

        factory(User::class, 20)->make()->each(function($user) use ($addresses) {
          $addresses->random()->users()->save($user);
        });
    }
}
