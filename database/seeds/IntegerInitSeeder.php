<?php

use Illuminate\Database\Seeder;
use App\Integer;

class IntegerInitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Integer::create([
            'integer' => 1,
        ]);
    }
}
