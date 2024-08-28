<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;
use Session;

class AccountsController extends Controller
{
    public function index(){
        $data['data'] = DB::connection('pgsql')
        ->table('accounts')
        ->select('accounts.*', 'occupations.name as occupation_name')
        ->join('occupations', 'accounts.occupation', '=', 'occupations.id')
        ->get();
        return response()->json($data);
    }
    
    public function get_provinces(){
        $api = "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json";
        $response = Http::get($api);
        
        $res = $response->json();
        return response()->json($res);
    }
    
    public function get_regencies($id_province){
        $id_province = explode('_', $id_province);
        $id_province = $id_province[0];
        $api = "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$id_province}.json";
        $response = Http::get($api);
        
        $res = $response->json();
        return response()->json($res);
    }
    
    public function get_districts($id_regency){
        $id_regency = explode('_', $id_regency);
        $id_regency = $id_regency[0];
        $api = "https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$id_regency}.json";
        $response = Http::get($api);
        
        $res = $response->json();
        return response()->json($res);
    }
    
    public function get_villages($id_district){
        $id_district = explode('_', $id_district);
        $id_district = $id_district[0];
        $api = "https://www.emsifa.com/api-wilayah-indonesia/api/villages/{$id_district}.json";
        $response = Http::get($api);
        
        $res = $response->json();
        return response()->json($res);
    }
    
    public function get_occupations(){
        $data['data'] = DB::connection('pgsql')->table('occupations')->select('*')->get();
        return response()->json($data);
    }
    
    public function insert_acc_sub(Request $req){
        $insert = DB::connection('pgsql')
        ->table('accounts')
        ->insert([
            'name' => $req->name,
            'born_place' => $req->born_place,
            'born_date' => $req->born_date,
            'gender' => $req->gender,
            'occupation' => $req->occupation,
            'address' => $req->address,
            'depo_amount' => $req->depo_amount,
            'status' => 0,
            'inserted_at' => DB::raw('CURRENT_TIMESTAMP'),
            'inserted_by' => (isset(session('user_detail')->name)) ? session('user_detail')->name : $req->inserted_by,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_by' => (isset(session('user_detail')->name)) ? session('user_detail')->name : $req->updated_by,
        ]);
        
        return response()->json(['info' => 'success']);
    }

    public function approve_acc($id){
        $approve = DB::connection('pgsql')
        ->table('accounts')
        ->where('id', $id)
        ->update([
            'status' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_by' => session('user_detail')->name,
        ]);
        
        return response()->json(['info' => 'success']);
    }

    public function sessions(){
        print_r(session()->all());
    }
}
