@extends('layouts.template')

@section('title')
    Home
@endsection

@section('content')

<?php
// $nikSession     = session('user_detail')->nik;
// $nikSession = (isset(session('user_detail')->nik)) ? session('user_detail')->nik : session('user_info')['username'];
// if ($nikSession == '995089' || $nikSession == '22000209') {
  // echo "<pre>";
  // print_r(session('user_detail'));
  // print_r(session()->all());
  // echo "</pre>";
//   session('user_detail')->level = 4;
// }
?>

<div class="w-100 h-100" style='background-image:url("{{ url('assets/bg-teller.jpg') }}");background-position: center; background-repeat: no-repeat;background-size: cover; min-height: calc(100vh);'>
    <div class="w-100 h-100" style="background-color: rgba(0, 0, 0, 0.75);position: absolute;top: 0; left: 0;width: 100%;height: 100%;">
        <div class="col-lg-4 col-md-5 col-sm-6 container justify-content-center">
            <h1 class="text-left" style="margin-top: 35vh; font-size: 1.5rem;color: rgb(219, 219, 219)" >
                Welcome to <br /><span style="font-size:2.3rem;color: rgba(252, 252, 252, 0.795)">Super</span><span style="font-weight: bold;font-size:2.5rem;color:#D90D0D ; opacity: 0.98"> Bank App</span>
            </h1>
        </div>
    </div>
</div>

@endsection
