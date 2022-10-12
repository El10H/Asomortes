<?php

use Illuminate\Database\Seeder;

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

        /*App\User::create([
            'name'=>'Elio Castillo',
            'email'=>'tesista@hotmail.com',
            'password' =>bcrypt('123456')
        ])->assignRole('admin');*/

        $this->call(RoleSeeder::Class);

        $this->call(UserSeeder::class);
        

        
        //factory(App\partner::class,20)->create();
        //factory(App\beneficiary::class,15)->create();
        //factory(App\product::class,10)->create();
        //factory(App\service::class,10)->create();
        //factory(App\option_service::class,10)->create();
        factory(App\provider::class,10)->create();


        
    }
}
