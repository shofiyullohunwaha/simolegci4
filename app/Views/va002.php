<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">DATA Tagiahn</h2>
                <h5 class="text-white op-7 mb-2">Pengelolaan DATA Tagiahn</h5>
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
                                    <th style="width: 20%;">ID Virtual Account</th>
                                    <th style="width: 30%;">Tagihan</th>
                                    <th style="width: 20%;"> Total</th>
                                    <th style="width: 10%;">Tanggal Bayar</th>
                                    <th style="width: 10%;"> channel</th>
                                    <th style="width: 10%;">Ref</th>

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
                <h4 class="modal-title">Form Tambah Tagiahn</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 jedaobyek">
                        <label>Pemilik *</label>
                        <select class="form-control formt select2" id="txtpemilik" style="width: 100%;">
                            <option value=''>Pilih Pemilik</option>
                            <?php
                                  if (is_array($dtxpemilik) 
                                  && count($dtxpemilik) > 0) {
                                      foreach ($dtxpemilik as $z) {
                                          echo "<option value='" . $z->id_pemilik . "'>" . $z->nama_pemilik . "</option>";
                                      }
                                  }
                                ?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Tagihan*</label>
                        <select class="form-control formt select2" id="txttagihan" style="width: 100%;"
                            multiple="multiple">
                            <?php
                                if (is_array($dtxtera) 
                                  && count($dtxtera) > 0) {
                                      foreach ($dtxtera as $z) {
                                          echo "<option value='" . $z->id_tera . "'>" . $z->kategori . "</option>";
                                  }
                              }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Total*</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control formt khusus_abjad" id="txttotal" placeholder="Jumlah Harga" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Tanggal Bayar*</label>
                        <input type="date" class="form-control forme khusus_abjad" id="txttgl"
                            placeholder="Masukkan Nomer Seri Alat" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Channel*</label>
                        <input type="text" class="form-control forme" id="txtchannel" placeholder="Buatan Alat"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Ref*</label>
                        <input type="text" class="form-control forme" id="txtref" placeholder="Buatan Alat"
                            autocomplete="off">
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
                <h4 class="modal-title">Form Update Tagiahn</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 jedaobyek">
                        <label>Tagihan*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txttagihane"
                            placeholder=" Masukan Tagihan" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Total*</label>
                        <input type="text" class="form-control forme" id="txttotal" placeholder="Masukan Type model"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Tanggal Bayar*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txttgle"
                            placeholder="Masukkan Nomer Seri Alat" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Channel*</label>
                        <input type="text" class="form-control forme" id="txtchannele" placeholder="Buatan Alat"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Ref*</label>
                        <input type="text" class="form-control forme" id="txtrefe" placeholder="Buatan Alat"
                            autocomplete="off">
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
    $("#txttagihan").val("").change();
    $("#txttotal").val("").change();
    $("#txttgl").val("").change();
    $("#txtchannel").val("").change();
    $("#txtref").val("").change();


}

function tambah() {
    $("#btnbatal").attr("disabled", true);
    $("#btntambah").attr("disabled", true);
    let pemilik = $("#txtidpemilik").val();
    let id_tagihan = $("#txttagihan").val();
    let total = $("#txttotal").val();
    let tgl_bayar = $("#txttgl").val();
    let channel = $("#txtchannel").val();
    let ref = $("#txtref").val();

    if (pemilik == "" || id_tagihan == "" || total == "" || tgl_bayar == "" || channel == "" || ref == "") {
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
        text: "Proses tambah...",
        icon: iconpreloader,
        button: false,
        closeOnClickOutside: false,
        closeOnEsc: false
    });

    $.ajax({
        url: "<?= BASEURLKU.ucfirst($idf); ?>/tambah",
        method: "POST",
        data: {
            id_pemilik: pemilik,
            tagihan: id_tagihan,
            total: total,
            tgl_bayar: tgl_bayar,
            channel: channel,
            ref: ref
        },
        cache: false,
        timeout: ajaxtimeout,
        success: function(respon) {
            swal.close();
            try {
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
            } catch (e) {
                swal({
                    title: "Error",
                    text: "Terjadi kesalahan saat memproses respon dari server.",
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


$(document).ready(function() {
    $('#txttagihan').change(function() {
        var selectedIds = $(this).val();
        console.log(selectedIds);
            $.ajax({
                url: '<?= BASEURLKU.ucfirst($idf); ?>/uttp',
                type: 'GET',
                data: {
                    id_teras: selectedIds,
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var totalHarga = 0;
                    $('#txttotale').empty();
                    $.each(response.tera, function(key, item) {
                        var hargatera = parseFloat(item.harga) || 0;
                        totalHarga += hargatera;
                        $('#txttotal').val(totalHarga);
                    })
                },
                error: function() {
                    $('#txttotal').val(''); // Atau atur ke nilai default yang sesuai
                }
            });
    });
});

</script>