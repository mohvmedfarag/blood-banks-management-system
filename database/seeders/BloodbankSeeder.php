<?php

namespace Database\Seeders;

use App\Models\Bloodbank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BloodbankSeeder extends Seeder
{
   /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bloodbank::create([
            'name' => 'shubra blood bank',
            'governorate' => 'Cairo',
            'city' => 'ZAMALEK',
            'street' => '56 A Mohamed Mazhr St',
            'location' => "https://www.google.com/maps/place/30%C2%B012'50.5%22N+31%C2%B026'36.5%22E/@30.2140347,31.4456654,17z/data=!3m1!4b1!4m4!3m3!8m2!3d30.2140347!4d31.4434767?entry=ttu&g_ep=EgoyMDI1MDMxOS4yIKXMDSoJLDEwMjExNjM5SAFQAw%3D%3D",
            'phone' => '01024146510',
            'email' => 'shubra@gmail.com',
        ]);
        Bloodbank::create([
            'name' => 'ain shams blood bank',
            'governorate' => 'Cairo',
            'city' => 'AIN SHAMS',
            'street' => '75 Mohamed Abou El Naga St',
            'location' => "https://www.google.com/maps/place/30%C2%B012'50.5%22N+31%C2%B026'36.5%22E/@30.2140347,31.4456654,17z/data=!3m1!4b1!4m4!3m3!8m2!3d30.2140347!4d31.4434767?entry=ttu&g_ep=EgoyMDI1MDMxOS4yIKXMDSoJLDEwMjExNjM5SAFQAw%3D%3D",
            'phone' => '01032125515',
            'email' => 'ainshams@gmail.com',
        ]);
        Bloodbank::create([
            'name' => 'heliopolis blood bank',
            'governorate' => 'Cairo',
            'city' => 'Saint Fatima Heliopolis',
            'street' => '8 Ash - Shaikh Beshir Nema St',
            'location' => "https://www.google.com/maps/place/30%C2%B012'50.5%22N+31%C2%B026'36.5%22E/@30.2140347,31.4456654,17z/data=!3m1!4b1!4m4!3m3!8m2!3d30.2140347!4d31.4434767?entry=ttu&g_ep=EgoyMDI1MDMxOS4yIKXMDSoJLDEwMjExNjM5SAFQAw%3D%3D",
            'phone' => '01023514852',
            'email' => 'helio@gmail.com',
        ]);

        Bloodbank::create([
            'name' => 'abdin blood bank',
            'governorate' => 'Giza',
            'city' => 'Abdin',
            'street' => '7 El-Eraki St',
            'location' => "https://www.google.com/maps/place/30%C2%B012'50.5%22N+31%C2%B026'36.5%22E/@30.2140347,31.4456654,17z/data=!3m1!4b1!4m4!3m3!8m2!3d30.2140347!4d31.4434767?entry=ttu&g_ep=EgoyMDI1MDMxOS4yIKXMDSoJLDEwMjExNjM5SAFQAw%3D%3D",
            'phone' => '01254856953',
            'email' => 'abdin@gmail.com',
        ]);

        Bloodbank::create([
            'name' => 'Hawamdiya blood bank',
            'governorate' => 'Giza',
            'city' => 'Hawamdiya',
            'street' => 'Egypt-Assiut Road',
            'location' => "https://www.google.com/maps/place/30%C2%B012'50.5%22N+31%C2%B026'36.5%22E/@30.2140347,31.4456654,17z/data=!3m1!4b1!4m4!3m3!8m2!3d30.2140347!4d31.4434767?entry=ttu&g_ep=EgoyMDI1MDMxOS4yIKXMDSoJLDEwMjExNjM5SAFQAw%3D%3D",
            'phone' => '01254756953',
            'email' => 'hawabdiya@gmail.com',
        ]);
        Bloodbank::create([
            'name' => 'Shebin El-Qanater Central',
            'governorate' => 'Qalyubia',
            'city' => 'Shebin El-Qanater',
            'street' => 'eizbat alwukala st',
            'location' => "https://www.google.com/maps/place/30%C2%B012'50.5%22N+31%C2%B026'36.5%22E/@30.2140347,31.4456654,17z/data=!3m1!4b1!4m4!3m3!8m2!3d30.2140347!4d31.4434767?entry=ttu&g_ep=EgoyMDI1MDMxOS4yIKXMDSoJLDEwMjExNjM5SAFQAw%3D%3D",
            'phone' => '01254856953',
            'email' => 'shebin@gmail.com',
        ]);
    }
}
