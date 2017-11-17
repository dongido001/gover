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
     * Request comming from chatfuel will hit this method first.
     * From here, we'll determine what to say to the user :)
     *
     * @return json
     */
    public function replyMessage(Request $request)
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
	             
	            $state_id = State::where("name", $extracts['states'])->pluck("id");

	            $governor = Governor::where("state_id", $state_id)->pluck("name");
	        }

       	  $data = ["text" => (isset($governor)) ? $governor : "No data found" ];
       }

    	return MessageHelper::formatMessage($data);
      
    }
}
