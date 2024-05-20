<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">DESA</h2>
                <h5 class="text-white op-7 mb-2">Pengelolaan Data DESA</h5>
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
                                    <th style="width: 20%;">ID</th>
                                    <th style="width: 70%;">Nama DESA</th>
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
                <h4 class="modal-title">Form Tambah PROVISI</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 jedaobyek">
                        <label>ID DESA*</label>
                        <input type="text" class="form-control formt khusus_angka" id="txtid"
                            placeholder="Masukkan ID Menu" maxlength="5" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Nama *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtnama"
                            placeholder="Masukkan Nama Menu" autocomplete="off">
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
                <h4 class="modal-title">Form Update DESA</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 jedaobyek">
                        <label>ID Menu*</label>
                        <input type="text" class="form-control forme khusus_angka" id="txtide"
                            placeholder="Masukkan ID Menu" maxlength="5" readonly autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Nama *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtnamae"
                            placeholder="Masukkan Nama Menu" autocomplete="off">
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
    $("#txtid").val("").change();
    $("#txtnama").val("").change();
}

function tambah() {
    $("#btnbatal").attr("disabled", true);
    $("#btnreset").attr("disabled", true);
    $("#btntambah").attr("disabled", true);
    let id_desa = $("#txtid").val();
    let nama = $("#txtnama").val();

    if (id_desa == "" || nama == "") {
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
            id_desa: id_desa,
            nama: nama,

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
    let id_desa = $("#txtide").val();
    let nama = $("#txtnamae").val();

    // let icon = $("#cboicone").val();
    if (id_desa == "" || nama == "") {
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
            id_desa: id_desa,
            nama: nama,

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
    let id_desa = $(el).data("id_desa");
    if (id_desa == "") {
        swal({
            title: "Gagal",
            text: "ID Menu Tidak Terdeteksi",
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
                    id_desa: id_desa
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

function filterin(el) {
    let id_desa = $(el).data("id_desa");
    if (id_desa == "") {
        swal({
            title: "Gagal",
            text: "ID DESA Tidak Terdeteksi",
            icon: "error"
        });
        return;
    }
    swal({
        text: "Menampilkan Data ...",
        icon: iconpreloader, // Pastikan iconpreloader telah didefinisikan
        button: false,
        closeOnClickOutside: false,
        closeOnEsc: false
    });
    $.ajax({
        url: "<?= BASEURLKU.ucfirst($idf); ?>/filter",
        method: "POST",
        data: {
            id_desa: id_desa

        },
        cache: "false", // Ubah "false" menjadi false
        timeout: ajaxtimeout, // Pastikan ajaxtimeout telah didefinisikan
        success: function(respon) {
            swal.close();
            let data = JSON.parse(atob(respon));
            console.log(data);
            if (data.kode == "01") {
                $("#txtide").val(id_desa);
                $("#txtname").val(data.nama);

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