@extends('layouts.layout')
@section('css-export')
<!-- DataTables -->
<link rel="stylesheet" href="{{ base_url('assets/template/utama/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/template/utama/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('css')
<style>
	.foto-pegawai {
		width: 10px;
	}
</style>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>
					Daftar Pegawai
				</h1>
			</div>
			<div class="col-sm-6" style="text-align: right">
				<button id="btn-tambah-pegawai" class="btn btn-primary">Tambah</button>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="table-pegawai" class="table table-hover table-outline table-vcenter text-nowrap card-table">
								<thead>
									<tr>
										<th>ID</th>
										<th>NAMA</th>
										<th>TEMPAT TANGGAL LAHIR</th>
										<th>EMAIL</th>
										<th>ALAMAT</th>
										<th>NO HP</th>
										<th>FOTO</th>
										<th class="action-no-wrap">ACTION</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="modal fade " id="modalPegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg"  role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title-pegawai">Tambah Pegawai</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" id="form-pegawai" enctype="multipart/form-data">
				<input type="hidden" name="input-id" id="input-id" value="">
				<div class="modal-body">
					<div id="modal-content">
						<div class="card card-outline card-secondary">
							<div class="card-body">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Nama Pegawai</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" required id="input-nama" name="input-nama" placeholder=""
										>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Tanggal Lahir</label>
									<div class="col-sm-8">
										<input type="date" class="form-control" required id="input-tanggal_lahir" name="input-tanggal_lahir" placeholder=""
										>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Tempat Lahir</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" required id="input-tempat_lahir" name="input-tempat_lahir" placeholder=""
										>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Email</label>
									<div class="col-sm-8">
										<input type="email" class="form-control" required id="input-email" name="input-email" placeholder=""
										>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Alamat</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" required id="input-alamat" name="input-alamat" placeholder=""
										>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label">No HP</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" required id="input-no_hp" name="input-no_hp" placeholder=""
										>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Foto</label>
									<div class="col-sm-8">
										<input type="file" class="form-control" required id="input-file_foto" name="input-file_foto" placeholder=""
										>
									</div>
								</div>
								
							</div>
						</div>
						
						
						<div id="html-pengguna">
							<div class="card card-outline card-secondary">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Username</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" required id="input-username" name="input-username" placeholder=""
											value="">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Password</label>
										<div class="col-sm-8">

											<div class="input-group">

												<input type="password" class="form-control"  id="input-password" name="input-password" 
												>
												<div class="input-group-prepend">
													<button type="button" class="" id="btn-show" onclick="togglePassword()"><i class="fas fa-eye"></i></button>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" id="" class="btn btn-primary">Save changes</button>
				</div>
			</form>

		</div>
	</div>
