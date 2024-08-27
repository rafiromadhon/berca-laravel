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
        $username = $request->input('nik');
        $password = $request->input('password');
        $pass_md5 = md5($password);

        $authenticate = false;
        $user_data_from_api = "";
        $info = "";

        $data_user     = DB::connection('pgsql')->table('app_users')->select('*')->where('username', $username)->first();
        if ($data_user) {
            $pass_from_db   = $data_user->password;

            if ($password == $pass_from_db) {
                $authenticate = true;
            }
        }

        if ($authenticate) {
            $request->session()->put('login', TRUE);
            $request->session()->put('username', $username);
            $request->session()->put('user_detail', (object)$data_user);

            return response()->json(['auth'=>true, 'data_user'=>$data_user]);
        } else{
            return response()->json(['error'=> 'user password tidak sesuai (2)', 'auth' => false]);
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
