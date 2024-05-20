<?php
namespace App\Controllers;
class Pn002 extends BaseController{
    protected $hasilc;
    protected $aksesc;
    public function __construct(){
        $h = $this->CekLogin2("form", "pn002");
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
            $x["dtxuttp"] =$this->mut002->getData();    
            // $x["dtxtarif"] =$this->mtr002->getData();
            $x["dtxpegawai"] =$this->mpg003->getData();
            return view("basis", $x);
        }else{return redirect()->to(BASEURLKU);}
    }

    public function json(){
        // Define the JSON structure
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->mpn002->getData();
        foreach ($dt as $k){
            $id_pengawasan = $k->id_pengawasan;
            $jns_pengawasan = $k->jns_pengawasan;
            $id_uttp_ulang = $k->id_uttp_ulang;
            $tgl_pengawasan = $k->tgl_pengawasan;
            $hasil_pengawasan = $k->hasil_pengawasan;
            $status = $k->status;
            $id_petugas = $k->id_petugas;
            $id_uttp_pengawasan = $k->id_uttp_pengawasan;
            $tomboledit = "";
            $tombolhapus = "";
            if(strpos($this->aksesc, "002") !== false){
                $tomboledit = sprintf("<button type='button' class='btn btn-icon btn-round btn-primary btn-sm mr-1 mb-1' data-id_pengawasan='%s' onclick='filterin(this)'><i class='icon-pencil'></i></button>", $id_pengawasan);
            }
            if(strpos($this->aksesc, "003") !== false) {
                $tombolhapus = sprintf("<button type='button' class='btn btn-icon btn-round btn-danger btn-sm mr-1 mb-1' data-id_pengawasan='%s' onclick='hapus(this)'><i class='icon-trash'></i></button>", $id_pengawasan);
            }
    
            // Add the button HTML and other data to the row
            $dtisi .= sprintf('["%s","%s","%s","%s","%s","%s","%s","%s","%s"],', $tomboledit.$tombolhapus, $id_pengawasan, $jns_pengawasan, $id_uttp_ulang, $tgl_pengawasan, $hasil_pengawasan, $status, $id_petugas, $id_uttp_pengawasan);
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }
   
    public function filter() {
        $status = false;
        $id_pengawasan = antiSQLi($this->request->getVar("id_pengawasan"));
        $dt = $this->mpn002->Filter($id_pengawasan);
        
        if(is_array($dt) && count($dt) > 0) {
            $status = true;
            foreach($dt as $x) {

                $id_pengawasan = $x->id_pengawasan;
                $jns_pengawasan = $x->jns_pengawasan;
                $id_uttp_ulang = $x->id_uttp_ulang;
                $tgl_pengawasan = $x->tgl_pengawasan;
                $hasil_pengawasan = $x->hasil_pengawasan;
                $status = $x->status;
                $id_petugas = $x->id_petugas;
                $id_uttp_pengawasan = $x->id_uttp_pengawasan;
            }
        }
        if($status){
            echo base64_encode(sprintf('{"kode":"01","pesan":"Data Tersedia","jns_pengawasan":"%s","id_uttp_ulang":"%s","tgl_pengawasan":"%s","hasil_pengawasan":"%s","status":"%s","id_petugas":"%s","id_uttp_pengawasan":"%s"}', $jns_pengawasan, $id_uttp_ulang, $tgl_pengawasan, $hasil_pengawasan, $status, $id_petugas, $id_uttp_pengawasan));
        }else{
            echo base64_encode('{"kode":"00","pesan":"Data Tidak di Temukan"}');
        }
    }
    public function add() {
        if(strpos($this->aksesc, "001") !== false) {
            $id_pengawasan = kodeotomatis1();
            $jns_pengawasan = antiSQLi($this->request->getVar("jns_pengawasan"));
            $id_uttp_ulang = antiSQLi($this->request->getVar("id_uttp_ulang"));
            $tgl_pengawasan = antiSQLi($this->request->getVar("tgl_pengawasan"));
            $hasil_pengawasan = antiSQLi($this->request->getVar("hasil_pengawasan"));
            $status = antiSQLi($this->request->getVar("status"));
            $id_petugas = antiSQLi($this->request->getVar("id_petugas"));
            $id_uttp_pengawasan = antiSQLi($this->request->getVar("id_uttp_pengawasan"));
            
            // Cek apakah id_pengawasan sudah ada
            $cek = $this->mpn002->filter($id_pengawasan);
            if(is_array($cek) && count($cek) > 0) {
                echo base64_encode('{"kode":"02","pesan":"id_pengawasan sudah ada."}');
                return;
            }
    
            // Lakukan penambahan data
            $opr = $this->mpn002->Add($id_pengawasan, $jns_pengawasan, $id_uttp_ulang, $tgl_pengawasan, $hasil_pengawasan, $status, $id_petugas, $id_uttp_pengawasan,IdLogin());
            if($opr == "1") {
                // Log operasi penambahan
                $ket = "ID Pengawasan: $id_pengawasan,\nJenis Pengawasan: $jns_pengawasan,\nID UTTP Ulang: $id_uttp_ulang,\nTanggal Pengawasan: $tgl_pengawasan,\nHasil Pengawasan: $hasil_pengawasan,\nStatus: $status,\nID Petugas: $id_petugas,\nID UTTP Pengawasan: $id_uttp_pengawasan";
                $this->mlog->LogHistory("pengawasan", "Tambah", $ket, IdLogin(), kodeotomatis2());
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
            $id_pengawasan = antiSQLi($this->request->getVar("id_pengawasan"));
            $detail = false;
            $dt = $this->mpn002->filter($id_pengawasan);
            if(is_array($dt)){
                if(count($dt)>0){
                    foreach($dt as $x){
                        $jns_pengawasan = $x->jns_pengawasan;
                        $id_uttp_ulang = $x->id_uttp_ulang;
                        $tgl_pengawasan = $x->tgl_pengawasan;
                        $hasil_pengawasan = $x->hasil_pengawasan;
                        $status = $x->status;
                        $id_petugas = $x->id_petugas;
                        $id_uttp_pengawasan = $x->id_uttp_pengawasan;
                    }
                    $detail = true;
                }
            }
            if($detail){
                $opr = $this->mpn002->Deletex($id_pengawasan);
                if($opr == "1"){
                    // Log deletion operation
                    $ket = "ID Pengawasan: $id_pengawasan,\nJenis Pengawasan: $jns_pengawasan,\nID UTTP Ulang: $id_uttp_ulang,\nTanggal Pengawasan: $tgl_pengawasan,\nHasil Pengawasan: $hasil_pengawasan,\nStatus: $status,\nID Petugas: $id_petugas,\nID UTTP Pengawasan: $id_uttp_pengawasan";
                    $this->mlog->LogHistory("pengawasan", "Tambah", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data Pengawasan Berhasil dihapus"}');
                }else{
                    echo base64_encode('{"kode":"02","pesan":"Data Pengawasan Gagal Dihapus"}');
                }
            }else{
                echo base64_encode('{"kode":"00","pesan":"Data Pengawasan Ini Tidak Lengkap, Sehingga Tidak Dapat Dihapus"}');
            }
        }else{
            echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses untuk Menghapus Data pada Form Ini"}');
        }
    }

    public function update() {
        if (strpos($this->aksesc, "002") !== false) {
            $id_pengawasan = antiSQLi($this->request->getVar("id_pengawasan"));
            $jns_pengawasan = antiSQLi($this->request->getVar("jns_pengawasan"));
            $id_uttp_ulang = antiSQLi($this->request->getVar("id_uttp_ulang"));
            $tgl_pengawasan = antiSQLi($this->request->getVar("tgl_pengawasan"));
            $hasil_pengawasan = antiSQLi($this->request->getVar("hasil_pengawasan"));
            $status = antiSQLi($this->request->getVar("status"));
            $id_petugas = antiSQLi($this->request->getVar("id_petugas"));
            $id_uttp_pengawasan = antiSQLi($this->request->getVar("id_uttp_pengawasan"));
    
            $opr = $this->mpn002->Updatex($id_pengawasan, $jns_pengawasan, $id_uttp_ulang, $tgl_pengawasan, $hasil_pengawasan, $status, $id_petugas, $id_uttp_pengawasan,IdLogin());
    
            if ($opr == "1") {
                // Log update operation
                $ket = "ID Pengawasan: $id_pengawasan,\nJenis Pengawasan: $jns_pengawasan,\nID UTTP Ulang: $id_uttp_ulang,\nTanggal Pengawasan: $tgl_pengawasan,\nHasil Pengawasan: $hasil_pengawasan,\nStatus: $status,\nID Petugas: $id_petugas,\nID UTTP Pengawasan: $id_uttp_pengawasan";
                $this->mlog->LogHistory("Pengawasan", "Update", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data Pengawasan Berhasil di Update"}');
            } else {
                echo base64_encode('{"kode":"02","pesan":"Data Pengawasan Gagal Diupdate, Periksa Kembali Isian Anda"}');
            }
        } else {
            echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Update Data Pada Form Ini"}');
        }
    }
    
    public function get(){
        $dt = $this->mpn002->getData();
        $dtJSON = json_encode(["data" => $dt]); 
        echo $dtJSON;
    }


}