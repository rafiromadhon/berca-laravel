@extends('layouts.template')

@section('title')
Account Submissions
@endsection

@section('css_after')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />

<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.dataTables.min.css" />

<style>
	td.details-control {
		background: url('https://www.datatables.net/examples/resources/details_open.png') no-repeat center center;
		cursor: pointer;
	}
	tr.shown td.details-control {
		background: url('https://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
	}
	td { font-size: 11px; }
</style>
@endsection

@section('content')
<div class="content w-100 js-appear-enabled pt-3 animated fadeIn" style="max-width: none;  padding-top: 80px !important;">
	<div class="block block-rounded bg-transparent">
		<div class="block-content p-0" style="padding-top: 50px;">
			<table id="t-list-account" class="table table-bordered table-hover w-100 bg-white" style="font-size: 0.8em;">
				<thead class="text-center bg-primary text-light" >
					<tr>
						<th style="font-size: 0.8em;vertical-align: middle">#</th>
						<th style="font-size: 0.8em;vertical-align: middle">NAME</th>
						<th style="font-size: 0.8em;vertical-align: middle">BORN PLACE</th>
						<th style="font-size: 0.8em;vertical-align: middle">BORN DATE</th>
						<th style="font-size: 0.8em;vertical-align: middle">GENDER</th>
						<th style="font-size: 0.8em;vertical-align: middle">OCCUPATION</th>
						<th style="font-size: 0.8em;vertical-align: middle">ADDRESS</th>
						<th style="font-size: 0.8em;vertical-align: middle">DEPO AMOUNT</th>
						<th style="font-size: 0.8em;vertical-align: middle">STATUS</th>
					</tr>
				</thead>
				<tbody style="text-align: left;">
				</tbody>
			</table>
			<?php
		?>
	</div>
</div>
</div>

<div class="modal fade p-0 bd-example-modal-lg" id="modalApprove" tabindex="-1" role="dialog" aria-labelledby="Modal Approve" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">APPROVE ACCOUNT</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body py-0">
				<div class="block block-rounded block-link-pop m-0">
					<div class="block-content block-content-full">
						<p>Are you sure want to Approve <em id="em-name">Rafi Nur Romadhon</em>?<em id="em-id" style="display: none;">123</em></p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Nope</button>
				<button type="submit" id="btn-approve" class="btn btn-primary">Sure</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade p-0 bd-example-modal-lg" id="modalInsert" tabindex="-1" role="dialog" aria-labelledby="Modal Insert" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">FORM ACCOUNT SUBMISSIONS</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" enctype="multipart/form-data" id="form-insert">
				<div class="modal-body py-0">
					<div class="block block-rounded block-link-pop m-0">
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Name</h4>
							<input class="form-control font-size-sm form-control-alt" id="in-name" name="in-name" required>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Born Place</h4>
							<input class="form-control font-size-sm form-control-alt" id="in-born-place" name="in-born-place" required>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Born Date</h4>
							<input type="date" class="form-control font-size-sm form-control-alt" id="in-born-date" name="in-born-date" required>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Gender</h4>
							<select class="form-control font-size-sm form-control-alt" id="in-gender" name="in-gender" required>
								<option value="M">Male</option>
								<option value="F">Female</option>
							</select>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Occupation</h4>
							<select class="form-control font-size-sm form-control-alt" id="in-occupation" name="in-occupation" required>
							</select>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Province</h4>
							<select class="form-control font-size-sm form-control-alt" id="in-province" name="in-province" required>
							</select>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Regency</h4>
							<select class="form-control font-size-sm form-control-alt" id="in-regency" name="in-regency" required>
							</select>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">District</h4>
							<select class="form-control font-size-sm form-control-alt" id="in-district" name="in-district" required>
							</select>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Village</h4>
							<select class="form-control font-size-sm form-control-alt" id="in-village" name="in-village" required>
							</select>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Street</h4>
							<input type="text" class="form-control font-size-sm form-control-alt" id="in-street" name="in-street" required>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">RT</h4>
							<input type="number" min="1" class="form-control font-size-sm form-control-alt" id="in-rt" name="in-rt" required>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">RW</h4>
							<input type="number" min="1" class="form-control font-size-sm form-control-alt" id="in-rw" name="in-rw" required>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Deposit Amount</h4>
							<input type="number" min="1" class="form-control font-size-sm form-control-alt" id="in-amount" name="in-amount" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" id="btn-update" class="btn btn-primary">Tambah</button>
				</div>
			</form>
		</div>
	</div>
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

<script>
	function CheckName(text) 
	{ 
		let pattern=  /^[A-Za-z]{1,50}$/;
		if(text.match(pattern)) 
		{ 
			return true;
		}
		else
		{ 
			return false;
		}
	}
	$(document).ready(function(){
		let table = $('#t-list-account').DataTable({
			dom: 'Bfrtip',
			buttons: [
			{
				text: 'Tambah',
				action: function ( e, dt, node, config ) {
					let selProvince = document.getElementById('in-province');
					$.ajax({
						url: "{{ url('data/get-provinces') }}",
						type: 'GET',
						success: function(result){
							for (let i = 0; i < result.length; i++) {
								selProvince.options[selProvince.options.length] = new Option(result[i].name, `${result[i].id}_${result[i].name}`);
							}
						}
					});

					let selOccupation = document.getElementById('in-occupation');
					$.ajax({
						url: "{{ url('data/get-occupations') }}",
						type: 'GET',
						success: function(result){
							for (let i = 0; i < result['data'].length; i++) {
								selOccupation.options[selOccupation.options.length] = new Option(result['data'][i].name, result['data'][i].id);
							}
						}
					});
					$('#modalInsert').modal({backdrop: 'static', keyboard: false});
				}
			}
			],
			processing: true,
			serverSide: false,
			orderCellsTop: true,
			fixedHeader: {
				header: true,
				headerOffset: 57
			},
			ajax: '{{ url('data/acc-sub') }}',
			columns: [
			{
				"orderable":      false,
				"searchable": false,
				render: function ( data, type, row, meta ) {
					let num = meta.row;
					return  num+1;
				},
			},
			{data: 'name', name: 'name', orderable: true},
			{data: 'born_place', name: 'born_place', orderable: true},
			{data: 'born_date', name: 'born_date', orderable: true},
			{
				data: 'gender', 
				name: 'gender',
				orderable: true,
				render: function ( data, type, row ) {
					if (row.gender === 'M') {
						return `Male`;
					}
					return `Female`;
				}
			},
			{data: 'occupation_name', name: 'occupation_name', orderable: true},
			{data: 'address', name: 'address', orderable: true},
			{
				data: 'depo_amount', 
				name: 'depo_amount',
				orderable: true,
				render: function ( data, type, row ) {
					return `Rp${thousands_separators(row.depo_amount)},-`;
				}
			},
			{
				data: 'status',
				name: 'status',
				orderable: true,
				className: 'text-center',
				render: function ( data, type, row ) {
					let id 			= row.id;
					let name 		= row.name;
					let status 		= row.status;
					let user_type 	= '{{ session('user_detail')->user_type }}';
					let ret         = '';

					if (status == 0) {
						ret += '<span class="badge badge-warning" style="font-size: 1em">Waiting for Approval</span>';
						if (user_type === 'admin') {
							ret += '<br><button type="button" data-id="'+ row.id +'" data-name="'+ row.name +'" class="btn btn-sm btn-info js-click-ripple-enabled modalApprove" style="margin-top: 5px;"><span class="click-ripple animate"></span>Approve</button>';
						}
					} else if(status == 1) {
						ret += '<span class="badge badge-success" style="font-size: 1em">Approved</span>';
					} else{
						ret += '<span class="badge badge-success" style="font-size: 1em">Rejected</span>';
					}
					return ret;
				}
			},
			],
			order: [[ 0, "asc" ]],
			pageLength: 100,
			aoColumnDefs: [
			],
		});

		table.on( 'draw', function () {
			$('[data-toggle="tooltip"]').tooltip();
		} );

		$(document.body).on('change', '#in-province' ,function(){
			const idProvince = $('#in-province').val();
			let selRegency = document.getElementById('in-regency');
			$.ajax({
				url: `{{ url('data/get-regencies') }}/${idProvince}`,
				type: 'GET',
				success: function(result){
					for (let i = 0; i < result.length; i++) {
						selRegency.options[selRegency.options.length] = new Option(result[i].name, `${result[i].id}_${result[i].name}`);
					}
				}
			});
		});

		$(document.body).on('change', '#in-regency' ,function(){
			const idRegency = $('#in-regency').val();
			let selDistrict = document.getElementById('in-district');
			$.ajax({
				url: `{{ url('data/get-districts') }}/${idRegency}`,
				type: 'GET',
				success: function(result){
					for (let i = 0; i < result.length; i++) {
						selDistrict.options[selDistrict.options.length] = new Option(result[i].name, `${result[i].id}_${result[i].name}`);
					}
				}
			});
		});

		$(document.body).on('change', '#in-district' ,function(){
			const idDistrict = $('#in-district').val();
			let selVillage = document.getElementById('in-village');
			$.ajax({
				url: `{{ url('data/get-villages') }}/${idDistrict}`,
				type: 'GET',
				success: function(result){
					for (let i = 0; i < result.length; i++) {
						selVillage.options[selVillage.options.length] = new Option(result[i].name, `${result[i].id}_${result[i].name}`);
					}
				}
			});
		});

		$('#form-insert').submit(function(e) {
			let in_name 		= ($('#in-name').val() === '' ? '-' : $('#in-name').val());
			let in_born_place 	= ($('#in-born-place').val() === '' ? '-' : $('#in-born-place').val());
			let in_born_date 	= ($('#in-born-date').val() === '' ? '-' : $('#in-born-date').val());
			let in_gender 		= ($('#in-gender').val() === '' ? '-' : $('#in-gender').val());
			let in_occupation 	= ($('#in-occupation').val() === '' ? '-' : $('#in-occupation').val());
			let in_province 	= ($('#in-province').val() === '' ? '-' : $('#in-province').val());
			let in_regency 		= ($('#in-regency').val() === '' ? '-' : $('#in-regency').val());
			let in_district 	= ($('#in-district').val() === '' ? '-' : $('#in-district').val());
			let in_village 		= ($('#in-village').val() === '' ? '-' : $('#in-village').val());
			let in_street 		= ($('#in-street').val() === '' ? '-' : $('#in-street').val());
			let in_rt 			= ($('#in-rt').val() === '' ? '-' : $('#in-rt').val());
			let in_rw 			= ($('#in-rw').val() === '' ? '-' : $('#in-rw').val());
			let in_amount 		= ($('#in-amount').val() === '' ? '-' : $('#in-amount').val());
			let in_address 		= `${in_province}, ${in_regency}, ${in_district}, ${in_village}, ${in_street}, RT ${in_rt}/RW ${in_rw}`;

			e.preventDefault();

			if (CheckName(in_name)) {
				let formData = new FormData(this);
				formData.append('name', in_name)
				formData.append('born_place', in_born_place)
				formData.append('born_date', in_born_date)
				formData.append('gender', in_gender)
				formData.append('occupation', in_occupation)
				formData.append('address', in_address)
				formData.append('depo_amount', in_amount)
				$.ajax({
					type: 'POST',
					url: "{{ url('data/insert-acc-sub') }}",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					success: (data) => {
						alert("Account successfully stored!");
						this.reset();
						table.ajax.reload();
					},
					error: function(data) {
						alert("Account failed stored!");
					}
				});
				$('#modalInsert').modal('toggle');
			} else{
				alert("Name should contains letters only");
			}

		});

		$(document.body).on('click', '.modalApprove' ,function(){
			let d_id 		= $(this).data('id');
			let d_name 		= $(this).data('name');

			$('#em-name').html(d_name);
			$('#em-id').html(d_id);
			$('#modalApprove').modal({backdrop: 'static', keyboard: false});
		});

		$(document.body).on('click', '#btn-approve' ,function(){
			let d_id 		= $('#em-id').html();

			$.ajax({
				type: 'GET',
				url: "{{ url('data/approve-acc') }}" + "/" + d_id,
				cache: false,
				contentType: false,
				processData: false,
				success: (data) => {
					alert("Data successfully approved!");
					table.ajax.reload();
					$('#modalApprove').modal('toggle');
				},
				error: function(data) {
					alert("Data failed approved!");
				}
			});
		});

	});

</script>
@endsection
