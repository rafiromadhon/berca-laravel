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
		/*        visibility: hidden;*/
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

<div class="modal fade p-0 bd-example-modal-lg" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="Modal Update Teknisi" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">FORM UPDATE TEKNISI</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" enctype="multipart/form-data" id="form-update">
				<div class="modal-body py-0">
					<div class="block block-rounded block-link-pop m-0">
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Witel</h4>
							<div id="sel-witel"></div>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">NIK</h4>
							<input class="form-control font-size-sm form-control-alt" id="up-nik" name="up-nik">
							<input class="form-control font-size-sm form-control-alt" id="up-nik-old" name="up-nik-old" hidden>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Nama</h4>
							<input class="form-control font-size-sm form-control-alt" id="up-nama" name="up-nama">
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Telp</h4>
							<input class="form-control font-size-sm form-control-alt" id="up-telp" name="up-telp">
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Email</h4>
							<input class="form-control font-size-sm form-control-alt" id="up-email" name="up-email">
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Posisi</h4>
							<input class="form-control font-size-sm form-control-alt" id="up-posisi" name="up-posisi">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" id="btn-update" class="btn btn-primary">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade p-0 bd-example-modal-lg" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="Modal Delete Teknisi" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">DELETE TEKNISI</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body py-0">
				<div class="block block-rounded block-link-pop m-0">
					<div class="block-content block-content-full">
						<p>Yakin akan menghapus NIK <em id="em-nik">1234567890</em> - <em id="em-nama">Rafi Nur Romadhon</em>?</p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
				<button type="submit" id="btn-delete" class="btn btn-primary">Yakin</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade p-0 bd-example-modal-lg" id="modalInsert" tabindex="-1" role="dialog" aria-labelledby="Modal Tambah Teknisi" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">FORM TAMBAH TEKNISI</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" enctype="multipart/form-data" id="form-insert">
				<div class="modal-body py-0">
					<div class="block block-rounded block-link-pop m-0">
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Name</h4>
							<input class="form-control font-size-sm form-control-alt" id="in-name" name="in-name">
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Born Place</h4>
							<input class="form-control font-size-sm form-control-alt" id="in-born-place" name="in-born-place">
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Born Date</h4>
							<input type="date" class="form-control font-size-sm form-control-alt" id="in-born-date" name="in-born-date">
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Gender</h4>
							<select class="form-control font-size-sm form-control-alt" id="in-gender" name="in-gender">
								<option value="M">Male</option>
								<option value="F">Female</option>
							</select>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Province</h4>
							<select class="form-control font-size-sm form-control-alt" id="in-province" name="in-province">
							</select>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Regency</h4>
							<select class="form-control font-size-sm form-control-alt" id="in-regency" name="in-regency">
							</select>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">District</h4>
							<select class="form-control font-size-sm form-control-alt" id="in-district" name="in-district">
							</select>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Village</h4>
							<select class="form-control font-size-sm form-control-alt" id="in-village" name="in-village">
							</select>
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Street</h4>
							<input type="text" class="form-control font-size-sm form-control-alt" id="in-street" name="in-street">
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">RT</h4>
							<input type="number" min="1" class="form-control font-size-sm form-control-alt" id="in-rt" name="in-rt">
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">RW</h4>
							<input type="number" min="1" class="form-control font-size-sm form-control-alt" id="in-rw" name="in-rw">
						</div>
						<div class="block-content block-content-full">
							<h4 class="h5 mb-2">Deposit Amount</h4>
							<input type="number" min="1" class="form-control font-size-sm form-control-alt" id="in-amount" name="in-amount">
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

<?php 
$nikSession = 'xxx';
?>

