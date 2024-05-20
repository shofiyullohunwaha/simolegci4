<?php
namespace App\Controllers;
class Ka556 extends BaseController{
    protected $hasilc;
    protected $aksesc;
    public function __construct(){
        $h = $this->CekLogin2("form", "ka556");
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
            return view("basis", $x);
        }else{return redirect()->to(BASEURLKU);}
    }
    public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->mka556->getData();
        foreach ($dt as $k){
            $id = $k->id;
            $nama = $k->deskripsi;
            $tomboledit = "";
            $tombolhapus = "";
            if(strpos($this->aksesc, "002") !== false){
                $tomboledit = sprintf("<button type='button' class='btn btn-icon btn-round btn-primary btn-sm mr-1 mb-1' data-id='%s' onclick='filter(this)'><i class='icon-pencil'></i></button>", $id);
            }
            if(strpos($this->aksesc, "003") !== false) {
                $tombolhapus = sprintf("<button type='button' class='btn btn-icon btn-round btn-danger btn-sm mr-1 mb-1' data-id='%s' onclick='hapus(this)'><i class='icon-trash'></i></button>", $id);
            }
            $dtisi .= sprintf('["%s","%s","%s"],', $tomboledit.$tombolhapus, $id, $nama);
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }
    public function filter(){
        $status = false;
        $id = antiSQLi($this->request->getVar("id"));
        $dt = $this->mka556->Filter($id);
        if(is_array($dt)){
            if(count($dt)>0){
                $status = true;
                foreach($dt as $x){
                    $nama = $x->deskripsi;
                }
            }
        }
        if($status){
            echo base64_encode(sprintf('{"kode":"01","pesan":"Data Tersedia","nama":"%s"}', $nama));
        }else{echo base64_encode('{"kode":"00","pesan":"Data Tidak di Temukan"}');}
    }
    public function add(){
        if(strpos($this->aksesc, "001") !== false){
            $id = antiSQLi($this->request->getVar("id"));
            $nama = antiSQLi($this->request->getVar("nama"));
            $hasilcek = true;
            $cek = $this->mka556->Filter($id);
            if(is_array($cek)){if(count($cek)>0){$hasilcek = false;}}
            if($hasilcek){
                $opr = $this->mka556->Add($id, $nama, IdLogin());
                if($opr == "1"){
                    $ket = "ID: $id,\nNama: $nama";
                    $this->mlog->LogHistory("Daftar Akses", "Tambah", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data Kode Akses Berhasil di Tambahkan"}');
                }else{echo base64_encode('{"kode":"02","pesan":"Data Kode Akses Gagal Ditambahkan, Periksa Kembali Isian Anda"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Kode Akses yang Anda Masukkan Sudah Ada"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Menambah Data Pada Form Ini"}');}
    }
    public function update(){
        if(strpos($this->aksesc, "002") !== false){
            $id = antiSQLi($this->request->getVar("id"));
            $nama = antiSQLi($this->request->getVar("nama"));
            $opr = $this->mka556->Updatex($id, $nama, IdLogin());
            if($opr == "1"){
                $ket = "ID: $id,\nNama: $nama";
				$this->mlog->LogHistory("Daftar Akses", "Update", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data Kode Akses Berhasil di Update"}');
            }else{echo base64_encode('{"kode":"02","pesan":"Data Kode Akses Gagal Diupdate, Periksa Kembali Isian Anda"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Update Data Pada Form Ini"}');}
    }
    public function delete(){
        if(strpos($this->aksesc, "003") !== false){
            $id = antiSQLi($this->request->getVar("id"));
            $cek = $this->mka556->CekUse($id);
            $status = true;
            if(is_array($cek)){if(count($cek)>0){$status = false;}}
            if($status){
                $detail = false;
                $dt = $this->mka556->filter($id);
                if(is_array($dt)){
                    if(count($dt)>0){
                        foreach($dt as $x){
                            $nama = $x->nama;
                        }
                        $detail = true;
                    }
                }
                if($detail){
                    $opr = $this->mka556->Deletex($id);
                    if($opr == "1"){
                        $ket = "ID: $id,\nNama: $nama";
                        $this->mlog->LogHistory("Daftar Akses", "Hapus", $ket, IdLogin(), kodeotomatis2());
                        echo base64_encode('{"kode":"01","pesan":"Data Kode Akses Berhasil di Hapus"}');
                    }else{echo base64_encode('{"kode":"02","pesan":"Data Kode Akses Gagal Di Hapus"}');}
                }else{echo base64_encode('{"kode":"00","pesan":"Data Kode Akses Ini Tidak Lengkap, Sehingga Tidak Dapat di Hapus"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Data Kode Akses Ini Masih di Gunakan pada Data Form Level, Sehingga Tidak Dapat di Hapus"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Hapus Data Pada Form Ini"}');}
    }
}