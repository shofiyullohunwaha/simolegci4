<div class="panel-header bg-primary-gradient">
	<div class="page-inner py-5">
		<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
			<div>
				<h2 class="text-white pb-2 fw-bold">Sistem</h2>
				<h5 class="text-white op-7 mb-2">Pengelolaan Data Sistem</h5>
			</div>
			<div class="ml-md-auto py-2 py-md-0">
				<button class="btn btn-white btn-border btn-round mr-1">Kode Form: <?= $idf; ?></button>
				<?php
					if(strpos($akses, "001") !== false) {
						echo "<button class='btn btn-success btn-round mr-1' data-toggle='modal' data-target='#modaltambah' data-backdrop='static' data-keyboard='false'>Tambah</button>";
					}
				?>
				<button class="btn btn-danger btn-round" onclick="refreshdata()">Refresh Data</button>
			</div>
		</div>
	</div>
</div>
<div class="page-inner mt--5">
	<div class="row mt--2">
		<div class="col-md-12">
            <div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table id="tbl-xdt" class="display table table-striped table-hover">
							<thead>
								<tr>
									<th style="width: 8%;">Aksi</th>
									<th style="width: 8%;">ID</th>
									<th style="width: 10%;">Nama</th>
									<th style="width: 66%;">Deskripsi</th>
									<th style="width: 8%;">Bentuk</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="modaltambah" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Tambah Sistem</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group col-6 jedaobyek">
						<label>ID Sistem*</label>
						<input type="text" class="form-control formt khusus_angka" id="txtid" placeholder="Masukkan ID Sistem" maxlength="3" autocomplete="off">
					</div>
					<div class="form-group col-6 jedaobyek">
						<label>Nama Sistem*</label>
						<input type="text" class="form-control formt khusus_abjad" id="txtnama" placeholder="Masukkan Nama Sistem" autocomplete="off">
					</div>
					<div class="form-group col-12 jedaobyek">
						<label>Deskripsi*</label>
						<input type="text" class="form-control formt khusus_abjad2" id="txtdeskripsi" placeholder="Masukkan Deskripsi Sistem" autocomplete="off">
					</div>
					<div class="form-group col-3 jedaobyek">
						<label>Urut*</label>
						<select class="form-control formt" id="cbourut">
							<?php
								for($i=1; $i<=100; $i++){
									echo "<option value='".$i."'>$i</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group col-3 jedaobyek">
						<label>Status*</label>
						<select class="form-control formt" id="cbostatus">
							<option value='Y'>Aktif</option>
							<option value='N'>Tidak Aktif</option>
						</select>
					</div>
					<div class="form-group col-3 jedaobyek">
						<label>Icon*</label>
						<select class="form-control formt" id="cboicon" onchange="previewicon('cboicon','blokicon')"></select>
					</div>
					<div class="form-group col-3 jedaobyek text-center" id="blokicon" style="font-size: 55px;"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnbatal" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Batal</button>
				<button type="button" id="btnreset" class="btn btn-danger waves-effect waves-light" onclick="reset()">Reset</button>
				<?php
					if(strpos($akses, "001") !== false) {
						echo '<button type="button" id="btntambah" class="btn btn-primary waves-effect waves-light" onclick="tambah()">Tambah</button>';
					}
				?>
			</div>
		</div>
	</div>
</div>
<div id="modalupdate" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Update Sistem</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group col-6 jedaobyek">
						<label>ID Sistem*</label>
						<input type="text" class="form-control forme khusus_angka" id="txtide" placeholder="Masukkan ID Sistem" maxlength="3" readonly autocomplete="off">
					</div>
					<div class="form-group col-6 jedaobyek">
						<label>Nama Sistem*</label>
						<input type="text" class="form-control forme khusus_abjad" id="txtnamae" placeholder="Masukkan Nama Sistem" autocomplete="off">
					</div>
					<div class="form-group col-12 jedaobyek">
						<label>Deskripsi*</label>
						<input type="text" class="form-control forme khusus_abjad2" id="txtdeskripsie" placeholder="Masukkan Deskripsi Sistem" autocomplete="off">
					</div>
					<div class="form-group col-3 jedaobyek">
						<label>Urut*</label>
						<select class="form-control forme" id="cbourute">
							<?php
								for($i=1; $i<=100; $i++){
									echo "<option value='".$i."'>$i</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group col-3 jedaobyek">
						<label>Status*</label>
						<select class="form-control forme" id="cbostatuse">
							<option value='Y'>Aktif</option>
							<option value='N'>Tidak Aktif</option>
						</select>
					</div>
					<div class="form-group col-3 jedaobyek">
						<label>Icon*</label>
						<select class="form-control forme" id="cboicone" onchange="previewicon('cboicone','blokicone')"></select>
					</div>
					<div class="form-group col-3 jedaobyek text-center" id="blokicone" style="font-size: 55px;"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnbatale" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Batal</button>
				<?php
					if(strpos($akses, "002") !== false) {
						echo '<button type="button" id="btnupdate" class="btn btn-primary waves-effect waves-light" onclick="update()">Update</button>';
					}
				?>
			</div>
		</div>
	</div>
</div>

<script>
	swal({text:"Menampilkan Data ...", icon: iconpreloader, button: false, closeOnClickOutside: false, closeOnEsc: false});
	let tabel = $('#tbl-xdt').DataTable({
		"ajax": "<?= BASEURLKU.ucfirst($idf); ?>/data",
		"fnDrawCallback": function(oSettings){swal.close();}
	});
	listicon();
	function listicon(){
		let hasil = "";
		for(x of daftaricon){
			hasil += `<option value="${x}">${x}</option>`;
		}
		$("#cboicon").html(hasil);
		$("#cboicone").html(hasil);
	}
	function previewicon(id, tujuan){
		let nilai = $("#" + id).val();
		$("#" + tujuan).html(`<i class="${nilai}"></i>`);
	}
	function refreshdata(){
		swal({text:"Menampilkan Data ...", icon: iconpreloader, button: false, closeOnClickOutside: false, closeOnEsc: false});
		tabel.ajax.reload(null, false);
	}
	reset();
	function reset(){
		$(".formt").val("");
		$("#cbourut").val("1").change();
		$("#cbostatus").val("Y").change();
		$("#cboicon").val("icon-user").change();
	}
	function tambah(){
		$("#btnbatal").attr("disabled", true);
        $("#btnreset").attr("disabled", true);
        $("#btntambah").attr("disabled", true);
		let id = $("#txtid").val();
		let nama = $("#txtnama").val();
		let deskripsi = $("#txtdeskripsi").val();
		let urut = $("#cbourut").val();
		let status = $("#cbostatus").val();
		let icon = $("#cboicon").val();
        if(id == "" || nama == "" || deskripsi == "" || urut == "" || status == "" || icon == ""){
            swal({title: 'Gagal', text: 'Ada Isian yang Masih Kosong !', icon: 'error',});
            $("#btnbatal").attr("disabled", false);
            $("#btnreset").attr("disabled", false);
            $("#btntambah").attr("disabled", false);
            return;
        }
        swal({text:"Proses Tambah ...", icon: iconpreloader, button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= BASEURLKU.ucfirst($idf); ?>/tambah",
            method: "POST",
            data: {id: id, nama: nama, deskripsi: deskripsi, urut: urut, status: status, icon: icon},
            cache: "false",
            timeout: ajaxtimeout,
            success: function(respon){
                swal.close();
                let data = JSON.parse(atob(respon));
                if(data.kode == "01"){
                    swal({title: "Berhasil", text: data.pesan, icon: "success"}).then((Ok) => {
                        if(Ok){
                            tabel.ajax.reload(null, false);
							reset();
							$("#modaltambah").modal("hide");
                        }
                    })
                }else{
                    swal({title: "Gagal", text: data.pesan, icon: "error"});
                }
            },
            error: function(){
                swal.close();
                swal({title: 'Gagal', text: 'Respon Gagal dari Server', icon: 'error'});
            }
        });
        $("#btnbatal").attr("disabled", false);
		$("#btnreset").attr("disabled", false);
		$("#btntambah").attr("disabled", false);
	}
	function update(){
		$("#btnbatale").attr("disabled", true);
        $("#btnupdate").attr("disabled", true);
		let id = $("#txtide").val();
		let nama = $("#txtnamae").val();
		let deskripsi = $("#txtdeskripsie").val();
		let urut = $("#cbourute").val();
		let status = $("#cbostatuse").val();
		let icon = $("#cboicone").val();
        if(id == "" || nama == "" || deskripsi == "" || urut == "" || status == "" || icon == ""){
            swal({title: 'Gagal', text: 'Ada Isian yang Masih Kosong !', icon: 'error',});
            $("#btnbatale").attr("disabled", false);
            $("#btnupdate").attr("disabled", false);
            return;
        }
        swal({text:"Proses Update ...", icon: iconpreloader, button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= BASEURLKU.ucfirst($idf); ?>/edit",
            method: "POST",
            data: {id: id, nama: nama, deskripsi: deskripsi, urut: urut, status: status, icon: icon},
            cache: "false",
            timeout: ajaxtimeout,
            success: function(respon){
                swal.close();
                let data = JSON.parse(atob(respon));
                if(data.kode == "01"){
                    swal({title: "Berhasil", text: data.pesan, icon: "success"}).then((Ok) => {
                        if(Ok){
                            tabel.ajax.reload(null, false);
							$("#modalupdate").modal("hide");
                        }
                    })
                }else{
                    swal({title: "Gagal", text: data.pesan, icon: "error"});
                }
            },
            error: function(){
                swal.close();
                swal({title: 'Gagal', text: 'Respon Gagal dari Server', icon: 'error'});
            }
        });
        $("#btnbatale").attr("disabled", false);
		$("#btnupdate").attr("disabled", false);
	}
	function hapus(el){
		let id = $(el).data("id");
		if(id == ""){
			swal({title: "Gagal", text: "ID Sistem Tidak Terdeteksi", icon: "error"});
			return;
		}
		swal({
			title: 'Hapus Data',
			text: "Anda Yakin Ingin Menghapus Data Ini ?",
			icon: 'warning',
			buttons:{
				confirm: {text : 'Yakin', className : 'btn btn-success'},
				cancel: {visible: true, text: 'Tidak', className: 'btn btn-danger'}
			}
		}).then((Hapuss)=>{
			if(Hapuss){
				swal({text:"Menghapus Data ...", icon: iconpreloader, button: false, closeOnClickOutside: false, closeOnEsc: false});
				$.ajax({
					url: "<?= BASEURLKU.ucfirst($idf); ?>/hapus",
					method: "POST",
					data: {id: id},
					cache: "false",
					timeout: ajaxtimeout,
					success: function(respon){
						swal.close();
						let data = JSON.parse(atob(respon));
						if(data.kode == "01"){
							swal({title: "Berhasil", text: data.pesan, icon: "success"}).then((Ok) => {
								if(Ok){
									tabel.ajax.reload(null, false);
								}
							})
						}else{
							swal({title: "Gagal", text: data.pesan, icon: "error"});
						}
					},
					error: function(){
						swal.close();
						swal({title: 'Gagal', text: 'Respon Gagal dari Server', icon: 'error'});
					}
				});
			}
		});
		
	}
	function filter(el){
		let id = $(el).data("id");
		if(id == ""){
			swal({title: "Gagal", text: "ID Sistem Tidak Terdeteksi", icon: "error"});
			return;
		}
		swal({text:"Menampilkan Data ...", icon: iconpreloader, button: false, closeOnClickOutside: false, closeOnEsc: false});
		$.ajax({
            url: "<?= BASEURLKU.ucfirst($idf); ?>/filter",
            method: "POST",
            data: {id: id},
            cache: "false",
            timeout: ajaxtimeout,
            success: function(respon){
                swal.close();
                let data = JSON.parse(atob(respon));
				console.log(data);
                if(data.kode == "01"){
                    $("#txtide").val(id);
					$("#txtnamae").val(data.nama);
					$("#txtdeskripsie").val(data.deskripsi);
					$("#cbourute").val(data.urut).change();
					$("#cbostatuse").val(data.status).change();
					$("#cboicone").val(data.icon).change();
					$("#modalupdate").modal({backdrop: "static", keyboard: false});
                }else{
                    swal({title: "Gagal", text: data.pesan, icon: "error"});
                }
            },
            error: function(){
                swal.close();
                swal({title: 'Gagal', text: 'Respon Gagal dari Server', icon: 'error'});
            }
        });
	}

</script>
