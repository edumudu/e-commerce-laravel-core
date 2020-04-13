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
        $dados = [
            'name'         => 'admin',
            'email'        => 'admin@gmail.com',
            'password'     => bcrypt('123'),
            'access_level' => 'admin'
        ];

        if(User::where('email', '=', $dados['email'])->count()) {
          $user = User::where('email', '=', $dados['email'])->first();
          $user->update($dados);
        } else {
          DB::table('users')->insert($dados);
        }
    }
}
