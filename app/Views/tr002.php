<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Tarif uttp</h2>
                <h5 class="text-white op-7 mb-2">Pengelolaan Data Tarif uttp</h5>
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
                                    <th style="width: 20%;">ID Jenis</th>
                                    <th style="width: 20%;">Nama </th>
                                    <th style="width: 20%;">Harga Diluar </th>
                                    <th style="width: 20%;">Harga Ditempat </th>
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
                <h4 class="modal-title">Form Tambah tarif uttp</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 jedaobyek">
                        <label>ID*</label>
                        <input type="text" class="form-control formt khusus_angka" id="txtid" placeholder="Masukkan ID "
                            maxlength="5" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Nama *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtnama"
                            placeholder="Masukkan Nama uttp" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>jenis Uttp*</label>
                        <select class="form-control formt select2" id="txtjenis" style="width: 100%;">
                            <option value=''>Pilih jenis uttp</option>
                            <?php
                                  if (is_array($dtxjenis) 
                                  && count($dtxjenis) > 0) {
                                      foreach ($dtxjenis as $z) {
                                          echo "<option value='" . $z->id_jenis . "'>" . $z->nama . "</option>";
                                      }
                                  }
                                ?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Harga Diluar *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtluar"
                            placeholder="Masukkan Harga" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Harga Ditempat *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txttempat"
                            placeholder="Masukkan Harga" autocomplete="off">
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
                <h4 class="modal-title">Form Update jenis uttp</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 jedaobyek">
                        <label>ID*</label>
                        <input type="text" class="form-control formt " id="txtide" placeholder="Masukkan ID "
                            maxlength="5" readonly autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Nama *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtnamae"
                            placeholder="Masukkan Nama uttp" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>jenis Uttp*</label>
                        <select class="form-control formt select2" id="txtjenise" style="width: 100%;">
                            <option value=''>Pilih jenis uttp</option>
                            <?php
                                  if (is_array($dtxjenis) 
                                  && count($dtxjenis) > 0) {
                                      foreach ($dtxjenis as $z) {
                                          echo "<option value='" . $z->id_jenis . "'>" . $z->nama . "</option>";
                                      }
                                  }
                                ?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Harga Diluar *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtluare"
                            placeholder="Masukkan Harga" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Harga Ditempat *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txttempate"
                            placeholder="Masukkan Harga" autocomplete="off">
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
    $("#txtnama").val("").change();
    $("#txtjenis").val("").change();
    $("#txtide").val("").change();
    $("#txtluar").val("").change();
    $("#txttempat").val("").change();
}

function tambah() {
    $("#btnbatal").attr("disabled", true);
    $("#btntambah").attr("disabled", true);
    let id_tarif = $("#txtid").val();
    let id_jenis = $("#txtjenis").val();
    let kategori = $("#txtnama").val();
    let harga_diluar = $("#txtluar").val();
    let harga_ditempat = $("#txttempat").val();
    if (id_jenis == "" || kategori == "" || harga_diluar == "" || harga_ditempat == "") {
        swal({
            title: 'Gagal',
            text: 'Ada Isian yang Masih Kosong !',
            icon: 'error',
        });
        $("#btnbatal").attr("disabled", false);
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
            id_tarif: id_tarif,
            id_jenis: id_jenis,
            kategori: kategori,
            harga_diluar: harga_diluar,
            harga_ditempat: harga_ditempat,
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
    $("#btnbatale").attr("disabled", false);
    $("#btnupdate").attr("disabled", false);

}

function update() {
    $("#btnbatale").attr("disabled", true);
    $("#btnupdate").attr("disabled", true);
    let id_tarif = $("#txtide").val();
    let id_jenis = $("#txtjenise").val();
    let kategori = $("#txtnamae").val();
    let harga_diluar = $("#txtluare").val();
    let harga_ditempat = $("#txttempate").val();

    if (id_jenis == "" || kategori == "" || harga_diluar == "" || harga_ditempat == "") {
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
        icon: 'iconpreloader',
        button: false,
        closeOnClickOutside: false,
        closeOnEsc: false
    });

    $.ajax({
        url: "<?= BASEURLKU.ucfirst($idf); ?>/edit",
        method: "POST",
        data: {
            id_tarif: id_tarif,
            id_jenis: id_jenis,
            kategori: kategori,
            harga_diluar: harga_diluar,
            harga_ditempat: harga_ditempat,
        },
        cache: false,
        timeout: ajaxtimeout, // Atur timeout sesuai kebutuhan Anda.
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
        },
        complete: function() {
            $("#btnbatale").attr("disabled", false);
            $("#btnupdate").attr("disabled", false);
        }
    });
}



function hapus(el) {
    let id_tarif = $(el).data("id_tarif");
    if (id_tarif == "") {
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
                    id_tarif: id_tarif
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
    let id_tarif = $(el).data("id_tarif");
    if (id_tarif == "") {
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
            id_tarif: id_tarif
        },
        cache: false, // Tidak perlu menggunakan string "false"
        timeout: ajaxtimeout,
        success: function(respon) {
            swal.close();
            let data = JSON.parse(atob(respon));
            console.log(data);
            if (data.kode == "01") {
                $("#txtide").val(id_tarif);
                $("#txtjenise").val(data.id_jenis);
                $("#txtnamae").val(data.kategori);
                $("#txtluare").val(data.harga_diluar);
                $("#txttempate").val(data.harga_ditempat);
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