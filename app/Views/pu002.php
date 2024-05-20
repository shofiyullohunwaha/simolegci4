<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Pemilik UTTP</h2>
                <h5 class="text-white op-7 mb-2">Pengelolaan Data Pemilik UTTP</h5>
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
                                    <th style="width: 20%;">Nama Pemilik</th>
                                    <th style="width: 20%;">Nama Usaha</th>
                                    <th style="width: 10%;">Narahubung</th>
                                    <!-- <th style="width: 10%;">Izin Pabrik</th> -->
                                    <th style="width: 10%;">Desa</th>
                                    <th style="width: 10%;">Email</th>
                                    <th style="width: 10%;">No Telpon</th>

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
                    <input type="hidden" class="form-control forme khusus_abjad" id="txtid"
                        placeholder="Otomatis By Sistem" maxlength="13" autocomplete="off" readonly>
                    <div class="form-group col-6 jedaobyek">
                        <label>Nama Pemilik *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtnama"
                            placeholder="Masukkan Nama" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Nama usaha *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtusaha"
                            placeholder="Masukkan Nama usaha" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Narahubung *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtnarahubung"
                            placeholder="Masukkan Nama Narahubung" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Izin Pabrik *</label>
                        <input type="file" class="form-control formt khusus_abjad" id="txtizin"
                            placeholder="Masukkan file izin " autocomplete="off"
                            accept=".doc,.docx,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Email *</label>
                        <input type="email" class="form-control formt " id="txtemail" placeholder="Masukkan email"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>No Telpon *</label>
                        <input type="number" class="form-control formt khusus_abjad" id="txttelpon"
                            placeholder="Masukkan  email" autocomplete="off">
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
                <h4 class="modal-title">Form Update Pemilik UTTP</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" class="form-control forme khusus_abjad" id="txtide"
                        placeholder="Otomatis By Sistem" maxlength="13" autocomplete="off" readonly>
                    <div class="form-group col-6 jedaobyek">
                        <label>Nama Pemilik *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtnamae"
                            placeholder="Masukkan Nama" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Nama usaha *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtusahae"
                            placeholder="Masukkan Nama usaha" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Narahubung *</label>
                        <input type="text" class="form-control formt khusus_abjad" id="txtnarahubunge"
                            placeholder="Masukkan Nama Narahubung" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Izin Pabrik *</label>
                        <input type="file" class="form-control formt khusus_abjad" id="txtizine" accept="pdf"
                            placeholder="Masukkan Nama " autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Email *</label>
                        <input type="email" class="form-control formt " id="txtemaile" placeholder="Masukkan Email"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>No Telpon *</label>
                        <input type="number" class="form-control formt khusus_abjad" id="txttelpone"
                            placeholder="Masukkan No Telpon " autocomplete="off">
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
                        <label for="txtkae">Kabupaten/Kota*</label>
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
    $("#txtnamae").val("").change();
    $("#txtusahae").val("").change();
    $("#txtizine").val("").change();
    $("#txtnarahubunge").val("").change();
    $("#txtdesae").val("").change();


}


function tambah() {
    $("#btnbatal").attr("disabled", true);
    $("#btnreset").attr("disabled", true);
    $("#btntambah").attr("disabled", true);
    let nama_pemilik = $("#txtnama").val();
    let nama_usaha = $("#txtusaha").val();
    let narahubung = $("#txtnarahubung").val();
    // let izin_pabrik = document.getElementById('txtizin').files;
    let desa = $("#txtdesa").val();
    let no_telpon = $("#txttelpon").val();
    let email = $("#txtemail").val();
    // let namafile = izin_pabrik.item(0).name;
    // let x = namafile.split(".");
    // let ekstensi = "pdf";
    // let file = izin_pabrik[0];

    if (nama_pemilik == "" || nama_usaha == ""
        // || izin_pabrik == "" 
        ||
        narahubung == "" || no_telpon == "" || desa ==
        "" || email == "") {
        swal({
            title: 'Gagal',
            text: 'Ada Isian yang Masih Kosong!',
            icon: 'error',
        });
        $("#btnbatal").attr("disabled", false);
        $("#btnreset").attr("disabled", false);
        $("#btntambah").attr("disabled", false);
        return;
    }
    swal({
        text: "Proses Tambah ...",
        icon: "info",
        button: false,
        closeOnClickOutside: false,
        closeOnEsc: false
    });
    // if (files.length != 0) {
    //     let namafile = files.item(0).name;
    //     let x = namafile.split(".");
    //     var jmlx = x.length;
    //     if (x[jmlx - 1] != "pdf" && x[jmlx - 1] != "PDF") {
    //         swal({
    //             title: 'Update Gagal',
    //             text: 'File Harus Ber-ekstensi dokumen atau pdf !',
    //             icon: 'error'
    //         });
    //         $("#btnbatal").attr("disabled", false);
    //         $("#btnreset").attr("disabled", false);
    //         $("#btntambah").attr("disabled", false);
    //         return;
    //     }

    //     var formData = new FormData();
    //     formData.append("ekstensi", "pdf");
    //     formData.append("file", files[0]);
    //     formData.append("nama", nama);
    //     var xhttp = new XMLHttpRequest();
    // }
    $.ajax({
        url: "<?= BASEURLKU.ucfirst($idf); ?>/tambah",
        method: "POST",
        data: {
            nama_pemilik: nama_pemilik,
            nama_usaha: nama_usaha,
            narahubung: narahubung,
            // izin_pabrik: izin_pabrik,
            desa: desa,
            no_telpon: no_telpon,
            email: email

        },
        cache: "false",
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
        }
    });
    $("#btnbatal").attr("disabled", false);
    $("#btnreset").attr("disabled", false);
    $("#btntambah").attr("disabled", false);
}

