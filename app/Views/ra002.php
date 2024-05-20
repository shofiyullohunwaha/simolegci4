<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Pengajuan Tera Dan Tera Ulang</h2>
                <h5 class="text-white op-7 mb-2">Pengelolaan Data Pengajuan Tera Dan Tera Ulang</h5>
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
                    <div class="form-row align-items-center mb-4">
                        <div class="col-auto py-2 py-md-0">
                            <label for="startDate">Start Date:</label>
                            <input type="date" id="startDate" class="form-control mb-2">
                        </div>
                        <div class="col-auto py-2 py-md-0">
                            <label for="endDate">End Date:</label>
                            <input type="date" id="endDate" class="form-control mb-2">
                        </div>
                        <div class="col-auto py-2 py-md-0">
                            <button id="filterButton" class="btn btn-primary btn-round">Filter</button>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="tbl-xdt" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Aksi</th>
                                    <th style="width: 20%;">ID Tera</th>
                                    <th style="width: 20%;">ID UTTP</th>
                                    <th style="width: 20%;">ID Tarif</th>
                                    <th style="width: 10%;">Kategori</th>
                                    <th style="width: 10%;">Tempat Sidang</th>
                                    <th style="width: 10%;">Harga</th>
                                    <th style="width: 10%;">Petugas</th>
                                    <th style="width: 10%;">Tanggal Approve</th>
                                    <th style="width: 10%;">Status</th>
                                    <th style="width: 10%;">Alasan</th>
                                    <th style="width: 10%;">SKKHP</th>
                                    <th style="width: 10%;">Harga SKHP</th>
                                    <th style="width: 10%;">Jenis Tera</th>
                                    <th style="width: 15%;">Hasil Tera </th>
                                    <th style="width: 10%;">Tanggal Sidang</th>
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
                <h4 class="modal-title">Form Tambah Pemilik UTTP</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-12 jedaobyek">
                        <label>ID UTTP *</label>
                        <select class="form-control formt select2" id="txtiduttp" style="width: 100%;">
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
                    <div class="form-group col-12 jedaobyek">
                        <label>ID Tarif *</label>
                        <select class="form-control formt select2" id="txtidtarif" style="width: 100%;">
                            <option value=''>Pilih jenis Tarif uttp</option>
                            <?php
                                  if (is_array($dtxtarif) 
                                  && count($dtxtarif) > 0) {
                                      foreach ($dtxtarif as $z) {
                                          echo "<option value='" . $z->id_tarif . "'>" . $z->kategori . "</option>";
                                      }
                                  }
                                ?>
                        </select>

                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Kategori *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtkategori"
                            placeholder="Masukkan Kategori" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Tempat Sidang *</label>
                        <select class="form-control forme select2" id="txttmptsidang" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <option value='Dikantor'>Dikantor</option>
                            <option value='Diluar'>Diluar</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Harga *</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control formt khusus_abjad" id="txtharga"
                                placeholder="Masukkan Harga" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Petugas *</label>
                        <select class="form-control formt select2" id="txtpetugas" style="width: 100%;">
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
                        <label>Tanggal Approve *</label>
                        <input type="datetime-local" class="form-control formt" id="txttglapprove"
                            placeholder="Masukkan Tanggal Approve" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Status *</label>
                        <select class="form-control forme select2" id="txtstatus" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <option value='Sudah '>Sudah</option>
                            <option value='Belum '>Belum</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Alasan *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtalasan"
                            placeholder="Masukkan Alasan" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>SKKHP *</label>
                        <select class="form-control forme select2" id="txtskkhp" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <option value='Ya'>Ya</option>
                            <option value='Tidak'>Tidak</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Harga SKHP *</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" class="form-control formt khusus_abjad" id="txthargaskhp"
                                placeholder="Masukkan Harga SKHP" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Jenis Tera *</label>
                        <select class="form-control forme select2" id="txtjenistera" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <option value='Tera'>Tera</option>
                            <option value='Tera Ulang'>Tera Ulang</option>
                        </select>
                    </div>
                    <!-- <div class="form-group col-6 jedaobyek">
                        <label>Hasil Tera *</label>
                        <input type="text" class="form-control formt " id="txthasiltera"
                            placeholder="Masukkan Hasil Tera " autocomplete="off">
                    </div> -->
                    <div class="form-group col-6 jedaobyek">
                        <label>Tanggal Sidang *</label>
                        <input type="datetime-local" class="form-control formt" id="txttglsidang"
                            placeholder="Masukkan Tanggal Sidang" autocomplete="off">
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
                <h4 class="modal-title">Form Update UTTP</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 jedaobyek">
                        <label>ID Tera *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtterae"
                            placeholder="Masukkan ID tera" readonly autocomplete="off">
                    </div>
                    <div class="form-group col-12 jedaobyek">
                        <label>ID UTTP *</label>
                        <select class="form-control formt select2" id="txtiduttpe" style="width: 100%;">
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
                    <div class="form-group col-12 jedaobyek">
                        <label>ID Tarif *</label>
                        <select class="form-control formt select2" id="txtidtarife" style="width: 100%;">
                            <option value=''>Pilih jenis Tarif uttp</option>
                            <?php
                                  if (is_array($dtxtarif) 
                                  && count($dtxtarif) > 0) {
                                      foreach ($dtxtarif as $z) {
                                          echo "<option value='" . $z->id_tarif . "'>" . $z->kategori . "</option>";
                                      }
                                  }
                                ?>
                        </select>

                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Kategori *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtkategorie"
                            placeholder="Masukkan Kategori" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Tempat Sidang *</label>
                        <select class="form-control forme select2" id="txttmptsidange" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <option value='Dikantor'>Dikantor</option>
                            <option value='Diluar'>Diluar</option>
                        </select>
                    </div>

                    <div class="form-group col-6 jedaobyek">
                        <label>Harga *</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>

                            <input type="text" class="form-control formt khusus_abjad" id="txthargae"
                                placeholder="Masukkan Harga" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Petugas *</label>
                        <select class="form-control formt select2" id="txtpetugase" style="width: 100%;">
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
                        <label>Tanggal Approve *</label>
                        <input type="datetime-local" class="form-control formt" id="txttglapprovee"
                            placeholder="Masukkan Tanggal Approve" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Status *</label>
                        <select class="form-control forme select2" id="txtstatuse" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <option value='Sudah '>Sudah</option>
                            <option value='Belum '>Belum</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Alasan *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtalasane"
                            placeholder="Masukkan Alasan" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>SKKHP *</label>
                        <select class="form-control forme select2" id="txtskkhpe" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <option value='Ya'>Ya</option>
                            <option value='Tidak'>Tidak</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Harga SKHP *</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>

                            <input type="text" class="form-control formt khusus_abjad" id="txthargaskhpe"
                                placeholder="Masukkan Harga SKHP" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Jenis Tera *</label>
                        <select class="form-control forme select2" id="txtjenisterae" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <option value='Tera'>Tera</option>
                            <option value='Tera Ulang'>Tera Ulang</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Hasil Tera *</label>
                        <input type="text" class="form-control formt " id="txthasilterae"
                            placeholder="Masukkan Hasil Tera " autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Tanggal Sidang *</label>
                        <input type="datetime-local" class="form-control formt" id="txttglsidange"
                            placeholder="Masukkan Tanggal Sidang" autocomplete="off">
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
    $("#txtiduttp").val("").change();
    $("#txtidtarif").val("").change();
    $("#txtkategori").val("").change();
    $("#txttmptsidang").val("").change();
    $("#txtpetugas").val("").change();
    $("#txttglapprove").val("").change();
    $("#txtstatus").val("").change();
    $("#txtalasan").val("").change();
    $("#txtskkhp").val("").change();
    $("#txthargaskhp").val("").change();
    $("#txtjenistera").val("").change();
    $("#txthasiltera").val("").change();
    $("#txttglsidang").val("").change();


}

