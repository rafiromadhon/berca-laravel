@extends('layouts.simple')

@section('css_after')
<link rel="stylesheet" href="{{ url('/css/login.css') }}">
@endsection

@section('title')
Login
@endsection

@section('content')
<div class="hero bg-white overflow-hidden">
	<div class="row p-0 m-0 w-100 h-100">
		<div class="col-md-5 text-center form-login">
			<form name="form-login" action="javascript:void(0);">
				<h1 class="font-w700 mb-2 mb-3">
					Super Bank App<span class="font-w400"></span>
				</h1>
				<div class="form-group">
					<label for="inputNIK" class="sr-only">NIK</label>
					<input type="text" id="inputNIK" class="form-control" name="nik" placeholder="NIK" required autofocus>
				</div>

				<div class="form-group">
					<label for="inputPassword" class="sr-only">Password</label>
					<input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
				</div>
				<div class="form-group">
					<button class="btn btn-lg btn-primary btn-block btn-submit" onclick="showSpinner()">Sign in <i id="spinner"></i></button>
				</div>
			</form>
		</div>
		<div class="col-md-7 bg-login"></div>

	</div>
</div>
@endsection

@section('js_after')
<script type="text/javascript">

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	function showSpinner(){
		$('#spinner').addClass("fa fa-fw fa-circle-notch fa-spin");
	}

	$(".btn-submit").click(function(e){

		e.preventDefault();

		var nik = $("input[name=nik]").val();
		var password = $("input[name=password]").val();

		$.ajax({
			type:'POST',
			url:"{{ route('login.auth') }}",
			data:{nik:nik, password:password},
			success:function(data){
				$('#spinner').removeClass("fa fa-fw fa-circle-notch fa-spin");

				if(data.auth){
					// if (nik == '18900053') {
					// 	alert("Anda tidak berhak mengakses web ini");
					// } else{
						window.location.replace( '{{ url('/') }}' );
					// }
				}else {
					alert (data.error)
				}
			}
		});

	});
</script>
@endsection
