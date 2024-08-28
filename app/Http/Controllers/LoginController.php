<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Client\ConnectionException;

class LoginController extends Controller
{
    public function index() {
        Session::forget('key');
        Session::flush();
        Session::save(); // trigger save to old session
        
        Session::regenerate(true); // pass true to regenerate would delete the old session file.
        return view('pages.login');
    }
    
    public function authenticate(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        
        $authenticate = false;
        $user_data_from_api = "";
        $error = "User/Password wrong. Wrong password 3 times may cause your account locked.";
        
        $data_user     = DB::connection('pgsql')->table('app_users')->select('*')->where('username', $username)->first();
        if ($data_user) {
            $pass_from_db   = $data_user->password;
            $status         = $data_user->status;
            
            if ($status === 1) {
                if ($password == $pass_from_db) {
                    $authenticate = true;
                } else{
                    $update = DB::connection('pgsql')
                    ->table('app_users')
                    ->where('username', $username)
                    ->update([
                        'counter' => DB::raw('counter+1'),
                        'status' => DB::raw('CASE WHEN counter >= 2 THEN 0 ELSE 1 END'),
                    ]);
                }
            } else{
                $error = "User locked";
            }
        }
        
        if ($authenticate) {
            $data_user     = DB::connection('pgsql')->table('app_users')->select('id', 'username', 'name', 'email', 'user_type')->where('username', $username)->first();
            $request->session()->put('login', TRUE);
            $request->session()->put('username', $username);
            $request->session()->put('user_detail', (object)$data_user);
            
            return response()->json(['auth'=>true, 'data_user'=>$data_user]);
        } else{
            return response()->json(['error'=> $error, 'auth' => false]);
        }
    }
    
    public function logout()
    {
        $username = session('nik');
        
        Session::forget('key');
        Session::flush();
        Session::save(); // trigger save to old session
        
        Session::regenerate(true); // pass true to regenerate would delete the old session file.
        
        return redirect('login');
    }
}
