<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Form</h2>
                <h5 class="text-white op-7 mb-2">Pengelolaan Data Form</h5>
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
                                    <th style="width: 10%;">Aksi</th>
                                    <th style="width: 10%;">ID</th>
                                    <th style="width: 30%;">Nama</th>
                                    <th style="width: 20%;">Menu</th>
                                    <th style="width: 15%;">Sistem</th>
                                    <th style="width: 10%;">Bentuk</th>
                                    <th style="width: 5%;">Tampil</th>
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
                <h4 class="modal-title">Form Tambah Form</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 jedaobyek">
                        <label>ID Form*</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtid"
                            placeholder="Masukkan ID Form" maxlength="5" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Nama Form*</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtnama"
                            placeholder="Masukkan Nama Form" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Menu*</label>
                        <select class="form-control formt select2" id="cbomenu" style="width: 100%;">
                            <?php
								if(is_array($dtxmenu)){
									if(count($dtxmenu)>0){
										foreach($dtxmenu as $z){
											echo "<option value='".$z->id."'>".$z->nama."</option>";
										}
									}
								}
							?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Sistem*</label>
                        <select class="form-control formt select2" id="cbosistem" style="width: 100%;">
                            <?php
								if(is_array($dtxsistem)){
									if(count($dtxsistem)>0){
										foreach($dtxsistem as $z){
											echo "<option value='".$z->id."'>".$z->nama."</option>";
										}
									}
								}
							?>
                        </select>
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
                        <select class="form-control formt select2" id="cboicon"
                            onchange="previewicon('cboicon','blokicon')" style="width: 100%;"></select>
                    </div>
                    <div class="form-group col-3 jedaobyek text-center" id="blokicon" style="font-size: 55px;"></div>
                    <div class="form-group col-3 jedaobyek">
                        <label>Tampil*</label>
                        <select class="form-control formt" id="cbotampil">
                            <option value='Y'>Ya</option>
                            <option value='N'>Tidak</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnbatal" class="btn btn-secondary waves-effect waves-light"
                    data-dismiss="modal">Batal</button>
                <button type="button" id="btnreset" class="btn btn-danger waves-effect waves-light"
                    onclick="reset()">Reset</button>
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
                        <label>ID Form*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txtide"
                            placeholder="Masukkan ID Form" maxlength="5" readonly autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Nama Form*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txtnamae"
                            placeholder="Masukkan Nama Form" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Menu*</label>
                        <select class="form-control forme select2" id="cbomenue" style="width: 100%;">
                            <?php
								if(is_array($dtxmenu)){
									if(count($dtxmenu)>0){
										foreach($dtxmenu as $z){
											echo "<option value='".$z->id."'>".$z->nama."</option>";
										}
									}
								}
							?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Sistem*</label>
                        <select class="form-control forme select2" id="cbosisteme" style="width: 100%;">
                            <?php
								if(is_array($dtxsistem)){
									if(count($dtxsistem)>0){
										foreach($dtxsistem as $z){
											echo "<option value='".$z->id."'>".$z->nama."</option>";
										}
									}
								}
							?>
                        </select>
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
                        <select class="form-control forme select2" id="cboicone"
                            onchange="previewicon('cboicone','blokicone')" style="width: 100%;"></select>
                    </div>
                    <div class="form-group col-3 jedaobyek text-center" id="blokicone" style="font-size: 55px;"></div>
                    <div class="form-group col-3 jedaobyek">
                        <label>Tampil*</label>
                        <select class="form-control forme" id="cbotampile">
                            <option value='Y'>Ya</option>
                            <option value='N'>Tidak</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnbatale" class="btn btn-secondary waves-effect waves-light"
                    data-dismiss="modal">Batal</button>
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
swal({
    text: "Menampilkan Data ...",
    icon: iconpreloader,
    button: false,
    closeOnClickOutside: false,
    closeOnEsc: false
});
let tabel = $('#tbl-xdt').DataTable({
    "ajax": "<?= BASEURLKU.ucfirst($idf); ?>/data",
    "fnDrawCallback": function(oSettings) {
        swal.close();
    }
});
listicon();

