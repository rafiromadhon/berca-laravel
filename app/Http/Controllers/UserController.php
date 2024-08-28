<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;

class UserController extends Controller
{
    public function unlock_user($username){
        $approve = DB::connection('pgsql')
        ->table('app_users')
        ->where('username', $username)
        ->update([
            'status' => 1,
            'counter' => 0,
        ]);
        
        return response()->json(['info' => 'success']);
    }
}
