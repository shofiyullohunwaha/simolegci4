<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="<?= BASEURLKU; ?>writable/assets/img/icon.ico" type="image/x-icon" />
    <script src="<?= BASEURLKU; ?>writable/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
    WebFont.load({
        google: {
            "families": ["Lato:300,400,700,900"]
        },
        custom: {
            "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                "simple-line-icons"
            ],
            urls: ['<?= BASEURLKU; ?>writable/assets/css/fonts.min.css']
        },
        active: function() {
            sessionStorage.fonts = true;
        }
    });
    </script>
    <link rel="stylesheet" href="<?= BASEURLKU; ?>writable/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASEURLKU; ?>writable/assets/css/atlantis.css">
</head>

<body class="login">
    <div class="wrapper wrapper-login">
        <div class="container container-login animated fadeIn">
            <img src="<?= BASEURLKU; ?>writable/assets/img/logo.png" alt="..."
                style="width: 200px; margin: 0px auto 10px auto; display: block">
            <h3 class="text-center">SISTEM PELAYANAN METROLOGI LEGAL KABUPATEN JOMBANG</h3>
            <form autocomplete="off">
                <div class="login-form">
                    <div class="form-group">
                        <label for="username" class="placeholder"><b>Username</b></label>
                        <input id="txtu" type="text" class="form-control forml" onkeyup="pindahpass()">
                    </div>
                    <div class="form-group mt--2">
                        <label for="password" class="placeholder"><b>Password</b></label>
                        <input id="txtp" type="password" class="form-control forml" onkeyup="pindahlogin()">
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary mt-3 mt-sm-0" style="width: 100%"
                                    id="btnlogin" onclick="login()">Login</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger mt-3 mt-sm-0" style="width: 100%"
                                    id="btnreset">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="<?= BASEURLKU; ?>writable/assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/core/popper.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/core/bootstrap.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/atlantis.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/custom.js"></script>
    <script>
    function pindahpass() {
        if (event.keyCode === 13) {
            $("#txtp").focus();
        }
    }

    function pindahlogin() {
        if (event.keyCode === 13) {
            login();
        }
    }

    function login() {
        $("#btnlogin").attr("disabled", true);
        $("#btnreset").attr("disabled", true);
        let u = $("#txtu").val();
        var p = $("#txtp").val();
        if (u == "" || p == "") {
            swal({
                title: "Gagal",
                text: "Isian Akun Masih Ada yang Kosong",
                icon: "error"
            });
            $("#btnlogin").attr("disabled", false);
            $("#btnreset").attr("disabled", false);
            return;
        }
        swal({
            text: "Periksa Akun ...",
            icon: iconpreloader,
            button: false,
            closeOnClickOutside: false,
            closeOnEsc: false
        });
        $.ajax({
            url: "<?= BASEURLKU; ?>login",
            method: "POST",
            data: {
                u: u,
                p: p
            },
            cache: "false",
            timeout: ajaxtimeout,
            success: function(respon) {
                swal.close();
                let data = JSON.parse(atob(respon));
                if (data.kode == "01") {
                    window.location = "<?= BASEURLKU; ?>beranda";
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
                    text: 'Jaringan Ke Server Terputus',
                    icon: 'error'
                });
            }
        });
        $("#btnlogin").attr("disabled", false);
        $("#btnreset").attr("disabled", false);
    }

    function kosong() {
        $(".forml").val("");
        $("#txtu").focus();
    }
    </script>
</body>

</html>