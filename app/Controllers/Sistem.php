<?php
namespace App\Controllers;
class Sistem extends BaseController{
    protected $hasilc;
    public function __construct(){
        $h = $this->CekLogin();
        $this->hasilc = $h;
    }
    
    public function index(){
        return $this->hasilc[0] ? redirect()->to(BASEURLKU."beranda") : view("xl06in");
    }

    public function Login(){
        $user = antiSQLi($this->request->getVar("u"));
        $pass = md5(base64_encode(enkripsi(antiSQLi($this->request->getVar("p")))));
        $dtlogin = $this->mlog->Login($user, $pass);
        $statuslogin = false;
        if(is_array($dtlogin)){
            if(count($dtlogin)>0){
                foreach($dtlogin as $k){
                    $id = $k->id;
                    $pas = $k->password;
                }
                $statuslogin = true;
                $data_session = base64_encode($this->encrypter->encrypt(enkripsi($id."|".$pas)));
                $this->session->set(S3si, $data_session);
                $this->mlog->LogHistory("Akses", "Login", "Login Berhasil", IdLogin(), kodeotomatis2());
            }
        }
        if($statuslogin){
            echo base64_encode('{"kode":"01","pesan":"Login Berhasil"}');
        }else{
            echo base64_encode('{"kode":"00","pesan":"Login Gagal, Periksa Kembali Akun Anda"}');
        }
    }

    public function UpdatePassword(){
        $plama = md5(base64_encode(enkripsi(antiSQLi($this->request->getVar("plama")))));
        $pbaru = md5(base64_encode(enkripsi(antiSQLi($this->request->getVar("pbaru")))));
        $dtlogin = $this->mlog->Login(IdLogin(), $plama);
        $status = false;
        if(is_array($dtlogin)){
            if(count($dtlogin)>0){
                $opr = $this->mlog->UpdatePassword(IdLogin(), $pbaru);
                if($opr == "1"){
                    $status = true;
                    $this->mlog->LogHistory("Akses", "Update Password", "Update Password Berhasil", IdLogin(), kodeotomatis2());
                }
            }
        }
        if($status){
            echo base64_encode('{"kode":"01","pesan":"Update Password Berhasil, Silahkan Login Kembali"}');
        }else{
            echo base64_encode('{"kode":"00","pesan":"Update Password Gagal atau Password Lama Salah, Periksa Kembali Akun Anda"}');
        }
    }

    public function Logout(){
        $this->session->remove(S3si);
        return redirect()->to(BASEURLKU);
    }

    public function setpass(){
        echo md5(base64_encode(enkripsi(antiSQLi("admin"))));
    }
}