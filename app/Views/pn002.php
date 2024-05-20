<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">PENGAWASAN</h2>
                <h5 class="text-white op-7 mb-2">Pengelolaan Data PENGAWASAN</h5>
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
                                    <th style="width: 15%;">ID Pengawasan</th>
                                    <th style="width: 10%;">Jenis Pengawasan</th>
                                    <th style="width: 10%;">ID UTTP Ulang</th>
                                    <th style="width: 10%;">Tanggal Pengawasan</th>
                                    <th style="width: 15%;">Hasil Pengawasan</th>
                                    <th style="width: 10%;">Status</th>
                                    <th style="width: 10%;">ID Petugas</th>
                                    <th style="width: 10%;">ID UTTP Pengawasan</th>
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
                <h4 class="modal-title">Form Tambah PENGAWASAN</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 jedaobyek">
                        <label>Jenis Pengawasan *</label>
                        <select class="form-control forme select2" id="txtjns_pngawasan" style="width: 100%;">
                            <option value=''>Pilih Jenis Pengawasan</option>
                            <option value='Permintaan'>Permintaan</option>
                            <option value='Sendiri'>Sendiri</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>ID UTTP Ulang*</label>
                        <select class="form-control formt select2" id="txtid_uttp_ulang" style="width: 100%;">
                            <option value=''>Pilih jenis uttp ulang</option>
                            <?php
                                  if (is_array($dtxuttp) 
                                  && count($dtxuttp) > 0) {
                                      foreach ($dtxuttp as $z) {
                                          echo "<option value='" . $z->id_uttp . "'>" . $z->merek . "</option>";
                                      }
                                  }
                                ?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Tanggal Pengawasan *</label>
                        <input type="date" class="form-control formt khusus_tanggal" id="txttanggal_pengawasan"
                            placeholder="Masukkan Tanggal Pengawasan" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Hasil Pengawasan *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txthasil_pengawasan"
                            placeholder="Masukkan Hasil Pengawasan" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Status *</label>
                        <select class="form-control forme select2" id="txtstatus" style="width: 100%;">
                            <option value=''>Pilih setatus</option>
                            <option value='Baik'>Baik</option>
                            <option value='Tidak Baik'>Tidak Baik</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>ID Petugas *</label>
                        <select class="form-control formt select2" id="txtid_petugas" style="width: 100%;">
                            <option value=''>Pilih petugas</option>
                            <?php
                                  if (is_array($dtxpegawai) 
                                  && count($dtxpegawai) > 0) {
                                      foreach ($dtxpegawai as $z) {
                                          echo "<option value='" . $z->id_pegawai . "'>" . $z->nama_pegawai . "</option>";
                                      }
                                  }
                                ?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>ID UTTP Pengawasan *</label>
                        <input type="text" class="form-control formt khusus_angka" id="txtid_uttp_pengawasan"
                            placeholder="Masukkan ID UTTP Pengawasan" maxlength="5" autocomplete="off">
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
                <h4 class="modal-title">Form Update PENGAWASAN</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 jedaobyek">
                        <label>ID Pengawasan *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtid_pengawasan"
                            placeholder="Masukkan ID" readonly autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Jenis Pengawasan *</label>
                        <select class="form-control forme select2" id="txtjns_pngawasane" style="width: 100%;">

                            <option value='Permintaan'>Permintaan</option>
                            <option value='Sendiri'>Sendiri</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>ID UTTP Ulang*</label>
                        <select class="form-control formt select2" id="txtid_uttp_ulange" style="width: 100%;">
                            <option value=''>Pilih jenis uttp</option>
                            <?php
                                  if (is_array($dtxuttp) 
                                  && count($dtxuttp) > 0) {
                                      foreach ($dtxuttp as $z) {
                                          echo "<option value='" . $z->id_uttp . "'>" . $z->merek . "</option>";
                                      }
                                  }
                                ?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Tanggal Pengawasan *</label>
                        <input type="date" class="form-control formt khusus_tanggal" id="txttanggal_pengawasane"
                            placeholder="Masukkan Tanggal Pengawasan" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Hasil Pengawasan *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txthasil_pengawasane"
                            placeholder="Masukkan Hasil Pengawasan" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Status *</label>
                        <select class="form-control forme select2" id="txtstatuse" style="width: 100%;">

                            <option value='Baik'>Baik</option>
                            <option value='Tidak Baik'>Tidak Baik</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>ID Petugas *</label>
                        <select class="form-control formt select2" id="txtid_petugase" style="width: 100%;">
                            <option value=''>Pilih ID Petugas</option>
                            <?php
                                  if (is_array($dtxpegawai) 
                                  && count($dtxpegawai) > 0) {
                                      foreach ($dtxpegawai as $z) {
                                          echo "<option value='" . $z->id_pegawai . "'>" . $z->nama_pegawai . "</option>";
                                      }
                                  }
                                ?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>ID UTTP Pengawasan *</label>
                        <input type="text" class="form-control formt khusus_angka" id="txtid_uttp_pengawasane"
                            placeholder="Masukkan ID UTTP Pengawasan" maxlength="5" autocomplete="off">
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
    $("#txtid_pengawasan").val("").change();
    $("#txtjns_pngawasan").val("").change();
    $("#txtid_uttp_ulang").val("").change();
    $("#txttanggal_pengawasan").val("").change();
    $("#txthasil_pengawasan").val("").change();
    $("#txtstatus").val("").change();
    $("#txtid_petugas").val("").change();
    $("#txtid_uttp_pengawasan").val("").change();
}