function update() {
    $("#btnbatale").attr("disabled", true);
    $("#btnupdate").attr("disabled", true);
    let id_pemilik = $("#txtide").val();
    let nama_pemilik = $("#txtnamae").val();
    let nama_usaha = $("#txtusahae").val();
    let izin_pabrik = $("#txtizine").val();
    let narahubung = $("#txtnarahubunge").val();
    let desa = $("#txtdesae").val();
    let no_telpon = $("#txttelpone").val();
    let email = $("#txtemaile").val();

    if (nama_pemilik == "" || nama_usaha == "" || izin_pabrik == "" || narahubung == "" || no_telpon == "" || desa ==
        "" || email == "") {
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
            id_pemilik: id_pemilik,
            nama_pemilik: nama_pemilik,
            nama_usaha: nama_usaha,
            narahubung: narahubung,
            izin_pabrik: izin_pabrik,
            desa: desa,
            no_telpon: no_telpon,
            email: email
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

function hapus(el) {
    let id_pemilik = $(el).data("id_pemilik");
    if (id_pemilik == "") {
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
                    id_pemilik: id_pemilik
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
    let id_pemilik = $(el).data("id_pemilik");
    if (id_pemilik == "") {
        swal({
            title: "Gagal",
            text: "id_pemilik Akses Tidak Terdeteksi",
            icon: "error"
        });
        return;
    }
    swal({
        text: "Menampilkan Data ...",
        icon: iconpreloader, // Ensure iconpreloader is defined
        button: false,
        closeOnClickOutside: false,
        closeOnEsc: false
    });
    $.ajax({
        url: "<?= BASEURLKU.ucfirst($idf); ?>/filter",
        method: "POST",
        data: {
            id_pemilik: id_pemilik
        },
        cache: "false", // Fix cache parameter
        success: function(respon) {
            swal.close();
            let data = JSON.parse(atob(respon));
            console.log(data);
            if (data.kode == "01") {
                $("#txtide").val(id_pemilik);
                $("#txtnamae").val(data.nama_pemilik);
                $("#txtusahae").val(data.nama_usaha);
                $("#txtnarahubunge").val(data.narahubung);
                $("#txtdesae").val(data.desa);
                $("#txttelpone").val(data.no_telpon);
                $("#txtemaile").val(data.email);
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

function detail(el) {
    let id_pemilik = $(el).data("id_pemilik");
    window.location.href = "<?= base_url('Ut002') ?>/" + id_pemilik;
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
                    $('#txtkab').append('<option value="' + value.id_kab + '">' +
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
                    $('#txtkec').append('<option value="' + value.id_kec + '">' +
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
                    $('#txtdesa').append('<option value="' + value.id_desa + '">' +
                        value.nama + '</option>');
                });
            }
        });
    });
});

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
                    $('#txtkabe').append('<option value="' + value.id_kab + '">' +
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
                    $('#txtkece').append('<option value="' + value.id_kec + '">' +
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
                    $('#txtdesae').append('<option value="' + value.id_desa + '">' +
                        value.nama + '</option>');
                });
            }
        });
    });
});
</script>