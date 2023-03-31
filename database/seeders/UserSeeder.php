<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Yasser Abd Elghany',
            'email' => 'yasser.m22291@gmail.com',
            'password' => Hash::make('123456789'),
            'phone_number' => '01064146183',
            'store_id' => Store::inRandomOrder()->first()->id,

        ]);


    }
}
