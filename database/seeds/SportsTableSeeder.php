<?php

use Illuminate\Database\Seeder;
use App\Sport;

class SportsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('sports')->delete();
        $sports = ['Cricket', 'Football', 'Volleyball', 'Basketball', 'Carom', 'Chess', 'Hockey', 'Badminton'];

        $count = count($sports);
        for($i=1; $i<=$count; $i++){
            DB::table('sports')->insert([
                'id' => $i,
                'sport_name' => $sports[$i-1]
            ]);
        }
    }
}
