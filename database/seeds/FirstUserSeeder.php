<?php

use Illuminate\Database\Seeder;

use App\User; // importo il model user.
use Illuminate\Support\Facades\Hash; // importo il model hash per hashare la password.

class FirstUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* 
            creo un nuovo user,
            con il campo password che viene hashato,
            e lo salvo nel database.
        */
        $newUser = new User();
        $newUser->name = "Marco Bianchi";
        $newUser->email = "marco@bianchi.com";
        $newUser->password = Hash::make('testtest');
        $newUser->save();
    }
}