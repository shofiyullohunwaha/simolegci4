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
                                    <th style="width: 10%;">ID Penyidikan</th>
                                    <th style="width: 10%;">ID pengawasan</th>
                                    <th style="width: 10%;">Sebab</th>
                                    <th style="width: 10%;">ID UTTP Ulang</th>
                                    <th style="width: 10%;">Tanggal Penyidikan</th>
                                    <th style="width: 20%;">Hasil Penyidikan</th>
                                    <th style="width: 10%;">Status</th>
                                    <th style="width: 10%;">ID Petugas</th>
                                    <th style="width: 10%;">ID UTTP Penyidikan</th>
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
                <h4 class="modal-title">Form Tambah Pengawasan</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 jedaobyek">
                        <label>ID Pengawasan*</label>
                        <select class="form-control formt select2" id="txtid_pengawasan" style="width: 100%;">
                            <option value=''>Pilih Pengawasang</option>
                            <?php
                                  if (is_array($dtxpengawasan) 
                                  && count($dtxpengawasan) > 0) {
                                      foreach ($dtxpengawasan as $z) {
                                          echo "<option value='" . $z->id_pengawasan . "'>" . $z->id_pengawasan . "</option>";
                                      }
                                  }
                                ?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Sebab *</label>
                        <select class="form-control forme select2" id="txtsebab" style="width: 100%;">
                            <option value=''>Pilih Sebab</option>
                            <option value='Tindak lanjut'>Tindak lanjut</option>
                            <option value='Perintah Pusat'>Perintah Pusat</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>ID UTTP Ulang*</label>
                        <select class="form-control formt select2" id="txtid_uttp_ulang" style="width: 100%;">
                            <option value=''>Pilih jenis uttp ulang</option>
                            <?php
                                  if (is_array($dtxuttpengawasan) 
                                  && count($dtxuttpengawasan) > 0) {
                                      foreach ($dtxuttpengawasan as $z) {
                                          echo "<option value='" . $z->id_uttp_pengawasan . "'>" . $z->id_uttp_pengawasan . "</option>";
                                      }
                                  }
                                ?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Tanggal Penyidikan *</label>
                        <input type="date" class="form-control formt khusus_tanggal" id="txttanggal_penyidikan"
                            placeholder="Masukkan Tanggal Penyidikan" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Hasil Penyidikan *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txthasil_penyidikan"
                            placeholder="Masukkan Hasil Penyidikan" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Status *</label>
                        <select class="form-control forme select2" id="txtstatus" style="width: 100%;">
                            <option value=''>Pilih status</option>
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
                        <label>ID UTTP Penyidikan *</label>
                        <input type="text" class="form-control formt khusus_angka" id="txtid_uttp_penyidikan"
                            placeholder="Masukkan ID UTTP Penyidikan" maxlength="5" autocomplete="off">
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
                <h4 class="modal-title">Form Update Penyidikan</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 jedaobyek">
                        <label>ID Penyidikan *</label>
                        <input type="text" class="form-control formt khusus_angka" id="txtid_penyidikane"
                            placeholder="Masukkan ID UTTP Penyidikan" maxlength="5" readonly autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>ID Pengawasan*</label>
                        <select class="form-control formt select2" id="txtid_pengawasane" style="width: 100%;">
                            <option value=''>Pilih Pengawasang</option>
                            <?php
                                  if (is_array($dtxpengawasan) 
                                  && count($dtxpengawasan) > 0) {
                                      foreach ($dtxpengawasan as $z) {
                                          echo "<option value='" . $z->id_pengawasan . "'>" . $z->id_pengawasan . "</option>";
                                      }
                                  }
                                ?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Sebab *</label>
                        <select class="form-control forme select2" id="txtsebabe" style="width: 100%;">

                            <option value='Tindak lanjut'>Tindak lanjut</option>
                            <option value='Perintah Pusat'>Perintah Pusat</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>ID UTTP Ulang*</label>
                        <select class="form-control formt select2" id="txtid_uttp_ulange" style="width: 100%;">
                            <option value=''>Pilih jenis uttp ulang</option>
                            <?php
                                  if (is_array($dtxuttpengawasan) 
                                  && count($dtxuttpengawasan) > 0) {
                                      foreach ($dtxuttpengawasan as $z) {
                                          echo "<option value='" . $z->id_uttp_pengawasan . "'>" . $z->id_uttp_pengawasan . "</option>";
                                      }
                                  }
                                ?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Tanggal Penyidikan *</label>
                        <input type="date" class="form-control formt khusus_tanggal" id="txttanggal_penyidikane"
                            placeholder="Masukkan Tanggal Penyidikan" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Hasil Penyidikan *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txthasil_penyidikane"
                            placeholder="Masukkan Hasil Penyidikan" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Status *</label>
                        <select class="form-control forme select2" id="txtstatuse" style="width: 100%;">
                            <option value=''>Pilih status</option>
                            <option value='Baik'>Baik</option>
                            <option value='Tidak Baik'>Tidak Baik</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>ID Petugas *</label>
                        <select class="form-control formt select2" id="txtid_petugase" style="width: 100%;">
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
                        <label>ID UTTP Penyidikan *</label>
                        <input type="text" class="form-control formt khusus_angka" id="txtid_uttp_penyidikane"
                            placeholder="Masukkan ID UTTP Penyidikan" maxlength="5" autocomplete="off">
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
    $("#txtid_pengawasane").val("").change();
    $("#txtsebab").val("").change();
    $("#txtid_uttp_ulang").val("").change();
    $("#txttanggal_penyidikan").val("").change();
    $("#txthasil_penyidikan").val("").change();
    $("#txtstatus").val("").change();
    $("#txtid_petugas").val("").change();
    $("#txtid_uttp_penyidikan").val("").change();
}

