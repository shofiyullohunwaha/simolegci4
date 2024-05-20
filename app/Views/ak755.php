<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Akun</h2>
                <h5 class="text-white op-7 mb-2">Pengelolaan Data Akun</h5>
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
                                    <th style="width: 15%;">Aksi</th>
                                    <th style="width: 10%;">ID</th>
                                    <th style="width: 30%;">Nama</th>
                                    <th style="width: 15%;">Username</th>
                                    <th style="width: 20%;">Level</th>
                                    <th style="width: 10%;">Status</th>
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
                <h4 class="modal-title">Form Tambah Akun</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" class="form-control formt khusus_abjad" id="txtid"
                        placeholder="Otomatis By Sistem" maxlength="13" autocomplete="off" readonly>
                    <div class="form-group col-6 jedaobyek">
                        <label>Username*</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtusername"
                            placeholder="Masukkan Username Akun" maxlength="15" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Nama*</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtnama"
                            placeholder="Masukkan Nama Lengkap Akun" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Level*</label>
                        <select class="form-control formt select2" id="cbolevel" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <?php
								if(is_array($dtxlevel)){
									if(count($dtxlevel)>0){
										foreach($dtxlevel as $z){
											if($z->status == "Y"){
												echo "<option value='".$z->id."'>".$z->nama."</option>";
											}
										}
									}
								}
							?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Status*</label>
                        <select class="form-control formt select2" id="cbostatus" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <option value='Y'>Aktif</option>
                            <option value='N'>Tidak Aktif</option>
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
                <h4 class="modal-title">Form Update Akun</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" class="form-control forme khusus_abjad" id="txtide"
                        placeholder="Otomatis By Sistem" maxlength="13" autocomplete="off" readonly>
                    <div class="form-group col-6 jedaobyek">
                        <label>Username*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txtusernamee"
                            placeholder="Masukkan Username Akun" maxlength="15" autocomplete="off" readonly>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Nama*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txtnamae"
                            placeholder="Masukkan Nama Lengkap Akun" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Level*</label>
                        <select class="form-control forme select2" id="cbolevele" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <?php
								if(is_array($dtxlevel)){
									if(count($dtxlevel)>0){
										foreach($dtxlevel as $z){
											if($z->status == "Y"){
												echo "<option value='".$z->id."'>".$z->nama."</option>";
											}
										}
									}
								}
							?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Status*</label>
                        <select class="form-control forme select2" id="cbostatuse" style="width: 100%;">
                            <option value='Y'>Aktif</option>
                            <option value='N'>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnbatal" class="btn btn-secondary waves-effect waves-light"
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
    "oSearch": {
        "sSearch": " "
    },
    "fnDrawCallback": function(oSettings) {
        swal.close();
    }
});

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
    $("#cbolevel").val("").change();
    $("#cbostatus").val("").change();
}

function tambah() {
    $("#btnbatal").attr("disabled", true);
    $("#btnreset").attr("disabled", true);
    $("#btntambah").attr("disabled", true);
    let username = $("#txtusername").val();
    let nama = $("#txtnama").val();
    let level = $("#cbolevel").val();
    let status = $("#cbostatus").val();
    if (username == "" || nama == "" || level == "" || status == "") {
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
            username: username,
            nama: nama,
            level: level,
            status: status
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
    let username = $("#txtusernamee").val();
    let level = $("#cbolevele").val();
    let status = $("#cbostatuse").val();
    if (username == "" || nama == "" || level == "" || status == "") {
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
            level: level,
            status: status
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
            text: "ID Akun Tidak Terdeteksi",
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

function resetpass(el) {
    let id = $(el).data("id");
    if (id == "") {
        swal({
            title: "Gagal",
            text: "ID Akun Tidak Terdeteksi",
            icon: "error"
        });
        return;
    }
    swal({
        title: 'Reset Password',
        text: "Anda Yakin Ingin Reset Password User Ini ?",
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
                text: "Proses Reset ...",
                icon: iconpreloader,
                button: false,
                closeOnClickOutside: false,
                closeOnEsc: false
            });
            $.ajax({
                url: "<?= BASEURLKU.ucfirst($idf); ?>/reset",
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
                        })
                        window.location = "";
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
            text: "ID Akun Tidak Terdeteksi",
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
            if (data.kode == "01") {
                $("#txtide").val(id);
                $("#txtusernamee").val(data.username);
                $("#txtnamae").val(data.nama);
                $("#cbolevele").val(data.level).change();
                $("#cbostatuse").val(data.status).change();
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