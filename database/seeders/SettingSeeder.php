<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'website'           => 'http://127.0.0.1:8000',
            'app_name'          => 'BLOG IPIN',
            'slogan'            => 'TEST MEMBUAT BLOG',
            'phone'             => '085747875865',
            'address'           => 'Lemahdadi Bangunjiwo Kasihan Bantul',
            'email'             => 'info@admin.com',
            'logo'              => 'logo.png',
            'favicon'           => 'favicon.png'
        ]);
    }
}