function listicon() {
    let hasil = "";
    for (x of daftaricon) {
        hasil += `<option value="${x}">${x}</option>`;
    }
    $("#cboicon").html(hasil);
    $("#cboicone").html(hasil);
}

function previewicon(id, tujuan) {
    let nilai = $("#" + id).val();
    $("#" + tujuan).html(`<i class="${nilai}"></i>`);
}

function refreshdata() {
    swal({
        text: "Menampilkan Data ...",
        icon: iconpreloader,
        button: false,
        closeOnClickOutside: false,
        closeOnEsc: false
    });
    tabel.ajax.reload(null, false);
}
reset();

function reset() {
    $(".formt").val("");
    $("#cbourut").val("1").change();
    $("#cbostatus").val("Y").change();
    $("#cboicon").val("icon-user").change();
    $("#cbotampil").val("Y").change();
}

function tambah() {
    $("#btnbatal").attr("disabled", true);
    $("#btnreset").attr("disabled", true);
    $("#btntambah").attr("disabled", true);
    let id = $("#txtid").val();
    let nama = $("#txtnama").val();
    let menu = $("#cbomenu").val();
    let sistem = $("#cbosistem").val();
    let urut = $("#cbourut").val();
    let status = $("#cbostatus").val();
    let icon = $("#cboicon").val();
    let tampil = $("#cbotampil").val();
    if (id == "" || nama == "" || menu == "" || sistem == "" || urut == "" || status == "" || icon == "" || tampil ==
        "") {
        swal({
            title: 'Gagal',
            text: 'Ada Isian yang Masih Kosong !',
            icon: 'error',
        });
        $("#btnbatal").attr("disabled", false);
        $("#btnreset").attr("disabled", false);
        $("#btntambah").attr("disabled", false);
        return;
    }
    swal({
        text: "Proses Tambah ...",
        icon: iconpreloader,
        button: false,
        closeOnClickOutside: false,
        closeOnEsc: false
    });
    $.ajax({
        url: "<?= BASEURLKU.ucfirst($idf); ?>/tambah",
        method: "POST",
        data: {
            id: id,
            nama: nama,
            menu: menu,
            sistem: sistem,
            urut: urut,
            status: status,
            icon: icon,
            tampil: tampil
        },
        cache: "false",
        timeout: ajaxtimeout,
        success: function(respon) {
            swal.close();
            let data = JSON.parse(atob(respon));
            if (data.kode == "01") {
                swal({
                    title: "Berhasil",
                    text: data.pesan,
                    icon: "success"
                }).then((Ok) => {
                    if (Ok) {
                        tabel.ajax.reload(null, false);
                        reset();
                        $("#modaltambah").modal("hide");
                    }
                })
            } else {
                swal({
                    title: "Gagal",
                    text: data.pesan,
                    icon: "error"
                });
            }
        },
        error: function() {
            swal.close();
            swal({
                title: 'Gagal',
                text: 'Respon Gagal dari Server',
                icon: 'error'
            });
        }
    });
    $("#btnbatal").attr("disabled", false);
    $("#btnreset").attr("disabled", false);
    $("#btntambah").attr("disabled", false);
}

function update() {
    $("#btnbatale").attr("disabled", true);
    $("#btnupdate").attr("disabled", true);
    let id = $("#txtide").val();
    let nama = $("#txtnamae").val();
    let menu = $("#cbomenue").val();
    let sistem = $("#cbosisteme").val();
    let urut = $("#cbourute").val();
    let status = $("#cbostatuse").val();
    let icon = $("#cboicone").val();
    let tampil = $("#cbotampile").val();
    if (id == "" || nama == "" || menu == "" || sistem == "" || urut == "" || status == "" || icon == "" || tampil ==
        "") {
        swal({
            title: 'Gagal',
            text: 'Ada Isian yang Masih Kosong !',
            icon: 'error',
        });
        $("#btnbatale").attr("disabled", false);
        $("#btnupdate").attr("disabled", false);
        return;
    }
    swal({
        text: "Proses Update ...",
        icon: iconpreloader,
        button: false,
        closeOnClickOutside: false,
        closeOnEsc: false
    });
    $.ajax({
        url: "<?= BASEURLKU.ucfirst($idf); ?>/edit",
        method: "POST",
        data: {
            id: id,
            nama: nama,
            menu: menu,
            sistem: sistem,
            urut: urut,
            status: status,
            icon: icon,
            tampil: tampil
        },
        cache: "false",
        timeout: ajaxtimeout,
        success: function(respon) {
            swal.close();
            let data = JSON.parse(atob(respon));
            if (data.kode == "01") {
                swal({
                    title: "Berhasil",
                    text: data.pesan,
                    icon: "success"
                }).then((Ok) => {
                    if (Ok) {
                        tabel.ajax.reload(null, false);
                        $("#modalupdate").modal("hide");
                    }
                })
            } else {
                swal({
                    title: "Gagal",
                    text: data.pesan,
                    icon: "error"
                });
            }
        },
        error: function() {
            swal.close();
            swal({
                title: 'Gagal',
                text: 'Respon Gagal dari Server',
                icon: 'error'
            });
        }
    });
    $("#btnbatale").attr("disabled", false);
    $("#btnupdate").attr("disabled", false);
}

