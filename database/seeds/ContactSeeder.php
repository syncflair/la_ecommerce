<?php

use Illuminate\Database\Seeder;


use Illuminate\Support\Str; //for str::random
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
            'contact_name' => Str::random(10),
            'contact_email' => Str::random(10).'@gmail.com',
            'contact_phone' => rand(01711, 6),
            
        ]);
    }
}
