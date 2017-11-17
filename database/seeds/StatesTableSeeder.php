<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Excel::load('database/seeds/data/state_governors.csv', function($reader) {

		    // Getting all results
		    $results = $reader->get()->toArray();
            
            // fetch countries table
		    $data = DB::table('countries')->first();

		    foreach( $results as $result){

                 DB::table('states')->insert([
		            'name' => $result['state'],
		            'country_id' => ( isset($data->id) ) ? $data->id : 1,
		        ]);
		    }

		});
    }
}
