<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Truncate();
        for ($i = 1; $i <= 10; $i++) {
            $usuario = new User;
            $usuario->name = 'Usuario '.$i;
            $usuario->email = 'usuario'.$i.'@gmail.com';
            $usuario->password = Hash::make('contrasenia');
            $usuario->api_token = bin2hex(openssl_random_pseudo_bytes(30));
            $usuario->isAdmin = false;
            $usuario->save();
        }
        $usuario = new User;
        $usuario->name = 'Agustin';
        $usuario->email = 'agustin_sly@hotmail.com';
        $usuario->password = Hash::make('contrasenia');
        $usuario->api_token = bin2hex(openssl_random_pseudo_bytes(30));
        $usuario->isAdmin = true;
        $usuario->save();

        // \App\Models\User::factory()->count(10)->create();  Ver como usar el factory más adelante
    }
}
