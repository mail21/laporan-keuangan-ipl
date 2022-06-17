<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'kode' => 'b5',
            'email' => 'ismail@mailnesia.com',
            'nama' => 'Ismail',
            'nomor_hp' => '08871224023',
            'password' => Hash::make('123'),
            'role' => 'user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'kode' => 'b1',
            'email' => 'Pororo@mailnesia.com',
            'nama' => 'Pororo',
            'nomor_hp' => '08871224023',
            'password' => Hash::make('123'),
            'role' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'kode' => 'b2',
            'email' => 'Miko@mailnesia.com',
            'nama' => 'Miko',
            'nomor_hp' => '08871224023',
            'password' => Hash::make('123'),
            'role' => 'super',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
