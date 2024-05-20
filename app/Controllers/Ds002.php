<?php
namespace App\Controllers;
class Ds002 extends BaseController{
    protected $hasilc;
    protected $aksesc;
    public function __construct(){
        $h = $this->CekLogin2("form", "ds002");
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
        $dt = $this->mds002->getData();
        foreach ($dt as $k){
            $id_desa = $k->id_desa;
            $nama = $k->nama; 
            $tomboledit = "";
            $tombolhapus = "";
            if(strpos($this->aksesc, "002") !== false){
                $tomboledit = sprintf("<button type='button' class='btn btn-icon btn-round btn-primary btn-sm mr-1 mb-1' data-id_desa='%s' onclick='filterin(this)'><i class='icon-pencil'></i></button>", $id_desa);
            }
            if(strpos($this->aksesc, "003") !== false) {
                $tombolhapus = sprintf("<button type='button' class='btn btn-icon btn-round btn-danger btn-sm mr-1 mb-1' data-id_desa='%s' onclick='hapus(this)'><i class='icon-trash'></i></button>", $id_desa);
            }
           
            // Add the button HTML and other data to the row
            $dtisi .= sprintf('["%s","%s","%s"],', $tomboledit.$tombolhapus, $id_desa, $nama);
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }
    
   
    public function filter() {
        $status = false;
        $id_desa = antiSQLi($this->request->getVar("id_desa"));
        $nama = "";
        $dt = $this->mds002->Filter($id_desa);
        
        if(is_array($dt) && count($dt) > 0) {
            $status = true;
            foreach($dt as $x) {
                $nama = $x->nama;
                // Add any other data retrieval logic here if needed
            }
        }
    
        if($status) {
            $response = array("kode" => "01", "pesan" => "Data Tersedia", "nama" => $nama);
        } else {
            $response = array("kode" => "00", "pesan" => "Data Tidak ditemukan");
        }
    
        echo base64_encode(json_encode($response));
    }
    
    public function add(){
        if(strpos($this->aksesc, "001") !== false){
            $id_desa = antiSQLi($this->request->getVar("id_desa"));
            $nama = antiSQLi($this->request->getVar("nama"));
            $hasilcek = true;
            $cek = $this->mds002->Filter($id_desa);

            if(is_array($cek)){if(count($cek)>0){$hasilcek = false;}}
            if($hasilcek){
                
                $opr = $this->mds002->Add($id_desa, $nama,  IdLogin());
                if($opr == "1"){
                    $ket = "ID: $id_desa,\nNama: $nama,";
                    $this->mlog->LogHistory("Menu", "Tambah", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data Menu Berhasil di Tambahkan"}');
                }else{echo base64_encode('{"kode":"02","pesan":"Data Menu Gagal Ditambahkan, Periksa Kembali Isian Anda"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Kode Menu yang Anda Masukkan Sudah Ada"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Menambah Data Pada Form Ini"}');}
    }
    public function update(){
        if(strpos($this->aksesc, "002") !== false){
            $id_desa = antiSQLi($this->request->getVar("id_desa"));
            $nama = antiSQLi($this->request->getVar("nama"));
            
            $opr = $this->mds002->Updatex($id_desa,$nama,IdLogin());
            if($opr == "1"){
                $ket = "ID: $id_desa,\nNama: $nama,";
				$this->mlog->LogHistory("Akun", "Update", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data Akun Berhasil di Update"}');
            }else{echo base64_encode('{"kode":"02","pesan":"Data Akun Gagal Diupdate, Periksa Kembali Isian Anda"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Update Data Pada Form Ini"}');}
    }

    public function delete(){
        if(strpos($this->aksesc, "003") !== false){
            $id_desa = antiSQLi($this->request->getVar("id_desa"));
            $detail = false;
            $dt = $this->mds002->filter($id_desa);
            if(is_array($dt)){
                if(count($dt)>0){
                    foreach($dt as $x){
                        $nama = $x->nama;
                        
                    }
                    $detail = true;
                }
            }
            if($detail){
                $opr = $this->mds002->Deletex($id_desa);
                if($opr == "1"){
                    $ket = "ID: $id_desa,\nNama: $nama,";
                    $this->mlog->LogHistory("Akun", "Hapus", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data Akun Berhasil di Hapus"}');
                }else{echo base64_encode('{"kode":"02","pesan":"Data Akun Gagal Di Hapus"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Data Akun Ini Tidak Lengkap, Sehingga Tidak Dapat di Hapus"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Hapus Data Pada Form Ini"}');}
    }
}