<?php

namespace App\Http\Helpers;

use App\Helpers\Requester;
use App\Controllers\LanguageController;
use Illuminate\Http\Request;

class MessageHelper extends Helper
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Foramts message to be sent to ChatFuel
     *
     * @param $data - Array
     * @return json
     */
    public static function formatMessage($data = [])
    {
      
      $payload = [
         "messages" => [
           $data
         ]
      ];
      
      return json_encode($payload);
    }

    /**
     * Extracts state from command
     *
     * @param message - String
     * @return array
     */
    public static function getStateStatus($message)
    {
      
      $message = strtolower($message);

      $commands = trim(preg_replace('/\s+/', ' ', $message)); //remove extra spaces
      $commands = preg_replace('/[^\da-z ]/i', '', $commands); //remove non alphabets but leave spaces
    
      $commands = explode(' ', $commands);

      $state = $status = "";

      if( @$commands[count($commands) - 1] == "state" ){

        //remove the last element - that's the "state" found 
         unset($commands[count($commands) - 1]);
       }

        if( @$commands[count($commands) - 2] == "of" ){

         $state = $commands[count($commands) - 1];
        }

        if( @$commands[count($commands) - 3] == "governor" ){

         $status = "complete";
        }
      
      return [
        "status" => $status, 
        "state"  => $state
      ];
    }

}
