<?php
    use CodeIgniter\Files\File;
    $fotoprofil = new File(FCPATH."writable/uploads/profil/".IdLogin().".jpg");
    if($fotoprofil->isFile()) {
        $linkfoto = BASEURLKU."writable/uploads/profil/".IdLogin().".jpg?id=".kodeotomatis1();
    }else{
        $linkfoto = BASEURLKU."writable/assets/img/toggl.png?id=".kodeotomatis1();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>SIMOGA</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?= BASEURLKU; ?>writable/assets/img/icon.ico" type="image/x-icon"/>
	<script src="<?= BASEURLKU; ?>writable/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":[
                "Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", 
                "Font Awesome 5 Brands", "simple-line-icons"], 
                urls: ['<?= BASEURLKU; ?>writable/assets/css/fonts.min.css']
            },
            active: function() {sessionStorage.fonts = true;}
		});
	</script>
	<link rel="stylesheet" href="<?= BASEURLKU; ?>writable/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= BASEURLKU; ?>writable/assets/css/atlantis.min.css">
    <link rel="stylesheet" href="<?= BASEURLKU; ?>writable/assets/js/plugin/select2/select2.min.css">
    <link rel="stylesheet" href="<?= BASEURLKU; ?>writable/assets/js/plugin/printjs/print.min.css">
	<script src="<?= BASEURLKU; ?>writable/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?= BASEURLKU; ?>writable/assets/js/core/popper.min.js"></script>
	<script src="<?= BASEURLKU; ?>writable/assets/js/core/bootstrap.min.js"></script>
	<script src="<?= BASEURLKU; ?>writable/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?= BASEURLKU; ?>writable/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<script src="<?= BASEURLKU; ?>writable/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<script src="<?= BASEURLKU; ?>writable/assets/js/atlantis.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/plugin/select2/select2.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/plugin/printjs/print.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/custom.js"></script>
    <style>
        .select2 .select2-selection__rendered {color: maroon;}
    </style>
