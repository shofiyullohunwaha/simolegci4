<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Pegawai</h2>
                <h5 class="text-white op-7 mb-2">Pengelolaan Data Pegawai</h5>
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
                                    <th style="width: 15%;">ID</th>
                                    <th style="width: 20%;">Nama Pegawai</th>
                                    <th style="width: 10%;">Jenis Kelmin</th>
                                    <th style="width: 15%;">Nomer Telpon</th>
                                    <th style="width: 15%;">Email</th>
                                    <th style="width: 15%;">Desa</th>
                                    <!-- <th style="width: 10%;">Level</th> -->
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
                <h4 class="modal-title">Form Tambah Pegawai</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 jedaobyek">
                        <label>Nama Pegawai*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txtnama"
                            placeholder="Masukkan Nama Pegawai" autocomplete="off">
                    </div>

                    <div class="form-group col-6 jedaobyek">
                        <label>No Tepon*</label>
                        <input type="number" class="form-control forme khusus_abjad" id="txttelpon"
                            placeholder="Masukkan +62 .." autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Email*</label>
                        <input type="email" class="form-control forme" id="txtemail" placeholder="Masukkan Email"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Jenis Kelamin*</label>
                        <select class="form-control forme select2" id="txtjenis" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
                            <option value='laki_laki'>Laki_laki</option>
                            <option value='Perampuan'>Perampuan</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Provinsi*</label>
                        <select id="txtprovinsi" class="form-control formt select2" style="width: 100%;">
                            <option value="">Pilih Salah Satu</option>
                            <?php
                                if (is_array($dtxprov) && count($dtxprov) > 0) {
                                    foreach ($dtxprov as $w) {
                                        echo "<option value='" . $w->id_provinsi . "'>" . $w->nama . "</option>";
                                    }
                                }
                                ?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label for="txtkab">Kabupaten/Kota*</label>
                        <select id="txtkab" class="form-control formt select2" style="width: 100%">
                            <option value="">Pilih Salah Satu</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label for="txtkec">Kecamatan</label>
                        <select id="txtkec" class="form-control formt select2" style="width: 100%">
                            <option value="">Pilih Salah Satu</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label for="txtdesa">Desa*</label>
                        <select class="form-control formt select2" id="txtdesa" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
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
                <h4 class="modal-title">Form Update Pegawai</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 jedaobyek">
                        <label>ID Pegawai*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txtide"
                            placeholder="Masukkan ID Form" maxlength="5" readonly autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Nama Pegawai*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txtnamae"
                            placeholder="Masukkan Nama Pegawai" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>No Tepon*</label>
                        <input type="number" class="form-control forme khusus_abjad" id="txttelpone"
                            placeholder="Masukkan No Telpon +62.." autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Email*</label>
                        <input type="email" class="form-control forme " id="txtemaile" placeholder="Masukkan Email"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Jenis Kelamin*</label>
                        <select class="form-control forme select" id="txtjenise" style="width: 100%;">
                            <option value='laki_laki'>Laki_laki</option>
                            <option value='Perampuan'>Perampuan</option>
                        </select>
                    </div>

                    <div class="form-group col-6 jedaobyek">

                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Provinsi*</label>
                        <select id="txtprovinsie" class="form-control formt select2" style="width: 100%;">
                            <option value="">Pilih Salah Satu</option>
                            <?php
                                if (is_array($dtxprov) && count($dtxprov) > 0) {
                                    foreach ($dtxprov as $w) {
                                        echo "<option value='" . $w->id_provinsi . "'>" . $w->nama . "</option>";
                                    }
                                }
                                ?>
                        </select>
                    </div>

                    <div class="form-group col-6 jedaobyek">
                        <label for="txtkabe">Kabupaten/Kota*</label>
                        <select id="txtkabe" class="form-control formt select2" style="width: 100%">
                            <option value="">Pilih Salah Satu</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label for="txtkece">Kecamatan</label>
                        <select id="txtkece" class="form-control formt select2" style="width: 100%">
                            <option value="">Pilih Salah Satu</option>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label for="txtdesae">Desa*</label>
                        <select class="form-control formt select2" id="txtdesae" style="width: 100%;">
                            <option value=''>Pilih Salah Satu</option>
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
    "oSearch": {
        "sSearch": " "
    },
    "fnDrawCallback": function(oSettings) {
        swal.close();
    }
});

// function getProv() {
//     // var url = "<?= BASEURLKU.ucfirst($idf); ?>/kab" + $(this).val();
//     console.log($(this).val());
//     // $('#kabupaten').load(url);
//     return false;
// }

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
    $("#txtnama").val("").change();
    $("#txtjenis").val("").change();
    $("#txttelpon").val("").change();
    $("#txtemail").val("").change();
    $("#txtprovinsi").val("").change();
    $("#txtkab").val("").change();
    $("#txtkec").val("").change();
    $("#txtdesa").val("").change();

}

