<?php
namespace App\Controllers;
class Ak755 extends BaseController{
    protected $hasilc;
    protected $aksesc;
    public function __construct(){
        $h = $this->CekLogin2("form", "ak755");
        $this->aksesc = $h[2];
        $this->hasilc = $h;
    }
    public function index(){
        if($this->hasilc[0]){
            $x["dtlogin"] = $this->hasilc[1];
            $x["akses"] = $this->hasilc[2];
            $x["dtmenu"] = $this->hasilc[3];
            $x["dtform"] = $this->hasilc[4];
            $x["ids"] = $this->hasilc[5];
            $x["idf"] = $this->hasilc[6];
            $x["hal"] = $this->hasilc[7];
            $x["dtxlevel"] = $this->mle409->getData();
            
            return view("basis", $x);
        }else{return redirect()->to(BASEURLKU);}
    }
    public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->mak755->getData();
        foreach ($dt as $k){
            $id = $k->id;
            $nama = $k->nama;
            $username = $k->username;
            $level = $k->level;
            $status = $k->status == "Y" ? "<i class='icon-check' style='font-size: 25px;'></i>" : "<i class='icon-close' style='font-size: 25px;'></i>";
            $tomboledit = "";
            $tombolreset = "";
            $tombolhapus = "";
            $tomboluuid = "";
            if(strpos($this->aksesc, "002") !== false){
                $tomboledit = sprintf("<button type='button' class='btn btn-icon btn-round btn-primary btn-sm mr-1 mb-1' data-id='%s' onclick='filter(this)'><i class='icon-pencil'></i></button>", $id);
            }
            if(strpos($this->aksesc, "006") !== false) {
                $tombolreset = sprintf("<button type='button' class='btn btn-icon btn-round btn-secondary btn-sm mr-1 mb-1' data-id='%s' onclick='resetpass(this)'><i class='icon-lock-open'></i></button>", $id);
            }
            if(strpos($this->aksesc, "003") !== false) {
                $tombolhapus = sprintf("<button type='button' class='btn btn-icon btn-round btn-danger btn-sm mr-1 mb-1' data-id='%s' onclick='hapus(this)'><i class='icon-trash'></i></button>", $id);
            }
            $dtisi .= sprintf('["%s","%s","%s","%s","%s","%s"],', $tomboledit.$tombolreset.$tombolhapus.$tomboluuid, $id, $nama, $username, $level, $status);
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }

    
    public function filter(){
        $status = false;
        $id = trim($this->request->getVar("id"));
        $dt = $this->mak755->Filter($id);
        if(is_array($dt)){
            if(count($dt)>0){
                $status = true;
                foreach($dt as $x){
                    $nama = $x->nama;
                    $username = $x->username;
                    $level = $x->id_level;
                    $statusx = $x->status;
                }
            }
        }
        if($status){
            echo base64_encode(sprintf('{"kode":"01","pesan":"Data Tersedia","nama":"%s","username":"%s","level":"%s","status":"%s"}', $nama, $username, $level, $statusx));
        }else{echo base64_encode('{"kode":"00","pesan":"Data Tidak di Temukan"}');}
    }
    public function add(){
        if(strpos($this->aksesc, "001") !== false){
            $id = kodeotomatis1();
            $nama = antiSQLi($this->request->getVar("nama"));
            $username = antiSQLi($this->request->getVar("username"));
            $password = md5(base64_encode(enkripsi($username)));
            $level = antiSQLi($this->request->getVar("level"));
            $status = antiSQLi($this->request->getVar("status"));
            $hasilcek = true;
            $cek = $this->mak755->Filter2($username);
            if(is_array($cek)){if(count($cek)>0){$hasilcek = false;}}
            if($hasilcek){
                $opr = $this->mak755->Add($id, $nama, $username, $password, $level, $status, IdLogin());
                if($opr == "1"){
                    $ket = "ID: $id,\nNama: $nama,\nUsername: $username,\nPassword: *****,\nID Level: $level,\nStatus: $status";
                    $this->mlog->LogHistory("Akun", "Tambah", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data Akun Berhasil di Tambahkan, Sebagai Pengaturan awal Password = Username"}');
                }else{echo base64_encode('{"kode":"02","pesan":"Data Akun Gagal Ditambahkan, Periksa Kembali Isian Anda"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Username yang Anda Masukkan Sudah Ada"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Menambah Data Pada Form Ini"}');}
    }
    
    public function update(){
        if(strpos($this->aksesc, "002") !== false){
            $id = antiSQLi($this->request->getVar("id"));
            $nama = antiSQLi($this->request->getVar("nama"));
            $level = antiSQLi($this->request->getVar("level"));
            $status = antiSQLi($this->request->getVar("status"));
            $opr = $this->mak755->Updatex($id, $nama, $level, $status, IdLogin());
            if($opr == "1"){
                $ket = "ID: $id,\nNama: $nama,\nID Level: $level,\nStatus: $status";
				$this->mlog->LogHistory("Akun", "Update", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data Akun Berhasil di Update"}');
            }else{echo base64_encode('{"kode":"02","pesan":"Data Akun Gagal Diupdate, Periksa Kembali Isian Anda"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Update Data Pada Form Ini"}');}
    }
    public function delete(){
        if(strpos($this->aksesc, "003") !== false){
            $id = antiSQLi($this->request->getVar("id"));
            $detail = false;
            $dt = $this->mak755->filter($id);
            if(is_array($dt)){
                if(count($dt)>0){
                    foreach($dt as $x){
                        $nama = $x->nama;
                        $username = $x->username;
                        $level = $x->id_level;
                        $status = $x->status;
                    }
                    $detail = true;
                }
            }
            if($detail){
                $opr = $this->mak755->Deletex($id);
                if($opr == "1"){
                    $ket = "ID: $id,\nNama: $nama,\nUsername: $username,\nID Level: $level,\nStatus: $status";
                    $this->mlog->LogHistory("Akun", "Hapus", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data Akun Berhasil di Hapus"}');
                }else{echo base64_encode('{"kode":"02","pesan":"Data Akun Gagal Di Hapus"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Data Akun Ini Tidak Lengkap, Sehingga Tidak Dapat di Hapus"}');}
        }
    }
    
    public function reset(){
        if(strpos($this->aksesc, "006") !== false){
            $id = antiSQLi($this->request->getVar("id"));
            $detail = false;
            $dt = $this->mak755->Filter($id);
            if(is_array($dt)){
                if(count($dt)>0){
                    foreach($dt as $x){
                        $username = $x->username;
                        $nama = $x->nama;
                        $password = md5(base64_encode(enkripsi($username)));
                    }
                    $detail = true;
                }
            }
            if($detail){
                $opr = $this->mak755->Resetx($id, $password, IdLogin());
                if($opr == "1"){
                    $ket = "ID: $id,\nNama: $nama,\nUsername: $username";
                    $this->mlog->LogHistory("Akun", "Reset Password", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Password Akun Berhasil di Reset, Password default = Username"}');
                }else{echo base64_encode('{"kode":"02","pesan":"Password Akun Gagal Di Reset"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Password Akun Ini Tidak Memiliki Username, Sehingga Tidak Dapat di Reset"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Reset Password Pada Form Ini"}');}
    }
}