function tambah() {
    $("#btnbatal").attr("disabled", true);
    $("#btntambah").attr("disabled", true);
    let jns_pengawasan = $("#txtjns_pngawasan").val();
    let id_uttp_ulang = $("#txtid_uttp_ulang").val();
    let tgl_pengawasan = $("#txttanggal_pengawasan").val();
    let hasil_pengawasan = $("#txthasil_pengawasan").val();
    let status = $("#txtstatus").val();
    let id_petugas = $("#txtid_petugas").val();
    let id_uttp_pengawasan = $("#txtid_uttp_pengawasan").val();

    if (
        jns_pengawasan == "" ||
        id_uttp_ulang == "" ||
        tgl_pengawasan == "" ||
        hasil_pengawasan == "" ||
        status == "" ||
        id_petugas == "" ||
        id_uttp_pengawasan == ""
    ) {
        swal({
            title: "Gagal",
            text: "Ada isian yang masih kosong!",
            icon: "error",
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
        closeOnEsc: false,
    });

    $.ajax({
        url: "<?= BASEURLKU.ucfirst($idf); ?>/tambah",
        method: "POST",
        data: {

            jns_pengawasan: jns_pengawasan,
            id_uttp_ulang: id_uttp_ulang,
            tgl_pengawasan: tgl_pengawasan,
            hasil_pengawasan: hasil_pengawasan,
            status: status,
            id_petugas: id_petugas,
            id_uttp_pengawasan: id_uttp_pengawasan,
        },
        cache: false,
        timeout: ajaxtimeout,
        success: function(respon) {
            swal.close();
            let data = JSON.parse(atob(respon));
            if (data.kode == "01") {
                swal({
                    title: "Berhasil",
                    text: data.pesan,
                    icon: "success",
                }).then((Ok) => {
                    if (Ok) {
                        tabel.ajax.reload(null, false);
                        reset();
                        $("#modaltambah").modal("hide");
                    }
                });
            } else {
                swal({
                    title: "Gagal",
                    text: data.pesan,
                    icon: "error",
                });
            }
        },
        error: function() {
            swal.close();
            swal({
                title: "Gagal",
                text: "Respon Gagal dari Server",
                icon: "error",
            });
        },
        complete: function() {
            $("#btnbatal").attr("disabled", false);
            $("#btntambah").attr("disabled", false);
        },
    });
}

function update() {
    $("#btnbatale").attr("disabled", true);
    $("#btnupdate").attr("disabled", true);
    let id_pengawasan = $("#txtid_pengawasan").val();
    let jns_pengawasan = $("#txtjns_pngawasane").val();
    let id_uttp_ulang = $("#txtid_uttp_ulange").val();
    let tgl_pengawasan = $("#txttanggal_pengawasane").val();
    let hasil_pengawasan = $("#txthasil_pengawasane").val();
    let status = $("#txtstatuse").val();
    let id_petugas = $("#txtid_petugase").val();
    let id_uttp_pengawasan = $("#txtid_uttp_pengawasane").val();

    // Check for empty fields
    if (id_pengawasan == "" || jns_pengawasan == "" || id_uttp_ulang == "" || tgl_pengawasan == "" ||
        hasil_pengawasan == "" || status == "" || id_petugas == "" || id_uttp_pengawasan == "") {
        swal({
            title: 'Gagal',
            text: 'Ada isian yang masih kosong!',
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

    // Send AJAX request
    $.ajax({
        url: "<?= BASEURLKU.ucfirst($idf); ?>/edit",
        method: "POST",
        data: {
            id_pengawasan: id_pengawasan,
            jns_pengawasan: jns_pengawasan,
            id_uttp_ulang: id_uttp_ulang,
            tgl_pengawasan: tgl_pengawasan,
            hasil_pengawasan: hasil_pengawasan,
            status: status,
            id_petugas: id_petugas,
            id_uttp_pengawasan: id_uttp_pengawasan
        },
        cache: false,
        timeout: ajaxtimeout,
        success: function(respon) {
            swal.close();
            let data = JSON.parse(atob(respon));
            console.log(data);
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
        error: function(error) {
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
    let id_pengawasan = $(el).data("id_pengawasan");
    if (id_pengawasan == "") {
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
                    id_pengawasan: id_pengawasan
                },
                cache: "false",
                timeout: ajaxtimeout,
                success: function(respon) {
                    swal.close();
                    let data = JSON.parse(atob(respon));
                    console.log(data);
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
    let id_pengawasan = $(el).data("id_pengawasan");
    if (id_pengawasan == "") {
        swal({
            title: "Gagal",
            text: "ID Tera tidak terdeteksi",
            icon: "error"
        });
        return;
    }
    swal({
        text: "Menampilkan Data ...",
        icon: iconpreloader, // Pastikan iconpreloader telah didefinisikan sebelumnya
        button: false,
        closeOnClickOutside: false,
        closeOnEsc: false
    });
    $.ajax({
        url: "<?= BASEURLKU.ucfirst($idf); ?>/filter",
        method: "POST",
        data: {
            id_pengawasan: id_pengawasan
        },
        cache: false,
        success: function(respon) {
            swal.close();
            let data = JSON.parse(atob(respon));
            console.log(data);
            if (data.kode == "01") {
                $("#txtid_pengawasan").val(id_pengawasan);
                $("#txtjns_pengawasane").val(data.jns_pengawasan);
                $("#txtid_uttp_ulange").val(data.id_uttp_ulang);
                $("#txttanggal_pengawasane").val(data.tgl_pengawasan);
                $("#txthasil_pengawasane").val(data.hasil_pengawasan);
                $("#txtstatuse").val(data.status);
                $("#txtid_petugase").val(data.id_petugas);
                $("#txtid_uttp_pengawasane").val(data.id_uttp_pengawasan);

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