function tambah() {
    $("#btnbatal").attr("disabled", true);
    $("#btntambah").attr("disabled", true);
    let nama_pegawai = $("#txtnama").val();
    let jenis_kelamin = $("#txtjenis").val();
    let no_telpon = $("#txttelpon").val();
    let email = $("#txtemail").val();
    let id_desa = $("#txtdesa").val();
    if (nama_pegawai == "" || jenis_kelamin == "" || no_telpon == "" || email == "" || id_desa == "") {
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
            nama_pegawai: nama_pegawai,
            jenis_kelamin: jenis_kelamin,
            no_telpon: no_telpon,
            email: email,
            id_desa: id_desa,
            // id_level: id_level
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
    let id_pegawai = $("#txtide").val();
    let nama_pegawai = $("#txtnamae").val();
    let jenis_kelamin = $("#txtjenise").val();
    let no_telpon = $("#txttelpone").val();
    let email = $("#txtemaile").val();
    let id_desa = $("#txtdesae").val();

    if (nama_pegawai == "" || jenis_kelamin == "" || no_telpon == "" || email == "" || id_desa == "") {
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
            id_pegawai: id_pegawai,
            nama_pegawai: nama_pegawai,
            jenis_kelamin: jenis_kelamin,
            no_telpon: no_telpon,
            email: email,
            id_desa: id_desa,
        },
        cache: false, // Ubah "false" menjadi false
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
        complete: function() { // Add complete callback to re-enable buttons
            $("#btnbatale").attr("disabled", false);
            $("#btnupdate").attr("disabled", false);
        }
    });
}


function filterin(el) {
    let id_pegawai = $(el).data("id_pegawai");
    if (id_pegawai == "") {
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
            id_pegawai: id_pegawai
        },
        cache: false, // Tidak perlu menggunakan string "false"
        timeout: ajaxtimeout,
        success: function(respon) {
            swal.close();
            let data = JSON.parse(atob(respon));
            console.log(data);
            if (data.kode == "01") {
                $("#txtide").val(id_pegawai);
                $("#txtnamae").val(data.nama_pegawai);
                $("#txtjenise").val(data.jenis_kelamin);
                $("#txttelpone").val(data.no_telpon);
                $("#txtemaile").val(data.email);
                $("#txtprovinsie").val(data.id_provinsi);
                $("#txtkabe").val(data.id_kab);
                $("#txtkece").val(data.id_kec);
                $("#txtdesae").val(data.id_desa);
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

function hapus(el) {
    let id_pegawai = $(el).data("id_pegawai");
    if (id_pegawai == "") {
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
                    id_pegawai: id_pegawai
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
    $('#txtprovinsi').change(function() {
        var provinsiId = $(this).val();
        $.ajax({
            url: '<?= base_url('Pu002/ambil') ?>',
            type: 'POST',
            data: {
                provinsi_id: provinsiId
            },
            dataType: 'json',
            success: function(response) {
                $('#txtkab').empty();
                $.each(response.kabupaten, function(key, value) {
                    $('#txtkab').append('<option value="' + value.id_kab +
                        '">' +
                        value.nama + '</option>');
                });
            }
        });
    });
});

$(document).ready(function() {
    $('#txtkab').change(function() {
        var kabId = $(this).val();
        $.ajax({
            url: '<?= base_url('Pu002/ambil1') ?>',
            type: 'POST',
            data: {
                kab_id: kabId
            },
            dataType: 'json',
            success: function(response) {
                $('#txtkec').empty();
                $.each(response.kecamatan, function(key, value) {
                    $('#txtkec').append('<option value="' + value.id_kec +
                        '">' +
                        value.nama + '</option>');
                });
            }
        });
    });
});
$(document).ready(function() {
    $('#txtkec').change(function() {
        var kecId = $(this).val();
        $.ajax({
            url: '<?= base_url('Pu002/ambil2') ?>',
            type: 'POST',
            data: {
                kec_id: kecId
            },
            dataType: 'json',
            success: function(response) {
                $('#txtdesa').empty();
                $.each(response.desa, function(key, value) {
                    $('#txtdesa').append('<option value="' + value.id_desa +
                        '">' +
                        value.nama + '</option>');
                });
            }
        });
    });
});

//update daerah
$(document).ready(function() {
    $('#txtprovinsie').change(function() {
        var provinsiId = $(this).val();
        $.ajax({
            url: '<?= base_url('Pu002/ambil') ?>',
            type: 'POST',
            data: {
                provinsi_id: provinsiId
            },
            dataType: 'json',
            success: function(response) {
                $('#txtkabe').empty();
                $.each(response.kabupaten, function(key, value) {
                    $('#txtkabe').append('<option value="' + value.id_kab +
                        '">' +
                        value.nama + '</option>');
                });
            }
        });
    });
});

$(document).ready(function() {
    $('#txtkabe').change(function() {
        var kabId = $(this).val();
        $.ajax({
            url: '<?= base_url('Pu002/ambil1') ?>',
            type: 'POST',
            data: {
                kab_id: kabId
            },
            dataType: 'json',
            success: function(response) {
                $('#txtkece').empty();
                $.each(response.kecamatan, function(key, value) {
                    $('#txtkece').append('<option value="' + value.id_kec +
                        '">' +
                        value.nama + '</option>');
                });
            }
        });
    });
});
$(document).ready(function() {
    $('#txtkece').change(function() {
        var kecId = $(this).val();
        $.ajax({
            url: '<?= base_url('Pu002/ambil2') ?>',
            type: 'POST',
            data: {
                kec_id: kecId
            },
            dataType: 'json',
            success: function(response) {
                $('#txtdesae').empty();
                $.each(response.desa, function(key, value) {
                    $('#txtdesae').append('<option value="' + value
                        .id_desa + '">' +
                        value.nama + '</option>');
                });
            }
        });
    });
});
</script>