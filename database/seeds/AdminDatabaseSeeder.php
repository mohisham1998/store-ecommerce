<?php

use Illuminate\Database\Seeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = new App\Models\Admin();
        $admin -> name = "Mohamed Hisham";
        $admin -> email = "mohisham1998@gmail.com";
        $admin -> password = bcrypt('adminadmin');


    }
}
