@extends('layouts.template')

@section('title')
Unlock User
@endsection

@section('css_after')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.dataTables.min.css" />
@endsection

@section('content')
<div class="bg-body-light">
	<div class="content content-full" style="max-width: none; padding-top: 90px !important;">
		<div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
			<h1 class="flex-sm-fill h3 my-2">
				<div class="col-sm-4">
					UNLOCK USER
				</div>
			</h1>
			<nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-alt">
					<li class="breadcrumb-item">Main Menu</li>
					<li class="breadcrumb-item" aria-current="page">
						<a class="link-fx" href="">Unlock User</a>
					</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="content content-full" style="max-width: none">
	<form method="GET" action="">
		<div class="d-flex flex-column flex-sm-row align-items-sm-center">
			<div class="input-group col-sm-4">
				<input class="form-control" value="" id="d-username" name="d_username" placeholder="Username" type="text">
				<div class="input-group-append">
					<button type="button" id="b-unlock" class="btn btn-dark">Unlock</button>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection

@section('js_after')
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/plug-ins/1.10.25/api/sum().js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$(document.body).on('click', '#b-unlock' ,function(){
			let d_username 		= $("#d-username").val();
			$.ajax({
				type: 'GET',
				url: "{{ url('data/unlock-user') }}" + "/" + d_username,
				cache: false,
				contentType: false,
				processData: false,
				success: (data) => {
					if (data.info === 'success') {
						alert("Username successfully unlocked!");

					} else{
						alert("Username failed unlocked!");
					}
				},
				error: function(data) {
					alert("Username failed unlocked!");
				}
			});
		});
	});
</script>
@endsection
