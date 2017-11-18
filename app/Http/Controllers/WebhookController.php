<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\MessageHelper;
use App\Governor;
use App\State;

class WebhookController extends Controller
{

     /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    
     /**
     * Request comming from chatfuel will hit this method to get governor detail
     *
     * @return json
     */
    public function getGovernor(Request $request)
    {
    	$request = $request->all();
  
        $text = array_get($request, "text");
        $last_name = array_get($request, "last_name");
        $first_name = array_get($request, "first_name");
        $messenger_user_id = array_get($request, "messenger_user_id");
        $gender = array_get($request, "gender");

        if(! $text OR $text == ""){
           $data = [
             ["text" => "No result found."],
           ];
        }
       else{

	        $extracts = MessageHelper::getStateStatus($text);

	        if( ($extracts['status'] == "complete") AND $extracts['state'] ){
	             
	            $state_id = State::where("name", 'LIKE', "%{$extracts['state']}%" )->value('id');

	            $governor = Governor::where("state_id", $state_id)->value("name");

	        }

       	  $data = ["text" => (isset($governor)) ? $governor : "No data found, try something like: Who is the governor of Abia State?" ];
       }

    	return MessageHelper::formatMessage($data);
      
    }

     /**
     * Request comming from chatfuel will hit this method to get date
     *
     * @return json
     */
    public function getDate()
    {
       return date("Y-m-d H:i:s");
    }
}
