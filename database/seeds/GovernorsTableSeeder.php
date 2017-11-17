<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GovernorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		Excel::load('database/seeds/data/state_governors.csv', function($reader) {

		    // Getting all results
		    $results = $reader->get()->toArray();

		    $counter = 0;

		    foreach( $results as $result){
                     
                 $counter += 1;

                 $data = DB::table('countries')->first();

                 DB::table('governors')->insert([
		            'name' => $result['governor'],
		            'country_id' => ( isset($data->id) ) ? $data->id : 1,
		            'state_id' => $counter,
		            'is_active' => 1,
		        ]);
		    }

		});    
	}
}