</head>
<body>
    <div class="wrapper overlay-sidebar">
        <div class="main-header">
            <div class="logo-header" data-background-color="blue2">
                <a href="javascript:void(0)" class="logo">
                    <img src="<?= BASEURLKU; ?>writable/assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="icon-menu"></i></span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle sidenav-overlay-toggler"><i class="icon-menu"></i></button>
                </div>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                    <li class="nav-item dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                            <div class="avatar-sm">
                                <img src="<?= $linkfoto; ?>" alt="..." class="avatar-img rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg"><img src="<?= $linkfoto; ?>" alt="image profile" class="avatar-img rounded"></div>
                                        <div class="u-text">
                                            <h4 id="bloknama">???</h4>
                                            <p class="text-muted" id="bloklevel">???</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalprofil" data-backdrop="static" data-keyboard="false">Ubah Profil</a>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="hapusfotoprofil()">Hapus Foto Profil</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalpassword" data-backdrop="static" data-keyboard="false">Ganti Password</a>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="logout()">Logout</a>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-primary">
                        <li class="nav-item active">
                            <a href="<?= BASEURLKU; ?>beranda"><i class="icon-home"></i><p>Beranda</p></a>
                        </li>
                        <?php
                            if(is_array($dtlogin)){
                                if(count($dtlogin)>0){
                                    foreach($dtlogin as $x){
                                        $sistem = $x->sistem;
                                        $icon = $x->icon;
                                        $idsistem = $x->id_sistem;
                                        $nama = $x->nama;
                                        $level = $x->level;
                                        echo '<li class="nav-item" id="mn'.$idsistem.'"><a href="'.BASEURLKU.$idsistem.'"><i class="'.$icon.'"></i><p>'.$sistem.'</p></a></li>';
                                    }
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
                <?php
                    include empty($hal) ? "xb37da.php" : $hal.".php";
                ?>
            </div>
            <footer class="footer">
				<div class="container-fluid">
					<div class="copyright ml-auto">
						<?= date("Y"); ?>, Development By ChemickSoft
					</div>				
				</div>
			</footer>
            <div id="modalpassword" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Ganti Password</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="form-group col-12 jedaobyek">
									<label>Password Lama</label>
									<input type="password" class="form-control formps" id="txtpl" placeholder="Password Lama Anda">
								</div>
								<div class="form-group col-12 jedaobyek">
									<label>Password Baru</label>
									<input type="password" class="form-control formps" id="txtpb" placeholder="Password Baru Anda">
								</div>
								<div class="form-group col-12 jedaobyek">
									<label>Konfirmasi Password Baru</label>
									<input type="password" class="form-control formps" id="txtpk" placeholder="Konfirmasi Password Baru Anda">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" id="btnbatalpassword" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Batal</button>
                            <button type="button" id="btnresetpassword" class="btn btn-danger waves-effect waves-light" onclick="resetpassword()">Reset</button>
							<button type="button" id="btngantipassword" class="btn btn-primary waves-effect waves-light" onclick="gantipassword()">Update</button>
						</div>
					</div>
				</div>
			</div>
            <div id="modalprofil" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Ubah Profil</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="form-group col-12 jedaobyek">
									<label>Nama</label>
									<input type="text" class="form-control formprofil khusus_abjad" id="txtnamaprofil" placeholder="Masukkan Nama Anda" value="<?= $nama; ?>">
								</div>
								<div class="form-group col-12 jedaobyek">
									<label>Gambar Profil (*.jpg)</label>
									<input type="file" class="form-control formprofil" id="txtfileprofil" accept="image/jpeg">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" id="btnbatalprofil" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Batal</button>
                            <button type="button" id="btnresetprofil" class="btn btn-danger waves-effect waves-light" onclick="resetprofil()">Reset</button>
							<button type="button" id="btnupdateprofil" class="btn btn-primary waves-effect waves-light" onclick="updateprofil()">Update</button>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</body>
<script>
    $("#bloknama").html("<?= $nama; ?>");
    $("#bloklevel").html("<?= $level; ?>");

    function gantipassword(){
        $("#btnbatalpassword").attr("disabled", true);
        $("#btnresetpassword").attr("disabled", true);
        $("#btngantipassword").attr("disabled", true);
		let lama = $("#txtpl").val();
		let baru = $("#txtpb").val();
		let konfirmasi = $("#txtpk").val();
        if(lama == "" || baru == "" || konfirmasi == ""){
            swal({title: 'Update Gagal', text: 'Ada Isian yang Masih Kosong !', icon: 'error',});
            $("#btnbatalpassword").attr("disabled", false);
            $("#btnresetpassword").attr("disabled", false);
            $("#btngantipassword").attr("disabled", false);
            return;
        }
        if(baru != konfirmasi){
            swal({title: 'Update Gagal', text: 'Password Baru dan Konfirmasi Tidak Sesuai', icon: 'error',});
            $("#btnbatalpassword").attr("disabled", false);
            $("#btnresetpassword").attr("disabled", false);
            $("#btngantipassword").attr("disabled", false);
            return;
        }
        swal({text:"Proses Update ...", icon: iconpreloader, button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= BASEURLKU; ?>gantipassword",
            method: "POST",
            data: {plama: lama, pbaru: baru},
            cache: "false",
            timeout: ajaxtimeout,
            success: function(respon){
                swal.close();
                let data = JSON.parse(atob(respon));
                if(data.kode == "01"){
                    swal({title: "Berhasil", text: data.pesan, icon: "success"}).then((Ok) => {
                        if(Ok){
                            window.location = "<?= BASEURLKU; ?>";
                        }
                    })
                }else{
                    swal({title: "Gagal", text: data.pesan, icon: "error"});
                }
            },
            error: function(){
                swal.close();
                swal({title: 'Gagal', text: 'Jaringan Ke Server Terputus', icon: 'error'});
            }
        });
        $("#btnbatalpassword").attr("disabled", false);
        $("#btnresetpassword").attr("disabled", false);
        $("#btngantipassword").attr("disabled", false);
	}

    function resetpassword(){
        $(".formps").val("");
    }

    function logout(){
        swal({
            title: 'Konfirmasi',
            text: "Anda Yakin Ingin Logout ?",
            icon: 'warning',
            buttons: {
                confirm: {text: 'Yakin', className: 'btn btn-primary'},
                cancel: {visible: true, text: 'Tidak', className: 'btn btn-danger'}
            }
        }).then((hapus) => {
            if(hapus){
                window.location = "<?= BASEURLKU; ?>logout";
            }
        })
    }

    function resetprofil(){
        $(".formprofil").val("");
        $("#txtnamaprofil").val("<?= $nama; ?>");
    }

    function updateprofil(){
        $("#btnbatalprofil").attr("disabled", true);
        $("#btnresetprofil").attr("disabled", true);
        $("#btnupdateprofil").attr("disabled", true);
        let nama = $("#txtnamaprofil").val();
        let files = document.getElementById("txtfileprofil").files;
        if(nama == ""){
            swal({title: 'Gagal', text: 'Ada Isian Nama Profil Masih Kosong !', icon: 'error',});
            $("#btnbatalprofil").attr("disabled", false);
            $("#btnresetprofil").attr("disabled", false);
            $("#btnupdateprofil").attr("disabled", false);
            return;
        }
        if(files.length != 0){
			let namafile = files.item(0).name;
			let x = namafile.split(".");
			var jmlx = x.length;
			if(x[jmlx-1] != "jpg" && x[jmlx-1] != "JPG"){
				swal({title: 'Update Gagal', text: 'File Harus Ber-ekstensi jpg !', icon: 'error'});
				$("#btnbatalprofil").attr("disabled", false);
                $("#btnresetprofil").attr("disabled", false);
                $("#btnupdateprofil").attr("disabled", false);
				return;
			}
            swal({text:"Proses Update ...", icon: iconpreloader, button: false, closeOnClickOutside: false, closeOnEsc: false});
			var formData = new FormData();
			formData.append("ekstensi", "jpg");
            formData.append("file", files[0]);
			formData.append("nama", nama);
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "<?= BASEURLKU; ?>updateprofil", true);
			xhttp.onreadystatechange = function(){
				swal.close();
                if(this.readyState == 4 && this.status == 200){
                    let respon = this.responseText;
                    let data = JSON.parse(atob(respon));
                    if(data.kode == "01"){
                        swal({title: "Berhasil", text: data.pesan, icon: "success"}).then((Ok) => {
                            if(Ok){
                                $("#modalprofil").modal("hide");
                                window.location = "";
                            }
                        })
                    }else{swal({title: "Gagal", text: data.pesan, icon: "error"});}
				}else{swal({title: 'Gagal', text: 'Respon Server Gagal', icon: 'error'});}
			}
			xhttp.send(formData);
        }else{
            swal({text:"Proses Update ...", icon: iconpreloader, button: false, closeOnClickOutside: false, closeOnEsc: false});
            $.ajax({
                url: "<?= BASEURLKU; ?>updateprofil2",
                method: "POST",
                data: {nama: nama},
                cache: "false",
                timeout: ajaxtimeout,
                success: function(respon){
                    swal.close();
                    let data = JSON.parse(atob(respon));
                    if(data.kode == "01"){
                        swal({title: "Berhasil", text: data.pesan, icon: "success"}).then((Ok) => {
                            if(Ok){
                                $("#modalprofil").modal("hide");
                                window.location = "";
                            }
                        })
                    }else{
                        swal({title: "Gagal", text: data.pesan, icon: "error"});
                    }
                },
                error: function(){
                    swal.close();
                    swal({title: 'Gagal', text: 'Respon Server Gagal', icon: 'error'});
                }
            });
        }
        $("#btnbatalprofil").attr("disabled", false);
        $("#btnresetprofil").attr("disabled", false);
        $("#btnupdateprofil").attr("disabled", false);
    }

    function hapusfotoprofil(){
        swal({
            title: 'Konfirmasi',
            text: "Anda Yakin Ingin Hapus Foto Profil ?",
            icon: 'warning',
            buttons: {
                confirm: {text: 'Yakin', className: 'btn btn-primary'},
                cancel: {visible: true, text: 'Tidak', className: 'btn btn-danger'}
            }
        }).then((hapus) => {
            if(hapus){
                swal({text:"Proses Hapus ...", icon: iconpreloader, button: false, closeOnClickOutside: false, closeOnEsc: false});
                $.ajax({
                    url: "<?= BASEURLKU; ?>hapusfoto",
                    method: "POST",
                    cache: "false",
                    timeout: ajaxtimeout,
                    success: function(respon){
                        swal.close();
                        let data = JSON.parse(atob(respon));
                        if(data.kode == "01"){
                            swal({title: "Berhasil", text: data.pesan, icon: "success"}).then((Ok) => {
                                if(Ok){window.location = "";}
                            })
                        }else{swal({title: "Gagal", text: data.pesan, icon: "error"});}
                    },
                    error: function(){
                        swal.close();
                        swal({title: 'Gagal', text: 'Respon Server Gagal', icon: 'error'});
                    }
                });
            }
        })
    }
</script>
</html>


