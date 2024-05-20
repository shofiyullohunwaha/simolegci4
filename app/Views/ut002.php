<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">DATA UTTP</h2>
                <h5 class="text-white op-7 mb-2">Pengelolaan DATA UTTP</h5>
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
                                    <th style="width: 10%;">ID UTTP</th>
                                    <th style="width: 10%;">ID Jenis</th>
                                    <th style="width: 10%;"> Merk</th>
                                    <th style="width: 10%;"> Type Model</th>
                                    <th style="width: 5%;">No Seri</th>
                                    <th style="width: 5%;">kapasitas</th>
                                    <th style="width: 10%;">Buatan</th>
                                    <th style="width: 5%;">Koofisen</th>
                                    <th style="width: 10%;">Jumlah Nosel</th>
                                    <th style="width: 10%;">Medium</th>
                                    <th style="width: 10%;">ID_pemilik</th>
                                    <th style="width: 10%;">Tanggal Beli</th>
                                    <th style="width: 10%;">Sudah Tera</th>
                                    <!-- <th style="width: 10%;">ID_Pemilik</th> -->
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
                <h4 class="modal-title">Form Tambah UTTP</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 jedaobyek">
                        <label>ID jenis*</label>
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
                        <label>Merek*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txtmerek"
                            placeholder=" Masukan Merek Alat" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Type Model*</label>
                        <input type="text" class="form-control forme" id="txtmodel" placeholder="Masukan Type model"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>No Seri*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txtseri"
                            placeholder="Masukkan Nomer Seri Alat" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Kapasitas*</label>
                        <input type="text" class="form-control forme" id="txtkapasitas" placeholder="Buatan Alat"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Buatan*</label>
                        <input type="text" class="form-control forme" id="txtbuatan" placeholder="Buatan Alat"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Koofisien*</label>
                        <select class="form-control forme select2" id="txtkoofesien" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <option value='Ya'>Ya</option>
                            <option value='Tidak'>Tidak</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Jumlah Nosel*</label>
                        <input type="text" class="form-control forme" id="txtnosel" placeholder="Masukkan Jumlah Nosel"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Medium*</label>
                        <input type="text" class="form-control forme" id="txtmedium" placeholder="Masukkan Medium"
                            autocomplete="off">
                    </div>

                    <div class="form-group col-6 jedaobyek">
                        <label>Tanggal Beli*</label>
                        <input type="date" class="form-control forme" id="txtbeli" placeholder="Masukkan Tanggal Beli"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Sudah Tera*</label>
                        <select class="form-control forme select2" id="txttera" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <option value='Sudah'>Sudah</option>
                            <option value='Belum'>Belum</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Pemilik*</label>
                        <input type="number" class="form-control forme" id="txtpemilik"
                            placeholder="Masukkan id_pemilik" autocomplete="off">
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
                        <label>ID uttp*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txtuttp"
                            placeholder=" Masukan Merek Alat" readonly autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>ID jenis*</label>
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
                        <label>Merek*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txtmereke"
                            placeholder=" Masukan Merek Alat" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Type Model*</label>
                        <input type="text" class="form-control forme" id="txtmodele" placeholder="Masukan Type model"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>No Seri*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txtserie"
                            placeholder="Masukkan Nomer Seri Alat" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Kapasitas*</label>
                        <input type="text" class="form-control forme" id="txtkapasitase" placeholder="Buatan Alat"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Buatan*</label>
                        <input type="text" class="form-control forme" id="txtbuatane" placeholder="Buatan Alat"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Koofisien*</label>
                        <select class="form-control forme select2" id="txtkoofesiene" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <option value='Ya'>Ya</option>
                            <option value='Tidak'>Tidak</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Jumlah Nosel*</label>
                        <input type="text" class="form-control forme" id="txtnosele" placeholder="Masukkan Jumlah Nosel"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Medium*</label>
                        <input type="text" class="form-control forme" id="txtmediume" placeholder="Masukkan Medium"
                            autocomplete="off">
                    </div>

                    <div class="form-group col-6 jedaobyek">
                        <label>Tanggal Beli*</label>
                        <input type="date" class="form-control forme" id="txtbelie" placeholder="Masukkan Tanggal Beli"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Sudah Tera*</label>
                        <select class="form-control forme select2" id="txtterae" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <option value='Sudah'>Sudah</option>
                            <option value='Belum'>Belum</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Pemilik*</label>
                        <input type="number" class="form-control forme" id="txtpemilike"
                            placeholder="Masukkan id_pemilik" autocomplete="off">
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
    $(".forme").val("");
    $("#txtmerek").val("").change();
    $("#txtjenis").val("").change();
    $("#txtmodel").val("").change();
    $("#txtseri").val("").change();
    $("#txtkapasitas").val("").change();
    $("#txtbuatan").val("").change();
    $("#txtkoofesien").val("").change();
    $("#txtnosel").val("").change();
    $("#txtmedium").val("").change();
    $("#txtpemilik").val("").change();
    $("#txtbeli").val("").change();
    $("#txttera").val("").change();

}