function tambah() {
    $("#btnbatal").attr("disabled", true);
    $("#btntambah").attr("disabled", true);
    let id_pengawasan = $("#txtid_pengawasan").val();
    let sebab = $("#txtsebab").val();
    let id_uttp_pengawasan = $("#txtid_uttp_ulang").val();
    let tgl_penyidikan = $("#txttanggal_penyidikan").val();
    let hasil_penyidikan = $("#txthasil_penyidikan").val();
    let status = $("#txtstatus").val();
    let id_petugas = $("#txtid_petugas").val();
    let id_uttp_penyidikan = $("#txtid_uttp_penyidikan").val();

    if (
        id_pengawasan == "" ||
        sebab == "" ||
        id_uttp_pengawasan == "" ||
        tgl_penyidikan == "" ||
        hasil_penyidikan == "" ||
        status == "" ||
        id_petugas == "" ||
        id_uttp_penyidikan == ""
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
            id_pengawasan: id_pengawasan,
            sebab: sebab,
            id_uttp_pengawasan: id_uttp_pengawasan,
            tgl_penyidikan: tgl_penyidikan,
            hasil_penyidikan: hasil_penyidikan,
            status: status,
            id_petugas: id_petugas,
            id_uttp_penyidikan: id_uttp_penyidikan,
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

function filterin(el) {
    let id_penyidikan = $(el).data("id_penyidikan");
    if (id_penyidikan == "") {
        swal({
            title: "Gagal",
            text: "ID Penyidikan tidak terdeteksi",
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
            id_penyidikan: id_penyidikan
        },
        cache: false,
        success: function(respon) {
            swal.close();
            let data = JSON.parse(atob(respon));
            console.log(data);
            if (data.kode == "01") {
                $("#txtid_penyidikane").val(id_penyidikan);
                $("#txtid_pengawasane").val(data.id_pengawasan);
                $("#txtsebabe").val(data.sebab);
                $("#txtid_uttp_ulange").val(data.id_uttp_pengawasan);
                $("#txttanggal_penyidikane").val(data.tgl_penyidikan);
                $("#txthasil_penyidikane").val(data.hasil_penyidikan);
                $("#txtstatuse").val(data.status);
                $("#txtid_petugase").val(data.id_petugas);
                $("#txtid_uttp_penyidikane").val(data.id_uttp_penyidikan);

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

function update() {
    $("#btnbatale").attr("disabled", true);
    $("#btnupdate").attr("disabled", true);
    let id_penyidikan = $("#txtid_penyidikane").val();
    let id_pengawasan = $("#txtid_pengawasane").val();
    let sebab = $("#txtsebabe").val();
    let id_uttp_pengawasan = $("#txtid_uttp_ulange").val();
    let tgl_penyidikan = $("#txttanggal_penyidikane").val();
    let hasil_penyidikan = $("#txthasil_penyidikane").val();
    let status = $("#txtstatuse").val();
    let id_petugas = $("#txtid_petugase").val();
    let id_uttp_penyidikan = $("#txtid_uttp_penyidikane").val();


    // Check for empty fields
    if (id_penyidikan == "" || id_pengawasan == "" || sebab == "" || id_uttp_pengawasan == "" ||
        tgl_penyidikan == "" || hasil_penyidikan == "" || status == "" || id_petugas == "" || id_uttp_penyidikan == ""
    ) {
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
            id_penyidikan: id_penyidikan,
            id_pengawasan: id_pengawasan,
            sebab: sebab,
            id_uttp_pengawasan: id_uttp_pengawasan,
            tgl_penyidikan: tgl_penyidikan,
            hasil_penyidikan: hasil_penyidikan,
            status: status,
            id_petugas: id_petugas,
            id_uttp_penyidikan: id_uttp_penyidikan
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
    let id_penyidikan = $(el).data("id_penyidikan");
    if (id_penyidikan == "") {
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
                    id_penyidikan: id_penyidikan
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
</script>