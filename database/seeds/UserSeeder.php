<?php

use Illuminate\Database\Seeder;
use App\User;
//use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);

        //$id_role= role::where('name',"Admin")->select('id')->get();
        /*$id_role=role::select('id')
            ->where('name','Admin')->firstOrFail();*/

        User::create([
            'name'=>'Elio',
            'email'=>'elio@hotmail.com',
            'password' =>bcrypt('123456')
        ])->assignRole('Admin');

        User::create([
            'name'=>'Hilton',
            'email'=>'hilton@hotmail.com',
            'password' =>bcrypt('123456')
        ])->assignRole('Directivo');

        
        factory(App\User::class,9)->create();
    }
}
