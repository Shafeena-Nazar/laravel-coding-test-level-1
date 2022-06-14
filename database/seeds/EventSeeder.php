<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 6;$i++) {
            DB::table('events')->insert([
                'id' => Str::uuid()->toString(),
                'name' => Str::random(10),
                'slug' => Str::slug(Str::random(10)),
                'createdAt' => Carbon::now(),
                'updatedAt' => Carbon::now(),
            ]);
        }
    }
}
