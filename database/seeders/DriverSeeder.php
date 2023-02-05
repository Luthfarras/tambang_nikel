<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Driver;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Driver::truncate();
        Schema::enableForeignKeyConstraints();

        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 30; $i++){

            // insert data ke table barang menggunakan Faker
          DB::table('drivers')->insert([
            'nama_driver' => $faker->name,
            'alamat' => $faker->address,
            'telepon' => $faker->phonenumber,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
          ]);
        }
    }
}
