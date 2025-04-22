<?php

namespace Database\Seeders;

use App\Models\BloodSample;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BloodSample::create([ 'bloodbank_id' => 1, 'blood-sample' => 'A+']);
        BloodSample::create([ 'bloodbank_id' => 1, 'blood-sample' => 'B+' ]);
        BloodSample::create([ 'bloodbank_id' => 1, 'blood-sample' => 'O+' ]);
        BloodSample::create([ 'bloodbank_id' => 1, 'blood-sample' => 'AB+' ]);
        BloodSample::create([ 'bloodbank_id' => 1, 'blood-sample' => 'A-' ]);
        BloodSample::create([ 'bloodbank_id' => 1, 'blood-sample' => 'B-' ]);
        BloodSample::create([ 'bloodbank_id' => 1, 'blood-sample' => 'AB-' ]);
       
        BloodSample::create([ 'bloodbank_id' => 2, 'blood-sample' => 'A+']);
        BloodSample::create([ 'bloodbank_id' => 2, 'blood-sample' => 'B+' ]);
        BloodSample::create([ 'bloodbank_id' => 2, 'blood-sample' => 'O+' ]);
        BloodSample::create([ 'bloodbank_id' => 2, 'blood-sample' => 'A-' ]);
        BloodSample::create([ 'bloodbank_id' => 2, 'blood-sample' => 'B-' ]);
        BloodSample::create([ 'bloodbank_id' => 2, 'blood-sample' => 'O-' ]);
        BloodSample::create([ 'bloodbank_id' => 2, 'blood-sample' => 'AB-' ]);

        BloodSample::create([ 'bloodbank_id' => 3, 'blood-sample' => 'A+']);
        BloodSample::create([ 'bloodbank_id' => 3, 'blood-sample' => 'B+' ]);
        BloodSample::create([ 'bloodbank_id' => 3, 'blood-sample' => 'O+' ]);
        BloodSample::create([ 'bloodbank_id' => 3, 'blood-sample' => 'A-' ]);
        BloodSample::create([ 'bloodbank_id' => 3, 'blood-sample' => 'B-' ]);
        BloodSample::create([ 'bloodbank_id' => 3, 'blood-sample' => 'AB-' ]);

        BloodSample::create([ 'bloodbank_id' => 4, 'blood-sample' => 'A+']);
        BloodSample::create([ 'bloodbank_id' => 4, 'blood-sample' => 'B+' ]);
        BloodSample::create([ 'bloodbank_id' => 4, 'blood-sample' => 'O+' ]);
        BloodSample::create([ 'bloodbank_id' => 4, 'blood-sample' => 'A-' ]);
        BloodSample::create([ 'bloodbank_id' => 4, 'blood-sample' => 'B-' ]);
        BloodSample::create([ 'bloodbank_id' => 4, 'blood-sample' => 'O-' ]);
        BloodSample::create([ 'bloodbank_id' => 4, 'blood-sample' => 'AB-' ]);

        BloodSample::create([ 'bloodbank_id' => 5, 'blood-sample' => 'O+' ]);
        BloodSample::create([ 'bloodbank_id' => 5, 'blood-sample' => 'A-' ]);
        BloodSample::create([ 'bloodbank_id' => 5, 'blood-sample' => 'B-' ]);
        BloodSample::create([ 'bloodbank_id' => 5, 'blood-sample' => 'O-' ]);
        BloodSample::create([ 'bloodbank_id' => 5, 'blood-sample' => 'AB-' ]);

        BloodSample::create([ 'bloodbank_id' => 6, 'blood-sample' => 'B+' ]);
        BloodSample::create([ 'bloodbank_id' => 6, 'blood-sample' => 'O+' ]);
        BloodSample::create([ 'bloodbank_id' => 6, 'blood-sample' => 'AB+' ]);
        BloodSample::create([ 'bloodbank_id' => 6, 'blood-sample' => 'A-' ]);
        BloodSample::create([ 'bloodbank_id' => 6, 'blood-sample' => 'B-' ]);
    }
}