<script>
	$(document).ready(function(){
		var table = $('#t-list-account').DataTable({
			dom: 'Bfrtip',
			buttons: [
			{ 
				extend: 'excel',
			},
			{
				text: 'Tambah',
				action: function ( e, dt, node, config ) {
					let selProvince = document.getElementById('in-province');
					$.ajax({
						url: "{{ url('api/data/get-provinces') }}",
						type: 'GET',
						success: function(result){
							for (var i = 0; i < result.length; i++) {
								selProvince.options[selProvince.options.length] = new Option(result[i].name, `${result[i].id}_${result[i].name}`);
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
			ajax: '{{ url('api/data/acc-sub') }}',
			columns: [
			{
				"orderable":      false,
				"searchable": false,
				render: function ( data, type, row, meta ) {
					var num = meta.row;
					return  num+1;
				},
			},
			{data: 'name', name: 'name', orderable: true},
			{data: 'born_place', name: 'born_place', orderable: true},
			{data: 'born_date', name: 'born_date', orderable: true},
			{data: 'gender', name: 'gender', orderable: true},
			{data: 'occupation', name: 'occupation', orderable: true},
			{data: 'address', name: 'address', orderable: true},
			{data: 'depo_amount', name: 'depo_amount', orderable: true},
			{
				data: 'status',
				name: 'status',
				orderable: true,
				render: function ( data, type, row ) {
					let status 	= row.status;
					let ret         = '';

					if (status == 0) {
						ret += '<span class="badge badge-warning" style="font-size: 1em">Waiting for Approval</span>';
					} else if(status == 1) {
						ret += '<span class="badge badge-success" style="font-size: 1em">Approved</span>';
					} else{
						ret += '<span class="badge badge-success" style="font-size: 1em">Rejected</span>';
					}
                    // ret += '<button type="button" data-nik="'+ row.nik +'" data-nama="'+ row.nama +'" class="btn btn-sm btn-danger js-click-ripple-enabled modalDelete"><span class="click-ripple animate"></span>Delete</button>';
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
				url: `{{ url('api/data/get-regencies') }}/${idProvince}`,
				type: 'GET',
				success: function(result){
					for (var i = 0; i < result.length; i++) {
						selRegency.options[selRegency.options.length] = new Option(result[i].name, `${result[i].id}_${result[i].name}`);
					}
				}
			});
		});

		$(document.body).on('change', '#in-regency' ,function(){
			const idRegency = $('#in-regency').val();
			let selDistrict = document.getElementById('in-district');
			$.ajax({
				url: `{{ url('api/data/get-districts') }}/${idRegency}`,
				type: 'GET',
				success: function(result){
					for (var i = 0; i < result.length; i++) {
						selDistrict.options[selDistrict.options.length] = new Option(result[i].name, `${result[i].id}_${result[i].name}`);
					}
				}
			});
		});

		$(document.body).on('change', '#in-district' ,function(){
			const idDistrict = $('#in-district').val();
			let selVillage = document.getElementById('in-village');
			$.ajax({
				url: `{{ url('api/data/get-villages') }}/${idDistrict}`,
				type: 'GET',
				success: function(result){
					for (var i = 0; i < result.length; i++) {
						selVillage.options[selVillage.options.length] = new Option(result[i].name, `${result[i].id}_${result[i].name}`);
					}
				}
			});
		});

		$(document.body).on('click', '.modalUpdate' ,function(){
			var u_witel 	= $(this).data('witel');
			var u_nik 		= $(this).data('nik');
			var u_nama 		= $(this).data('nama');
			var u_telp 		= $(this).data('telp');
			var u_email 	= $(this).data('email');
			var u_posisi 	= $(this).data('posisi');
			var html 		= '';

			$.ajax({
				url: "{{ url('indihome/data/list-witel-alita') }}",
				type: 'GET',
				dataType: "json",
				success: function(result){
					html += '<select id="up-witel" class="form-control font-size-sm form-control-alt" name="up-witel">';

					for( var i = 0; i < result['data'].length; i++){
						var witel = result['data'][i]['witel'];

						if (witel == u_witel) {
							html += '<option value="'+witel+'" selected>' + witel + '</option>';
						} else{
							html += '<option value="'+witel+'">' + witel + '</option>';							
						}
					}

					html += '</select>';
					$('#sel-witel').html(html);
				}
			});

			$('#up-nik-old').val(u_nik);
			$('#up-nik').val(u_nik);
			$('#up-nama').val(u_nama);
			$('#up-telp').val(u_telp);
			$('#up-email').val(u_email);
			$('#up-posisi').val(u_posisi);
			$('#modalUpdate').modal({backdrop: 'static', keyboard: false});

			console.log('terklik');
		});

		$('#form-insert').submit(function(e) {
			var in_witel 	= ($('#in-witel').val() === '' ? '-' : $('#in-witel').val());;
			var in_nik 		= ($('#in-nik').val() === '' ? '-' : $('#in-nik').val());
			var in_nama 	= ($('#in-nama').val() === '' ? '-' : $('#in-nama').val());
			var in_telp 	= ($('#in-telp').val() === '' ? '-' : $('#in-telp').val());
			var in_email 	= ($('#in-email').val() === '' ? '-' : $('#in-email').val());
			var in_posisi 	= ($('#in-posisi').val() === '' ? '-' : $('#in-posisi').val());

			e.preventDefault();

			var formData = new FormData(this);
			formData.append('in_witel', in_witel)
			formData.append('in_nik', in_nik)
			formData.append('in_nama', in_nama)
			formData.append('in_telp', in_telp)
			formData.append('in_email', in_email)
			formData.append('in_posisi', in_posisi)
			$.ajax({
				type: 'POST',
				url: "{{ url('/indihome/data/insert/teknisi-alita') }}",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: (data) => {
					$('#in-witel').val('');
					$('#in-nik').val('');
					$('#in-nama').val('');
					$('#in-telp').val('');
					$('#in-email').val('');
					$('#in-posisi').val('');
					alert("Data teknisi alita berhasil disimpan!");
					table.ajax.reload();
				},
				error: function(data) {
					alert("Data teknisi alita gagal disimpan! Silakan coba lagi");
					window.location.reload();
				}
			});
			$('#modalInsert').modal('toggle');
		});

		$('#form-update').submit(function(e) {

			var up_nik_old 	= $('#up-nik-old').val();
			var up_witel 	= $('#up-witel').val();
			var up_nik 		= $('#up-nik').val();
			var up_nama 	= $('#up-nama').val();
			var up_telp 	= $('#up-telp').val();
			var up_email 	= $('#up-email').val();
			var up_posisi 	= $('#up-posisi').val();

			e.preventDefault();

			var formData = new FormData(this);
			formData.append('up_nik_old', up_nik_old)
			formData.append('up_witel', up_witel)
			formData.append('up_nik', up_nik)
			formData.append('up_nama', up_nama)
			formData.append('up_telp', up_telp)
			formData.append('up_email', up_email)
			formData.append('up_posisi', up_posisi)
			$.ajax({
				type: 'POST',
				url: "{{ url('/indihome/data/update/teknisi-alita') }}",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: (data) => {
					alert("Data teknisi alita berhasil diupdate!");
					table.ajax.reload();
				},
				error: function(data) {
					alert("Data teknisi alita gagal diupdate! Silakan coba lagi");
					window.location.reload();
				}
			});
			$('#modalUpdate').modal('toggle');
		});

		$(document.body).on('click', '.modalDelete' ,function(){
			var d_nik 		= $(this).data('nik');
			var d_nama 		= $(this).data('nama');

			$('#em-nik').html(d_nik);
			$('#em-nama').html(d_nama);
			$('#modalDelete').modal({backdrop: 'static', keyboard: false});
		});

		$(document.body).on('click', '#btn-delete' ,function(){
			var d_nik 		= $('#em-nik').html();

			$.ajax({
				type: 'GET',
				url: "{{ url('/indihome/data/delete/teknisi-alita') }}" + "/" + d_nik,
				cache: false,
				contentType: false,
				processData: false,
				success: (data) => {
					alert("Data teknisi alita berhasil dihapus!");
					// alert(data);
					table.ajax.reload();
				},
				error: function(data) {
					alert("Data teknisi alita gagal dihapus! Silakan coba lagi");
					window.location.reload();
				}
			});
			$('#modalDelete').modal('toggle');

			// alert("Anda akan mendelete NIK ini: "+d_nik);
		});

	});

</script>
@endsection
