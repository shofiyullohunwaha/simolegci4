<?php
namespace App\Controllers;
class Pg003 extends BaseController{
    protected $hasilc;
    protected $aksesc;
    public function __construct(){
        $h = $this->CekLogin2("form", "pg003");
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
            $x["dtxdesa"] = $this->mds002->getData();
            $x["dtxprov"] = $this->mds002->getDatap();
            // $x["dtxlevel"] = $this->mle409->getData();
            return view("basis", $x);
        }else{return redirect()->to(BASEURLKU);}
    }
    public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->mpg003->getData();
        foreach ($dt as $k){
            $id_pegawai = $k->id_pegawai;
            $nama_pegawai = $k->nama_pegawai;
            $jenis_kelamin = $k->jenis_kelamin;
            $no_telpon = $k->no_telpon;
            $email = $k->email;
            $id_desa = $k->nama;
            $tomboledit = "";
            $tombolhapus = "";
    
            if(strpos($this->aksesc, "002") !== false){
                $tomboledit = sprintf("<button type='button' class='btn btn-icon btn-round btn-primary btn-sm mr-1 mb-1' data-id_pegawai='%s' onclick='filterin(this)'><i class='icon-pencil'></i></button>", $id_pegawai);
            }
           
            if(strpos($this->aksesc, "003") !== false) {
                $tombolhapus = sprintf("<button type='button' class='btn btn-icon btn-round btn-danger btn-sm mr-1 mb-1' data-id_pegawai='%s' onclick='hapus(this)'><i class='icon-trash'></i></button>", $id_pegawai);
            }
    
            $dtisi .= sprintf('["%s","%s","%s","%s","%s","%s","%s"],', $tomboledit.$tombolhapus, $id_pegawai, $nama_pegawai, $jenis_kelamin, $no_telpon, $email, $id_desa);
        }
    
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }

    public function filter(){
        $status = false;
        $id_pegawai = trim($this->request->getVar("id_pegawai"));
        $dt = $this->mpg003->Filter($id_pegawai);
        
        if(is_array($dt) && count($dt) > 0) {
            foreach($dt as $x){
                $nama_pegawai = $x->nama_pegawai;
                $jenis_kelamin = $x->jenis_kelamin;
                $no_telpon = $x->no_telpon;
                $email = $x->email;
                $id_desa = $x->id_desa;
            }
            $status = true;
        }
        
        if($status){
            echo base64_encode(sprintf('{"kode":"01","pesan":"Data Tersedia","id_pegawai":"%s","nama_pegawai":"%s","jenis_kelamin":"%s","no_telpon":"%s","email":"%s","id_desa":"%s"}', $id_pegawai, $nama_pegawai, $jenis_kelamin, $no_telpon, $email, $id_desa));
        } else {
            echo base64_encode('{"kode":"00","pesan":"Data Tidak ditemukan"}');
                }
    }
            
    public function add(){
        if(strpos($this->aksesc, "001") !== false){
            $id_pegawai = kodeotomatis1();
            $nama_pegawai = antiSQLi($this->request->getVar("nama_pegawai"));
            $jenis_kelamin = antiSQLi($this->request->getVar("jenis_kelamin"));
            $no_telpon = antiSQLi($this->request->getVar("no_telpon"));
            $email = antiSQLi($this->request->getVar("email"));
            $id_desa = antiSQLi($this->request->getVar("id_desa"));
            
            $opr = $this->mpg003->Add($id_pegawai, $nama_pegawai, $jenis_kelamin, $no_telpon, $email, $id_desa, IdLogin());
            if($opr == "1"){
                // Log the addition operation
                $ket = "ID Pegawai: $id_pegawai,\nNama Pegawai: $nama_pegawai,\nJenis Kelamin: $jenis_kelamin,\nNo. Telpon: $no_telpon,\nEmail: $email,\nID Desa: $id_desa";
                $this->mlog->LogHistory("Akun", "Tambah", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data Pegawai Berhasil ditambahkan"}');
            } else {
                echo base64_encode('{"kode":"02","pesan":"Gagal menambahkan data Pegawai. Periksa kembali isian Anda."}');
            }
        } else {
            echo base64_encode('{"kode":"00","pesan":"Anda tidak memiliki hak akses untuk menambahkan data pada form ini"}');
        }
    }

    public function delete() {
        if(strpos($this->aksesc, "003") !== false) {
            $id_pegawai = antiSQLi($this->request->getVar("id_pegawai"));
            $detail = false;
            $dt = $this->mpg003->filter($id_pegawai);
    
            if(is_array($dt)) {
                if(count($dt) > 0) {
                    foreach($dt as $x) {
                        $nama_pegawai = $x->nama_pegawai;
                        $jenis_kelamin = $x->jenis_kelamin;
                        $no_telpon = $x->no_telpon;
                        $email = $x->email;
                        $id_desa = $x->id_desa;
                    }
                    $detail = true;
                }
            }
    
            if($detail) {
                $opr = $this->mpg003->Deletex($id_pegawai);
                if($opr == "1") {
                    $ket = "ID: $id_pegawai,\nNama_pegawai: $nama_pegawai,\njenis_kelamin : $jenis_kelamin, \nno_telpon: $no_telpon,\nEmail: $email,\nTelpon : $no_telpon,\nDesa: $id_desa";
                    $this->mlog->LogHistory("nama_pegawai", "Tambah", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data pemilik Berhasil di Hapus"}');
                } else {
                    $error_message = "Gagal menghapus data pemilik. Operasi database gagal.";
                    error_log($error_message);
                    echo base64_encode('{"kode":"02","pesan":"Data pemilik Gagal Di Hapus"}');
                }
            } else {
                $error_message = "Tidak dapat menemukan detail pegawai dengan ID: $id_pegawai";
                error_log($error_message);
                echo base64_encode('{"kode":"00","pesan":"Data pemilik Ini Tidak Lengkap, Sehingga Tidak Dapat di Hapus"}');
            }
        } else {
            $error_message = "Anda tidak memiliki hak akses untuk menghapus data pegawai.";
            error_log($error_message);
            echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Hapus Data Pada Form Ini"}');
        }
    }
    
    public function update() {
        if (strpos($this->aksesc, "002") !== false) {
            $id_pegawai = antiSQLi($this->request->getVar("id_pegawai"));
            $nama_pegawai = antiSQLi($this->request->getVar("nama_pegawai"));
            $jenis_kelamin = antiSQLi($this->request->getVar("jenis_kelamin"));
            $no_telpon = antiSQLi($this->request->getVar("no_telpon"));
            $email = antiSQLi($this->request->getVar("email"));
            $id_desa = antiSQLi($this->request->getVar("id_desa"));
            
            $opr = $this->mpg003->Updatex($id_pegawai, $nama_pegawai, $jenis_kelamin, $no_telpon, $email, $id_desa, IdLogin());
            if($opr == "1"){
                // Log the addition operation
                $ket = "ID Pegawai: $id_pegawai,\nNama Pegawai: $nama_pegawai,\nJenis Kelamin: $jenis_kelamin,\nNo. Telpon: $no_telpon,\nEmail: $email,\nID Desa: $id_desa";
                $this->mlog->LogHistory("Akun", "Tambah", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data pegawai Berhasil di Update"}');
            } else {
                echo base64_encode('{"kode":"02","pesan":"Data pegawai Gagal Diupdate, Periksa Kembali Isian Anda"}');
            }
        } else {
            echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Update Data Pada Form Ini"}');
        }
    }

    public function getkab(){
        $id_provinsi = $this->request->getPost('provinsi_id');
        $data['kabupaten'] = $this->mds002->getDatak($id_provinsi);
        return $this->response->setJSON($data);
    }

    public function getkec(){
        $id_kab = $this->request->getPost('kab_id');
        $data['kecamatan'] = $this->mds002->getDatakc($id_kab);
        return $this->response->setJSON($data);
    }

    public function getds(){
        $id_kec = $this->request->getPost('kec_id');
        $data['desa'] = $this->mds002->getDatads($id_kec);
        return $this->response->setJSON($data);
    }
    
    public function uptkab(){
        $id_provinsi = $this->request->getPost('provinsi_id');
        $data['kabupaten'] = $this->mds002->getDatak($id_provinsi);
        return $this->response->setJSON($data);
    }

    public function upkec(){
        $id_kab = $this->request->getPost('kab_id');
        $data['kecamatan'] = $this->mds002->getDatakc($id_kab);
        return $this->response->setJSON($data);
    }

    public function upds(){
        $id_kec = $this->request->getPost('kec_id');
        $data['desa'] = $this->mds002->getDatads($id_kec);
        return $this->response->setJSON($data);
    }
    

    
}