function hapus(el) {
    let id = $(el).data("id");
    if (id == "") {
        swal({
            title: "Gagal",
            text: "ID Form Tidak Terdeteksi",
            icon: "error"
        });
        return;
    }
    swal({
        title: 'Hapus Data',
        text: "Anda Yakin Ingin Menghapus Data Ini ?",
        icon: 'warning',
        buttons: {
            confirm: {
                text: 'Yakin',
                className: 'btn btn-success'
            },
            cancel: {
                visible: true,
                text: 'Tidak',
                className: 'btn btn-danger'
            }
        }
    }).then((Hapuss) => {
        if (Hapuss) {
            swal({
                text: "Menghapus Data ...",
                icon: iconpreloader,
                button: false,
                closeOnClickOutside: false,
                closeOnEsc: false
            });
            $.ajax({
                url: "<?= BASEURLKU.ucfirst($idf); ?>/hapus",
                method: "POST",
                data: {
                    id: id
                },
                cache: "false",
                timeout: ajaxtimeout,
                success: function(respon) {
                    swal.close();
                    let data = JSON.parse(atob(respon));
                    if (data.kode == "01") {
                        swal({
                            title: "Berhasil",
                            text: data.pesan,
                            icon: "success"
                        }).then((Ok) => {
                            if (Ok) {
                                tabel.ajax.reload(null, false);
                            }
                        })
                    } else {
                        swal({
                            title: "Gagal",
                            text: data.pesan,
                            icon: "error"
                        });
                    }
                },
                error: function() {
                    swal.close();
                    swal({
                        title: 'Gagal',
                        text: 'Respon Gagal dari Server',
                        icon: 'error'
                    });
                }
            });
        }
    });

}

function filter(el) {
    let id = $(el).data("id");
    if (id == "") {
        swal({
            title: "Gagal",
            text: "ID Form Tidak Terdeteksi",
            icon: "error"
        });
        return;
    }
    swal({
        text: "Menampilkan Data ...",
        icon: iconpreloader,
        button: false,
        closeOnClickOutside: false,
        closeOnEsc: false
    });
    $.ajax({
        url: "<?= BASEURLKU.ucfirst($idf); ?>/filter",
        method: "POST",
        data: {
            id: id
        },
        cache: "false",
        timeout: ajaxtimeout,
        success: function(respon) {
            swal.close();
            let data = JSON.parse(atob(respon));
            console.log(data);
            if (data.kode == "01") {
                $("#txtide").val(id);
                $("#txtnamae").val(data.nama);
                $("#cbomenue").val(data.idmenu).change();
                $("#cbosisteme").val(data.idsistem).change();
                $("#cbourute").val(data.urut).change();
                $("#cbostatuse").val(data.status).change();
                $("#cboicone").val(data.icon).change();
                $("#cbotampile").val(data.tampil).change();
                $("#modalupdate").modal({
                    backdrop: "static",
                    keyboard: false
                });
            } else {
                swal({
                    title: "Gagal",
                    text: data.pesan,
                    icon: "error"
                });
            }
        },
        error: function() {
            swal.close();
            swal({
                title: 'Gagal',
                text: 'Respon Gagal dari Server',
                icon: 'error'
            });
        }
    });
}
</script>