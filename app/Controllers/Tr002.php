<?php
namespace App\Controllers;
class Tr002 extends BaseController{
    protected $hasilc;
    protected $aksesc;
    public function __construct(){
        $h = $this->CekLogin2("form", "tr002");
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
            $x["dtxjenis"] =$this->mju002->getData();
            return view("basis", $x);
        }else{return redirect()->to(BASEURLKU);}
    }

    public function json(){
        // Define the JSON structure
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->mtr002->getData();
        foreach ($dt as $k){
            $id_tarif = $k->id_tarif;
            $id_jenis = $k->id_jenis;
            $kategori = $k->kategori; 
            $harga_diluar = $k->harga_diluar; 
            $harga_ditempat = $k->harga_ditempat; 
            $tomboledit = "";
            $tombolhapus = "";
            if(strpos($this->aksesc, "002") !== false){
                $tomboledit = sprintf("<button type='button' class='btn btn-icon btn-round btn-primary btn-sm mr-1 mb-1' data-id_tarif='%s' onclick='filterin(this)'><i class='icon-pencil'></i></button>", $id_tarif);
            }
            if(strpos($this->aksesc, "003") !== false) {
                $tombolhapus = sprintf("<button type='button' class='btn btn-icon btn-round btn-danger btn-sm mr-1 mb-1' data-id_tarif='%s' onclick='hapus(this)'><i class='icon-trash'></i></button>", $id_tarif);
            }
           
            // Add the button HTML and other data to the row
            $dtisi .= sprintf('["%s","%s","%s","%s","%s","%s"],', $tomboledit.$tombolhapus,$id_tarif, $id_jenis, $kategori,$harga_diluar,$harga_ditempat);
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }

    public function filter(){
        $status = false;
        $id_tarif = trim($this->request->getVar("id_tarif"));
        $dt = $this->mtr002->Filter($id_tarif);
        if(is_array($dt)){
            if(count($dt)>0){
                $status = true;
                foreach($dt as $x){
                    $id_tarif = $x->id_tarif;
                    $id_jenis = $x->id_jenis;
                    $kategori = $x->kategori; 
                    $harga_diluar = $x->harga_diluar; 
                    $harga_ditempat = $x->harga_ditempat;   
                }
            }
        }
        if($status){
            echo base64_encode(sprintf('{"kode":"01","pesan":"Data Tersedia","id_tarif":"%s","id_jenis":"%s","kategori":"%s","harga_diluar":"%s","harga_ditempat":"%s"}',$id_tarif, $id_jenis, $kategori,$harga_diluar,$harga_ditempat));
        }else{echo base64_encode('{"kode":"00","pesan":"Data Tidak di Temukan"}');}
    }

    public function add(){
        if(strpos($this->aksesc, "001") !== false){
            $id_tarif = antiSQLi($this->request->getVar("id_tarif"));
            $id_jenis = antiSQLi($this->request->getVar("id_jenis"));
            $kategori = antiSQLi($this->request->getVar("kategori"));
            $harga_diluar = antiSQLi($this->request->getVar("harga_diluar"));
            $harga_ditempat = antiSQLi($this->request->getVar("harga_ditempat"));
            $hasilcek = true;
            $cek = $this->mtr002->Filter($id_tarif);

            if(is_array($cek)){if(count($cek)>0){$hasilcek = false;}}
            if($hasilcek){
                $opr = $this->mtr002->Add($id_tarif,$id_jenis, $kategori,$harga_diluar ,$harga_ditempat, IdLogin());
                if($opr == "1"){
                    $ket = "ID: $id_tarif,\nJenis = $id_jenis\nKategori: $kategori,\nDiluar: $harga_diluar, \nDitempat : $harga_ditempat";
                    $this->mlog->LogHistory("tarif", "Tambah", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data tarif uttp Berhasil di Tambahkan"}');
                }else{echo base64_encode('{"kode":"02","pesan":"Data tarif uttp Gagal Ditambahkan, Periksa Kembali Isian Anda"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Kode tarif uttp yang Anda Masukkan Sudah Ada"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Menambah Data Pada Form Ini"}');}
    }

    public function updatex(){
        if(strpos($this->aksesc, "002") !== false){
            $id_tarif = $this->request->getPost("id_tarif");
            $id_jenis = $this->request->getPost("id_jenis");
            $kategori = $this->request->getPost("kategori");
            $harga_diluar = $this->request->getPost("harga_diluar");
            $harga_ditempat = $this->request->getPost("harga_ditempat");
            
            $opr = $this->mtr002->Updatex($id_tarif, $id_jenis, $kategori, $harga_diluar, $harga_ditempat, IdLogin());
            
            if($opr == "1"){
                $ket = "Id_tarif: $id_tarif,\nId_Jenis = $id_jenis\nKategori: $kategori,\nHarga_diiluar: $harga_diluar, \nHarga_diitempat : $harga_ditempat";
                $this->mlog->LogHistory("tarif", "Update", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data tarif uttp berhasil diupdate"}');
            } else {
                echo base64_encode('{"kode":"02","pesan":"Gagal mengupdate data tarif uttp. Periksa kembali isian Anda."}');
            }
        } else {
            echo base64_encode('{"kode":"00","pesan":"Anda tidak memiliki hak akses untuk mengupdate data pada form ini"}');
        }
    }
    

    public function delete(){
        if(strpos($this->aksesc, "003") !== false){
            $id_tarif = antiSQLi($this->request->getVar("id_tarif"));
            $detail = false;
            $dt = $this->mtr002->filter($id_tarif);
            if(is_array($dt)){
                if(count($dt)>0){
                    foreach($dt as $x){
                        $id_jenis = $x->id_jenis;
                        $kategori = $x->kategori; 
                        $harga_diluar = $x->harga_diluar; 
                        $harga_ditempat = $x->harga_ditempat;  
                       
                    }
                    $detail = true;
                }
            }
            if($detail){
                $opr = $this->mtr002->Deletex($id_tarif,$id_jenis, $kategori,$harga_diluar ,$harga_ditempat, IdLogin());
                if($opr == "1"){
                    $ket = "ID: $id_tarif,\nJenis = $id_jenis\nKategori: $kategori,\nDiluar: $harga_diluar, \nDitempat : $harga_ditempat";
                    $this->mlog->LogHistory("tarif", "Tambah", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data pemilik Berhasil di Hapus"}');
                }else{echo base64_encode('{"kode":"02","pesan":"Data pemilik Gagal Di Hapus"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Data pemilik Ini Tidak Lengkap, Sehingga Tidak Dapat di Hapus"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Hapus Data Pada Form Ini"}');}
    }
}