function update() {
    $("#btnbatale").attr("disabled", true);
    $("#btnupdate").attr("disabled", true);
    let id_tera = $("#txterae").val();
    let id_uttp = $("#txtiduttpe").val();
    let id_tarif = $("#txtidtarife").val();
    let kategori = $("#txtkategorie").val();
    let tmpt_sidang = $("#txttmptsidange").val();
    let harga = $("#txthargae").val();
    let id_petugas = $("#txtpetugase").val();
    let tgl_approve = $("#txttglapprovee").val();
    let status = $("#txtstatuse").val();
    let alasan = $("#txtalasane").val();
    let skkhp = $("#txtskkhpe").val();
    let harga_skhp = $("#txthargaskhpe").val();
    let jenis_tera = $("#txtjenisterae").val();
    let hasil_tera = $("#txthasilterae").val();
    let tgl_sidang = $("#txttglsidange").val();

    if (id_tera == "" || id_uttp == "" || id_tarif == "" || kategori == "" || tmpt_sidang == "" || harga == "" ||
        id_petugas == "" || tgl_approve == "" ||
        status == "" || alasan == "" || skkhp == "" || harga_skhp == "" || jenis_tera == "" || hasil_tera == "" ||
        tgl_sidang == "") {
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

    $.ajax({
        url: "<?= BASEURLKU.ucfirst($idf); ?>/edit",
        method: "POST",
        data: {
            id_tera: id_tera,
            id_uttp: id_uttp,
            id_tarif: id_tarif,
            kategori: kategori,
            tmpt_sidang: tmpt_sidang,
            harga: harga,
            id_petugas: id_petugas,
            tgl_approve: tgl_approve,
            status: status,
            alasan: alasan,
            skkhp: skkhp,
            harga_skhp: harga_skhp,
            jenis_tera: jenis_tera,
            hasil_tera: hasil_tera,
            tgl_sidang: tgl_sidang
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


function tambah() {
    $("#btnbatal").attr("disabled", true);
    $("#btntambah").attr("disabled", true);
    let id_uttp = $("#txtiduttp").val();
    let id_tarif = $("#txtidtarif").val();
    let kategori = $("#txtkategori").val();
    let tmpt_sidang = $("#txttmptsidang").val();
    let harga = $("#txtharga").val();
    let id_petugas = $("#txtpetugas").val();
    let tgl_approve = $("#txttglapprove").val();
    let status = $("#txtstatus").val();
    let alasan = $("#txtalasan").val();
    let skkhp = $("#txtskkhp").val();
    let harga_skhp = $("#txthargaskhp").val();
    let jenis_tera = $("#txtjenistera").val();
    let hasil_tera = $("#txthasiltera").val();
    let tgl_sidang = $("#txttglsidang").val();

    if (id_uttp == "" || id_tarif == "" || kategori == "" || tmpt_sidang == "" || harga == "" || id_petugas == "" ||
        tgl_approve == "" || status == "" || alasan == "" || skkhp == "" || harga_skhp == "" || jenis_tera == "" ||
        hasil_tera == "" || tgl_sidang == "") {
        swal({
            title: 'Gagal',
            text: 'Ada isian yang masih kosong!',
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
            id_uttp: id_uttp,
            id_tarif: id_tarif,
            kategori: kategori,
            tmpt_sidang: tmpt_sidang,
            harga: harga,
            id_petugas: id_petugas,
            tgl_approve: tgl_approve,
            status: status,
            alasan: alasan,
            skkhp: skkhp,
            harga_skhp: harga_skhp,
            jenis_tera: jenis_tera,
            hasil_tera: hasil_tera,
            tgl_sidang: tgl_sidang
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
                    icon: "success"
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
            $("#btnbatal").attr("disabled", false);
            $("#btntambah").attr("disabled", false);
        }
    });
}

function hapus(el) {
    let id_tera = $(el).data("id_tera");
    if (id_tera == "") {
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
                    id_tera: id_tera
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
    let id_tera = $(el).data("id_tera");
    if (id_tera == "") {
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
            id_tera: id_tera
        },
        cache: "false",
        success: function(respon) {
            swal.close();
            let data = JSON.parse(atob(respon));
            console.log(data);
            if (data.kode == "01") {
                $("#txtterae").val(id_tera);
                $("#txtiduttpe").val(data.id_uttp);
                $("#txtidtarife").val(data.id_tarif);
                $("#txtkategorie").val(data.kategori);
                $("#txttmptsidange").val(data.tmpt_sidang);
                $("#txthargae").val(data.harga);
                $("#txtpetugase").val(data.petugas);
                $("#txttglapprovee").val(data.tgl_approve);
                $("#txtstatuse").val(data.status);
                $("#txtalasane").val(data.alasan);
                $("#txtskkhpe").val(data.skkhp);
                $("#txthargaskhpe").val(data.harga_skhp);
                $("#txtjenisterae").val(data.jenis_tera);
                $("#txthasilterae").val(data.hasil_tera);
                $("#txttglsidange").val(data.tgl_sidang);

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

function filterData() {
    let startDate = $('#startDate').val();
    let endDate = $('#endDate').val();

    // Check if both start and end dates are selected
    if (!startDate || !endDate) {
        swal({
            title: 'Gagal',
            text: 'Tanggal mulai dan tanggal akhir harus dipilih!',
            icon: 'error',
        });
        return;
    }

    swal({
        text: "Menampilkan Data ...",
        icon: 'info',
        button: false,
        closeOnClickOutside: false,
        closeOnEsc: false
    });

    $.ajax({
        url: "<?= base_url('Ra002/filterData'); ?>",
        type: "POST",
        data: {
            startDate: startDate,
            endDate: endDate
        },
        dataType: 'json',
        success: function(response) {
            if (response.status === '01') {
                // Handle successful response and update the table
                updateDataTable(response.data);
                swal.close();
            } else {
                swal({
                    title: 'Gagal',
                    text: 'Data tidak ditemukan.',
                    icon: 'error',
                });
            }
        },
        error: function(xhr, status, error) {
            swal({
                title: 'Gagal',
                text: 'Gagal mengambil data, coba lagi nanti.',
                icon: 'error',
            });
        }
    });
}




function updateDataTable(data) {
    // Destroy existing DataTable
    if ($.fn.DataTable.isDataTable('#tbl-xdt')) {
        $('#tbl-xdt').DataTable().destroy();
    }

    // Reinitialize DataTable with new data
    $('#tbl-xdt').DataTable({
        data: data,
        columns: [{
                data: null,
                render: function(data, type, row) {
                    let tomboledit =
                        "<button type='button' class='btn btn-icon btn-round btn-primary btn-sm mr-1 mb-1' data-id_tera='" +
                        row.id_tera +
                        "' onclick='filterin(this)'><i class='icon-pencil'></i></button>";
                    let tombolhapus =
                        "<button type='button' class='btn btn-icon btn-round btn-danger btn-sm mr-1 mb-1' data-id_tera='" +
                        row.id_tera + "' onclick='hapus(this)'><i class='icon-trash'></i></button>";
                    return tomboledit + tombolhapus;
                }
            },
            {
                data: "id_tera"
            },
            {
                data: "id_uttp"
            },
            {
                data: "id_tarif"
            },
            {
                data: "kategori"
            },
            {
                data: "tmpt_sidang"
            },
            {
                data: "harga"
            },
            {
                data: "id_petugas"
            },
            {
                data: "tgl_approve"
            },
            {
                data: "status"
            },
            {
                data: "alasan"
            },
            {
                data: "skkhp"
            },
            {
                data: "harga_skhp"
            },
            {
                data: "jenis_tera"
            },
            {
                data: "hasil_tera"
            },
            {
                data: "tgl_sidang"
            }
        ],
        fnDrawCallback: function(oSettings) {
            swal.close();
        }
    });
}


$(document).ready(function() {
    $('#filterButton').on('click', function() {
        filterData();
    });
});
</script>