function tambah() {
    $("#btnbatal").attr("disabled", true);
    $("#btntambah").attr("disabled", true);
    let id_jenis = $("#txtjenis").val();
    let merek = $("#txtmerek").val();
    let type_model = $("#txtmodel").val();
    let no_seri = $("#txtseri").val();
    let kapasitas = $("#txtkapasitas").val();
    let buatan = $("#txtbuatan").val();
    let koofesien = $("#txtkoofesien").val();
    let jumlah_nosel = $("#txtnosel").val();
    let medium = $("#txtmedium").val();
    // let id_buat = $("#txtakun").val();
    let tgl_beli = $("#txtbeli").val();
    let sudah_tera = $("#txttera").val();
    let id_pemilik = $("#txtpemilik").val();

    if (id_jenis == "" || merek == "" || type_model == "" || no_seri == "" || kapasitas == "" || buatan == "" ||
        koofesien == "" || jumlah_nosel == "" || medium == "" || id_pemilik == "" || sudah_tera == "" || tgl_beli == ""
    ) {
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
            id_jenis: id_jenis,
            merek: merek,
            type_model: type_model,
            no_seri: no_seri,
            kapasitas: kapasitas,
            buatan: buatan,
            koofesien: koofesien,
            jumlah_nosel: jumlah_nosel,
            medium: medium,
            // id_buat: id_buat,
            id_pemilik: id_pemilik,
            tgl_beli: tgl_beli,
            sudah_tera: sudah_tera,

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

function filterin(el) {
    let id_uttp = $(el).data("id_uttp");
    if (id_uttp == "") {
        swal({
            title: "Gagal",
            text: "ID UTTP Tidak Terdeteksi",
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
            id_uttp: id_uttp
        },
        cache: false,
        timeout: ajaxtimeout,
        success: function(respon) {
            swal.close();
            let data = JSON.parse(atob(respon));
            console.log(data);
            if (data.kode == "01") {
                $("#txtuttp").val(id_uttp);
                $("#txtjenise").val(data.id_jenis);
                $("#txtmereke").val(data.merek);
                $("#txtmodele").val(data.type_model);
                $("#txtserie").val(data.no_seri);
                $("#txtkapasitase").val(data.kapasitas);
                $("#txtbuatane").val(data.buatan);
                $("#txtkoofesiene").val(data.koofesien);
                $("#txtnosele").val(data.jumlah_nosel);
                $("#txtmediume").val(data.medium);
                // $("#txtakune").val(data.id_buat);
                $("#txtbelie").val(data.tgl_beli);
                $("#txtterae").val(data.sudah_tera);
                $("#txtpemilik").val(data.id_pemilik);
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
    let id_uttp = $("#txtuttp").val();
    let id_jenis = $("#txtjenise").val();
    let merek = $("#txtmereke").val();
    let type_model = $("#txtmodele").val();
    let no_seri = $("#txtserie").val();
    let kapasitas = $("#txtkapasitase").val();
    let buatan = $("#txtbuatane").val();
    let koofesien = $("#txtkoofesiene").val();
    let jumlah_nosel = $("#txtnosele").val();
    let medium = $("#txtmediume").val();
    // let id_buat = $("#txtakune").val();
    let tgl_beli = $("#txtbelie").val();
    let sudah_tera = $("#txtterae").val();

    if (id_uttp == "" || id_jenis == "" || merek == "" || type_model == "" || no_seri == "" || kapasitas == "" ||
        buatan == "" ||
        koofesien == "" || jumlah_nosel == "" || medium == "" || id_buat == "" || tgl_beli == "" || sudah_tera == "") {
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
            id_uttp: id_uttp,
            id_jenis: id_jenis,
            merek: merek,
            type_model: type_model,
            no_seri: no_seri,
            kapasitas: kapasitas,
            buatan: buatan,
            koofesien: koofesien,
            jumlah_nosel: jumlah_nosel,
            medium: medium,
            id_buat: id_buat,
            tgl_beli: tgl_beli,
            sudah_tera: sudah_tera
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
    let id_uttp = $(el).data("id_uttp");
    if (id_uttp == "") {
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
                    id_uttp: id_uttp
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

$(document).ready(function() {
    var id_pemilik = "<?php echo $id_pemilik; ?>";
    fetchData(id_pemilik);
});

function fetchData(id_pemilik) {
    $.ajax({
        url: "<?php echo base_url('Ut002/data'); ?>",
        method: "GET",
        data: {
            id_pemilik: id_pemilik
        },
        dataType: "json",
        success: function(response) {
            console.log(response);
            var tableData = response.data;
            var tableHtml = '';
            tableData.forEach(function(rowData) {
                tableHtml += '<tr>';
                rowData.forEach(function(cellData) {
                    tableHtml += '<td>' + cellData + '</td>';
                });
                tableHtml += '</tr>';
            });
            $('#tbl-xdt tbody').html(tableHtml);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
</script>