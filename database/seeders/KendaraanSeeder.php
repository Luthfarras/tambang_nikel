<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Kendaraan;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Kendaraan::truncate();
        Schema::enableForeignKeyConstraints();

        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 25; $i++){

            // insert data ke table barang menggunakan Faker
          DB::table('kendaraans')->insert([
            'nama_kendaraan' => $faker->name,
            'jenis' => $faker->name,
            'konsumsi_bbm' => $faker->randomnumber,
            'jadwal' => $faker->date(),
            'asal' => $faker->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
          ]);
        }
    }
}
