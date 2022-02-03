<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZipCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('zipcodes')->insert([
            'zipcode' => '04761',
            'latitude' => '46.119',
            'longitude' => '-67.9726'
        ]);
        \DB::table('zipcodes')->insert([
            'zipcode' => '80331',
            'latitude' => '48.13513',
            'longitude' => '11.58198'
        ]);
        \DB::table('zipcodes')->insert([
            'zipcode' => '01863',
            'latitude' => '42.6324',
            'longitude' => '-71.3918'
        ]);
        \DB::table('zipcodes')->insert([
            'zipcode' => '80331',
            'latitude' => '48.13513',
            'longitude' => '11.58198'
        ]);
        \DB::table('zipcodes')->insert([
            'zipcode' => '65265',
            'latitude' => '39.1882',
            'longitude' => '-91.8924'
        ]);
        \DB::table('zipcodes')->insert([
            'zipcode' => '59084',
            'latitude' => '47.0368',
            'longitude' => '-108.596'
        ]);
        \DB::table('zipcodes')->insert([
            'zipcode' => '23228',
            'latitude' => '37.60765',
            'longitude' => '-77.47693'
        ]);
        \DB::table('zipcodes')->insert([
            'zipcode' => '95635',
            'latitude' => '38.9127',
            'longitude' => '-120.904'
        ]);
        \DB::table('zipcodes')->insert([
            'zipcode' => '86312',
            'latitude' => '34.61',
            'longitude' => '-112.315'
        ]);
        \DB::table('zipcodes')->insert([
            'zipcode' => '98198',
            'latitude' => '47.40177',
            'longitude' => '-122.32429'
        ]);
        \DB::table('zipcodes')->insert([
            'zipcode' => '48555',
            'latitude' => '43.056',
            'longitude' => '-83.748'
        ]);
        \DB::table('zipcodes')->insert([
            'zipcode' => '25840',
            'latitude' => '38.09205',
            'longitude' => '-81.14399'
        ]);
    }
}
