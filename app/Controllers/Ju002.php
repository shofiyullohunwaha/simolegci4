<?php
namespace App\Controllers;
class Ju002 extends BaseController{
    protected $hasilc;
    protected $aksesc;
    public function __construct(){
        $h = $this->CekLogin2("form", "ju002");
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
        // Define the JSON structure
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->mju002->getData();
        foreach ($dt as $k){
            $id_jenis = $k->id_jenis;
            $nama = $k->nama; 
            $satuan = $k->satuan; 
            $tomboledit = "";
            $tombolhapus = "";
            if(strpos($this->aksesc, "002") !== false){
                $tomboledit = sprintf("<button type='button' class='btn btn-icon btn-round btn-primary btn-sm mr-1 mb-1' data-id_jenis='%s' onclick='filterin(this)'><i class='icon-pencil'></i></button>", $id_jenis);
            }
            if(strpos($this->aksesc, "003") !== false) {
                $tombolhapus = sprintf("<button type='button' class='btn btn-icon btn-round btn-danger btn-sm mr-1 mb-1' data-id_jenis='%s' onclick='hapus(this)'><i class='icon-trash'></i></button>", $id_jenis);
            }
           
            // Add the button HTML and other data to the row
            $dtisi .= sprintf('["%s","%s","%s","%s"],', $tomboledit.$tombolhapus, $id_jenis, $nama,$satuan);
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }

    public function filter(){
        $status = false;
        $id_jenis = trim($this->request->getVar("id_jenis"));
        $dt = $this->mju002->Filter($id_jenis);
        if(is_array($dt)){
            if(count($dt)>0){
                $status = true;
                foreach($dt as $x){
                    $nama = $x->nama;
                    $satuan = $x->satuan;   
                }
            }
        }
        if($status){
            echo base64_encode(sprintf('{"kode":"01","pesan":"Data Tersedia","nama":"%s","satuan":"%s"}', $nama, $satuan));
        }else{echo base64_encode('{"kode":"00","pesan":"Data Tidak di Temukan"}');}
    }

    public function add(){
        if(strpos($this->aksesc, "001") !== false){
            $id_jenis = antiSQLi($this->request->getVar("id_jenis"));
            $nama = antiSQLi($this->request->getVar("nama"));
            $satuan = antiSQLi($this->request->getVar("satuan"));
            $hasilcek = true;
            $cek = $this->mju002->Filter($id_jenis);

            if(is_array($cek)){if(count($cek)>0){$hasilcek = false;}}
            if($hasilcek){
                $opr = $this->mju002->Add($id_jenis, $nama,$satuan , IdLogin());
                if($opr == "1"){
                    $ket = "ID: $id_jenis,\nNama: $nama,\nSatuan: $satuan";
                    $this->mlog->LogHistory("jenis", "Tambah", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data jenis uttp Berhasil di Tambahkan"}');
                }else{echo base64_encode('{"kode":"02","pesan":"Data jenis uttp Gagal Ditambahkan, Periksa Kembali Isian Anda"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Kode jenis uttp yang Anda Masukkan Sudah Ada"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Menambah Data Pada Form Ini"}');}
    }

    public function update(){
        if(strpos($this->aksesc, "002") !== false){
            $id_jenis = antiSQLi($this->request->getVar("id_jenis"));
            $nama = antiSQLi($this->request->getVar("nama"));
            $satuan = antiSQLi($this->request->getVar("satuan"));
            
            $opr = $this->mju002->Updatex($id_jenis, $nama,$satuan , IdLogin());
                if($opr == "1"){
                    $ket = "ID: $id_jenis,\nNama: $nama,\nSatuan: $satuan";
                    $this->mlog->LogHistory("jenis", "Tambah", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data uttp Berhasil di Update"}');
            }else{echo base64_encode('{"kode":"02","pesan":"Data uttp Gagal Diupdate, Periksa Kembali Isian Anda"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Update Data Pada Form Ini"}');}
    }

    public function delete(){
        if(strpos($this->aksesc, "003") !== false){
            $id_jenis = antiSQLi($this->request->getVar("id_jenis"));
            $detail = false;
            $dt = $this->mju002->filter($id_jenis);
            if(is_array($dt)){
                if(count($dt)>0){
                    foreach($dt as $x){
                        $nama = $x->nama;
                        $satuan = $x->satuan;
                       
                    }
                    $detail = true;
                }
            }
            if($detail){
                $opr = $this->mju002->Deletex($id_jenis);
                if($opr == "1"){
                    $ket = "ID: $id_jenis,\nNama: $nama,\nSatuan : $satuan";
                    $this->mlog->LogHistory("Akun", "delate", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data pemilik Berhasil di Hapus"}');
                }else{echo base64_encode('{"kode":"02","pesan":"Data pemilik Gagal Di Hapus"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Data pemilik Ini Tidak Lengkap, Sehingga Tidak Dapat di Hapus"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Hapus Data Pada Form Ini"}');}
    }
}