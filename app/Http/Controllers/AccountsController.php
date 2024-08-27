<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;

class AccountsController extends Controller
{
    public function index(){
        $data['data'] = DB::connection('pgsql')->table('accounts')->select('*')->get();
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
}
