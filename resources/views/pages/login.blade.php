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
					<label for="inputUsername" class="sr-only">Username</label>
					<input type="text" id="inputUsername" class="form-control" name="username" placeholder="Username" required autofocus>
				</div>

				<div class="form-group">
					<label for="inputPassword" class="sr-only">Password</label>
					<input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-lg btn-primary btn-block btn-submit" onclick="showSpinner()">Sign in <i id="spinner"></i></button>
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
		function CheckPassword(validatePass = '123') 
		{ 
			let pattern=  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,30}$/;
			if(validatePass.match(pattern)) 
			{ 
				return true;
			}
			else
			{ 
				return false;
			}
		}  

		e.preventDefault();

		let username = $("input[name=username]").val();
		let password = $("input[name=password]").val();

		if (CheckPassword(password)) {
			$.ajax({
				type:'POST',
				url:"{{ route('login.auth') }}",
				data:{username:username, password:password},
				success:function(data){
					$('#spinner').removeClass("fa fa-fw fa-circle-notch fa-spin");
					if(data.auth){
						window.location.replace( '{{ url('/') }}' );
					}else {
						alert (data.error)
					}
				}
			});
		} else{
			alert("Password must contains uppercase & lowercase letter, special character (!/@/#/$/%/^/&/*), and number! min. length 8 character");
		}


	});
</script>
@endsection
