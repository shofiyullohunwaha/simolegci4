<?php
namespace App\Controllers;
class Dashboard extends BaseController{
    protected $hasilc;
    public function __construct(){
        $h = $this->CekLogin();
        $this->hasilc = $h;
    }
    public function index(){
        if($this->hasilc[0]){
            $x["hal"] = "xb37da";
            $x["dtlogin"] = $this->hasilc[1];
            $status = true;
            $cek = $this->msistem->getSistem('Y');
            if(is_array($cek)){
                if(count($cek)>1){
                    return view("home", $x);
                }elseif(count($cek) == 1){
                    foreach($cek as $h){$idsistem = $h->id;}
                    return redirect()->to(BASEURLKU.$idsistem);
                }else{return view("hal500");}
            }
        }else{return redirect()->to(BASEURLKU);}
    }

    public function updateprofil_upload(){
        $eks = $this->request->getVar("ekstensi");
        $nama = antiSQLi($this->request->getVar("nama"));
        $lokasi = "writable/uploads/profil/".IdLogin().".".$eks;
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $lokasi))
        {


            $opr = $this->msistem->UpdateProfil(IdLogin(), $nama);
            if($opr == "1"){
                $ket = "Nama: $nama";
                $this->mlog->LogHistory("Akses", "Update + Upload Foto", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Akun Berhasil di Update"}');
            }else{echo base64_encode('{"kode":"00","pesan":"Akun Gagal di Update"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Foto Profil Gagal di Upload"}');}
    }

    public function updateprofil(){
        $nama = antiSQLi($this->request->getVar("nama"));
        $opr = $this->msistem->UpdateProfil(IdLogin(), $nama);
        if($opr == "1"){
            $ket = "Nama: $nama";
            $this->mlog->LogHistory("Akses", "Update", $ket, IdLogin(), kodeotomatis2());
            echo base64_encode('{"kode":"01","pesan":"Akun Berhasil di Update"}');
        }else{echo base64_encode('{"kode":"00","pesan":"Akun Gagal di Update"}');}
    }

    public function hapusfotoprofil(){
        $lokasi = FCPATH."writable/uploads/profil/".IdLogin().".jpg";
        unlink($lokasi);
        echo base64_encode('{"kode":"01","pesan":"Foto Profil Berhasil di Hapus"}');
    }
}