</div>
<img src="" alt="" class="foto-pegawai">
@endsection
@section('js-export')
<!-- DataTables -->
<script src="{{ base_url('assets/template/utama/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ base_url('assets/template/utama/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ base_url('assets/template/utama/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ base_url('assets/template/utama/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
@endsection
@section('js-inline')
<script>
	let $tablePegawai = null;
	let $modalPegawai = null;
	let $btnTambahPegawai = null;
	let $btnSubmitPegawai = null;
	let $htmlPengguna = null;
	let $formPegawai = null;

	$(function() {


		$modalPegawai = $("#modalPegawai");
		$btnTambahPegawai = $("#btn-tambah-pegawai");
		$btnSubmitPegawai = $("#btn-submit-pegawai");
		$formPegawai = $("#form-pegawai");
		$htmlPengguna= $("#html-pengguna");
		$tablePegawai = $('#table-pegawai').DataTable({ 
			"bAutoWidth": false ,
			"processing": true, 
			"serverSide": true, 
			"order": [], 
			"ajax": {
				"url": '<?php echo base_url('pegawai/getData'); ?>',
				"type": "POST",


			},
			"columns": [
			{"data": "id"},
			{"data": "nama"},
			{"data": "tempat_tanggal_lahir"},
			{"data": "email"},
			{"data": "alamat"},
			{"data": "no_hp"},
			{"data": "file_foto_html"},
			{"data": "action"},
			],
			'columnDefs': [
			{
				"targets": 0,
				"orderable" : false,
			},
			{
				"targets": 6,
				"searchable" : false,
				"orderable" : false,
				"className" : 'action-no-wrap',

			},

			{
				"targets": 7,
				"className": "text-center",
				"searchable" : false,
				"orderable" : false,
				"className" : 'action-no-wrap',

			}],



		});



		$btnTambahPegawai.click(function() {
			clearData();
			clearError();
			$("#input-email").attr('required', true);
			$("#input-username").attr('required', true);
			$("#input-password").attr('required', true);
			$htmlPengguna.show();
			$("#modal-title-pegawai").text("Tambah Pegawai");
			$modalPegawai.modal("show");
		})


		$formPegawai.submit(function(event) {
			event.preventDefault();
			$("body").loading('start');
			// $(this).attr('disabled', true);


			data = new FormData($formPegawai[0]);

			let url = "";
			let isNew = data.get('input-id') === "";

			if (isNew ) {
				url = '{{ base_url('pegawai/insert') }}';
			} else {
				url = '{{ base_url('pegawai/update') }}'
			}

			axios.post(url, data)
			.then(res => {
				data = res.data;
				if (data.success) {
					toggleModal($modalPegawai, false).done(function() {
						$tablePegawai.ajax.reload();
					});
					if (!isNew) {
						Swal.fire({
							title: 'Sukses!',
							text: 'Berhasil merubah data pegawai.',
							icon: 'success',
							timer: 1500,
							showConfirmButton: false,

						})
					} else {
						Swal.fire({
							title: 'Sukses!',
							text: 'Berhasil menambah data .',
							icon: 'success',
							timer: 1500,
							showConfirmButton: false,

						})
					}
				} else {

					$.each(data.messages, function(key, value) {

						$('#'+key).addClass('is-invalid');
						$('#'+key).parent('.form-group').find('.error').html(value);
					});
				}

			})
			.catch(err => {
				
			})
			.then(() => {
				$(this).attr('disabled', false);
				$("body").loading('stop');
			});
		});


	});


	function showModal(id,opsi) {
		if (opsi == 1) {
			showEdit(id);
		} else if(opsi == 2) {
			showDelete(id);
		}
	}

	function showEdit(id) {
		let formData = {
			id: id,
		};
		clearError();
		clearData();
		data = Object.keys(formData).map(key => encodeURIComponent(key) + '=' + encodeURIComponent(formData[key])).join('&')
		axios.post("{{ base_url("pegawai/detail") }}", data)
		.then((res) => {

			data = res.data;
			$("#input-nama").val(data.nama);
			$("#input-tanggal_lahir").val(data.tanggal_lahir);
			$("#input-tempat_lahir").val(data.tempat_lahir);
			$("#input-email").val(data.email);
			$("#input-alamat").val(data.alamat);
			$("#input-no_hp").val(data.no_hp);
			$("#input-id").val(data.id);

			$("#input-file_foto").attr('required', false);
			$("#input-email").attr('required', false);
			$("#input-username").attr('required', false);
			$("#input-password").attr('required', false);
			$htmlPengguna.hide();


			$("#modal-title-pegawai").text("Ubah Data Pegawai");

			$modalPegawai.modal("show");
		})
	}

	function showDelete(id) {
		Swal.fire({
			title: 'Delete Data',
			text: "Yakin akan menghapus data ini ?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Hapus!'
		}).then((result) => {
			if (result.value) {
				let formData = {
					id: id,
				};
				data = Object.keys(formData).map(key => encodeURIComponent(key) + '=' + encodeURIComponent(formData[key])).join('&')
				axios.post("{{ base_url("pegawai/delete") }}", data)
				.then((res) => {
					Swal.fire({
						title: 'Deleted!',
						text: 'Your file has been deleted.',
						icon: 'success',
						timer: 500,
						showConfirmButton: false,

					})
					.then(() => {
						$tablePegawai.ajax.reload();
					})
				})
				.catch((error) => {
					Swal.fire({
						title: 'Gagal!',
						text: 'Tidak dapat menghapus data ini !!!.',
						icon: 'error',
						timer: 1500	,
						showConfirmButton: false,

					})
				});


			}
		})
		;
	}




	function clearData() {

		let formElements = $formPegawai.find(".form-control");
		formElements.each(function(index, el) {
			if ($(el).is('input')) {
				$(el).val("");
			} else if ($(el).is('select')){
				$(el).prop('selectedIndex',0);
			}
		});

	}
	function clearError() {
		$(".error").html("");
		$(".is-invalid").removeClass('is-invalid');
	}

	
	
	function togglePassword() {
		let inputPassword = document.getElementById("input-password");
		if (inputPassword.type === "password") {
			inputPassword.type = "text";
		} else {
			inputPassword.type = "password";

		}
	}


</script>
@endsection