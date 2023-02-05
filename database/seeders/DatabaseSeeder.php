<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $faker = Faker::create('id_ID');
        // for($i = 1; $i <= 20; $i++){
        //     User::create([
        //         'name' => $faker->name,
        //         'email' =>$faker->email,
        //         'password' => Hash::make(12345678),
        //         'role' => 'Penyetuju',
        //     ]);
        // }
        $this->call(DriverSeeder::class);
        // $this->call(KendaraanSeeder::class);
    }
}
