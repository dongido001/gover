<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MessageLog;
use DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display a listing of customers
     *
     * @param  int  $page
     * @param  int  $limit
     * @return \Illuminate\Http\Response
     */
    public function getCustomers(Request $request)
    {
        //
        $request = $request->all();

        $limit = array_get($request, "limit", 10);
        $page  = array_get($request, "page", 1);

        $skip = (($limit * $page)/$limit) - 1; 

        $customers = DB::table('message_logs')
                             ->select(DB::raw('id, messenger_user_id, count(id) as number_of_message, first_name, last_name'))
                             ->groupBy('messenger_user_id')
                             ->limit($limit)
                             ->skip($skip)
                             ->get();

        return response()->json($customers);
    }

    /**
     * Display a listing of logs from a particular customer
     *
     * @param  int id
     * @return \Illuminate\Http\Response
     */
    public function getLogsByCustomer($id)
    {

        $message_log = DB::table('message_logs')
                             ->select(DB::raw('messenger_user_id, first_name, last_name, message, created_at'))
                             ->where('id', $id)
                             ->get();

        return response()->json($message_log);
    }
}
