<?php
namespace App\Controllers;
class Pk002 extends BaseController{
    protected $hasilc;
    protected $aksesc;
    public function __construct(){
        $h = $this->CekLogin2("form", "pk002");
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
            $x["dtxuttpengawasan"] =$this->mpn002->getData();    
            $x["dtxpengawasan"] =$this->mpn002->getData();
            $x["dtxpegawai"] =$this->mpg003->getData();
            return view("basis", $x);
        }else{return redirect()->to(BASEURLKU);}
    }

    public function json(){
        // Define the JSON structure
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->mpk002->getData(); // Assuming this method retrieves data for penyidikan
        foreach ($dt as $k){
            $id_penyidikan = $k->id_penyidikan;
            $id_pengawasan = $k->id_pengawasan;
            $sebab = $k->sebab;
            $id_uttp_pengawasan = $k->id_uttp_pengawasan;
            $tgl_penyidikan = $k->tgl_penyidikan;
            $hasil_penyidikan = $k->hasil_penyidikan;
            $status = $k->status;
            $id_petugas = $k->id_petugas;
            $id_uttp_penyidikan = $k->id_uttp_penyidikan;
            $tomboledit = "";
            $tombolhapus = "";
            if(strpos($this->aksesc, "002") !== false){
                $tomboledit = sprintf("<button type='button' class='btn btn-icon btn-round btn-primary btn-sm mr-1 mb-1' data-id_penyidikan='%s' onclick='filterin(this)'><i class='icon-pencil'></i></button>", $id_penyidikan);
            }
            if(strpos($this->aksesc, "003") !== false) {
                $tombolhapus = sprintf("<button type='button' class='btn btn-icon btn-round btn-danger btn-sm mr-1 mb-1' data-id_penyidikan='%s' onclick='hapus(this)'><i class='icon-trash'></i></button>", $id_penyidikan);
            }
    
       
            $dtisi .= sprintf('["%s","%s","%s","%s","%s","%s","%s","%s","%s","%s"],', $tomboledit.$tombolhapus, $id_penyidikan,$id_pengawasan, $sebab, $id_uttp_pengawasan, $tgl_penyidikan, $hasil_penyidikan, $status, $id_petugas, $id_uttp_penyidikan);
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }

    public function filter() {
        $status = false;
        $id_penyidikan = antiSQLi($this->request->getVar("id_penyidikan")); 
        $dt = $this->mpk002->Filter($id_penyidikan); 
    
        if(is_array($dt) && count($dt) > 0) {
            $status = true;
            foreach($dt as $x) {
                $id_penyidikan = $x->id_penyidikan; 
                $id_pengawasan = $x->id_pengawasan;
                $sebab = $x->sebab; 
                $id_uttp_pengawasan = $x->id_uttp_pengawasan; 
                $tgl_penyidikan = $x->tgl_penyidikan; 
                $hasil_penyidikan = $x->hasil_penyidikan; 
                $status = $x->status; 
                $id_petugas = $x->id_petugas; 
                $id_uttp_penyidikan = $x->id_uttp_penyidikan;
            }
        }
    
        if($status){
            echo base64_encode(sprintf('{"kode":"01","pesan":"Data Tersedia","id_pengawasan":"%s","sebab":"%s","id_uttp_pengawasan":"%s","tgl_penyidikan":"%s","hasil_penyidikan":"%s","status":"%s","id_petugas":"%s","id_uttp_penyidikan":"%s"}',$id_pengawasan, $sebab, $id_uttp_pengawasan, $tgl_penyidikan, $hasil_penyidikan, $status, $id_petugas, $id_uttp_penyidikan)); // Adjust field names accordingly
        } else {
            echo base64_encode('{"kode":"00","pesan":"Data Tidak di Temukan"}');
        }
    }

    public function add() {
        if(strpos($this->aksesc, "001") !== false) {
            $id_penyidikan = kodeotomatis1(); 
            $id_pengawasan = antiSQLi($this->request->getVar("id_pengawasan")); 
            $sebab = antiSQLi($this->request->getVar("sebab")); 
            $id_uttp_pengawasan = antiSQLi($this->request->getVar("id_uttp_pengawasan"));
            $tgl_penyidikan = antiSQLi($this->request->getVar("tgl_penyidikan")); 
            $hasil_penyidikan = antiSQLi($this->request->getVar("hasil_penyidikan")); 
            $status = antiSQLi($this->request->getVar("status"));
            $id_petugas = antiSQLi($this->request->getVar("id_petugas"));
            $id_uttp_penyidikan = antiSQLi($this->request->getVar("id_uttp_penyidikan")); 
                
            $cek = $this->mpk002->filter($id_penyidikan); 
            if(is_array($cek) && count($cek) > 0) {
                echo base64_encode('{"kode":"02","pesan":"id_penyidikan sudah ada."}');
                return;
            }
    
            $opr = $this->mpk002->Add($id_penyidikan, $id_pengawasan, $sebab, $id_uttp_pengawasan, $tgl_penyidikan, $hasil_penyidikan, $status, $id_petugas, $id_uttp_penyidikan, IdLogin());
            if($opr == "1") {
                $ket = "ID Penyidikan: $id_penyidikan,\nprngawasan : $id_pengawasan, \nSebab: $sebab,\nID UTTP Ulang: $id_uttp_pengawasan,\nTanggal Penyidikan: $tgl_penyidikan,\nHasil Penyidikan: $hasil_penyidikan,\nStatus: $status,\nID Petugas: $id_petugas,\nID UTTP Penyidikan: $id_uttp_penyidikan";
                $this->mlog->LogHistory("penyidikan", "Tambah", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data berhasil ditambahkan."}');
            } else {
                echo base64_encode('{"kode":"02","pesan":"Data gagal ditambahkan, periksa kembali isian Anda."}');
            }
        } else {
            echo base64_encode('{"kode":"00","pesan":"Anda tidak memiliki hak akses menambah data pada form ini."}');
        }
    }
    
    public function delete(){
        if(strpos($this->aksesc, "003") !== false){
            $id_penyidikan = antiSQLi($this->request->getVar("id_penyidikan"));
            $detail = false;
            $dt = $this->mpk002->filter($id_penyidikan);
            if(is_array($dt)){
                if(count($dt)>0){
                    foreach($dt as $x){
                        $id_pengawasan = $x->id_pengawasan;
                        $sebab = $x->sebab;
                        $id_uttp_pengawasan = $x->id_uttp_pengawasan;
                        $tgl_penyidikan = $x->tgl_penyidikan;
                        $hasil_penyidikan = $x->hasil_penyidikan;
                        $status = $x->status;
                        $id_petugas = $x->id_petugas;
                        $id_uttp_penyidikan = $x->id_uttp_penyidikan;
                    }
                    $detail = true;
                }
            }
            if($detail){
                $opr = $this->mpk002->Deletex($id_penyidikan);
                if($opr == "1"){
                    // Log deletion operation
                    $ket = "ID Penyidikan: $id_penyidikan,\nID Pengawasan: $id_pengawasan,\nSebab: $sebab,\nID UTTP Pengawasan: $id_uttp_pengawasan,\nTanggal Penyidikan: $tgl_penyidikan,\nHasil Penyidikan: $hasil_penyidikan,\nStatus: $status,\nID Petugas: $id_petugas,\nID UTTP Penyidikan: $id_uttp_penyidikan";
                    $this->mlog->LogHistory("penyidikan", "Hapus", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data Penyidikan Berhasil dihapus"}');
                }else{
                    echo base64_encode('{"kode":"02","pesan":"Data Penyidikan Gagal Dihapus"}');
                }
            }else{
                echo base64_encode('{"kode":"00","pesan":"Data Penyidikan Ini Tidak Lengkap, Sehingga Tidak Dapat Dihapus"}');
            }
        }else{
            echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses untuk Menghapus Data pada Form Ini"}');
        }
    }
    
    public function update() {
        if (strpos($this->aksesc, "002") !== false) {
            $id_penyidikan = antiSQLi($this->request->getVar("id_penyidikan"));
            $id_pengawasan = antiSQLi($this->request->getVar("id_pengawasan"));
            $sebab = antiSQLi($this->request->getVar("sebab"));
            $id_uttp_pengawasan = antiSQLi($this->request->getVar("id_uttp_pengawasan"));
            $tgl_penyidikan = antiSQLi($this->request->getVar("tgl_penyidikan"));
            $hasil_penyidikan = antiSQLi($this->request->getVar("hasil_penyidikan"));
            $status = antiSQLi($this->request->getVar("status"));
            $id_petugas = antiSQLi($this->request->getVar("id_petugas"));
            $id_uttp_penyidikan = antiSQLi($this->request->getVar("id_uttp_penyidikan"));
    
            $opr = $this->mpk002->Updatex($id_penyidikan, $id_pengawasan, $sebab, $id_uttp_pengawasan, $tgl_penyidikan, $hasil_penyidikan, $status, $id_petugas, $id_uttp_penyidikan, IdLogin());
    
            if ($opr == "1") {
                // Log update operation
                $ket = "ID Penyidikan: $id_penyidikan,\nID Pengawasan: $id_pengawasan,\nSebab: $sebab,\nID UTTP Pengawasan: $id_uttp_pengawasan,\nTanggal Penyidikan: $tgl_penyidikan,\nHasil Penyidikan: $hasil_penyidikan,\nStatus: $status,\nID Petugas: $id_petugas,\nID UTTP Penyidikan: $id_uttp_penyidikan";
                $this->mlog->LogHistory("Penyidikan", "Update", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data Penyidikan Berhasil di Update"}');
            } else {
                echo base64_encode('{"kode":"02","pesan":"Data Penyidikan Gagal Diupdate, Periksa Kembali Isian Anda"}');
            }
        } else {
            echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Update Data Pada Form Ini"}');
        }
    }
    
    
}