<?php

namespace Database\Seeders;

use App\Models\Donor;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DonorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for($i = 1; $i <= 10; $i++){
            Donor::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->phoneNumber(),
                'address' => $faker->address(),
                'age' => $faker->numberBetween(18, 60),
                'weight' => $faker->numberBetween(50, 100),
                'gender' => $this->generateRandomGender(),
                'image' => "images/default.png",
                'password' => bcrypt('password'),
            ]);
        }
    }
    public function generateRandomGender(){
        $genders = ['male', 'female'];
        return $genders[array_rand($genders)];
    }
}
