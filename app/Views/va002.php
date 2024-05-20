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
                        <label>Tagihan*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txttagihan"
                            placeholder=" Masukan Tagihan" autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Total*</label>
                        <input type="text" class="form-control forme" id="txttotal" placeholder="Masukan Type model"
                            autocomplete="off">
                    </div>
                    <div class="form-group col-6 jedaobyek">
                        <label>Tanggal Bayar*</label>
                        <input type="text" class="form-control forme khusus_abjad" id="txttgl"
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
                        <input type="text" class="form-control forme" id="txttotale" placeholder="Masukan Type model"
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
            id_va: id_va,
            tagihan: tagihan,
            total: total,
            tgl_bayar: tgl_bayar,
            channel: channel,
            ref: ref
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
</script>