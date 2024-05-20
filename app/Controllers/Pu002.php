<?php
namespace App\Controllers;
class Pu002 extends BaseController{
    protected $hasilc;
    protected $aksesc;
    public function __construct(){
        $h = $this->CekLogin2("form", "pu002");
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
            // $id_provinsi = $this->request->getPost('provinsi_id');
            // $x["dtxkab"] = $this->mds002->getDatak($id_provinsi);
            return view("basis", $x);
        }else{return redirect()->to(BASEURLKU);}
    }
    public function json(){
        // Define the JSON structure
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->mpu002->getData();
        foreach ($dt as $k){
            $id_pemilik = $k->id_pemilik;
            $nama_pemilik = $k->nama_pemilik; 
            $nama_usaha = $k->nama_usaha; 
            $narahubung = $k->narahubung; 
            // $izin_pabrik = $k->izin_pabrik; 
            $id_desa = $k->nama; 
            $email = $k->email; 
            $no_telpon = $k->no_telpon; 
            $tomboledit = "";
            $tombolreset = "";
            $tombolhapus = "";
            if(strpos($this->aksesc, "002") !== false){
                $tomboledit = sprintf("<button type='button' class='btn btn-icon btn-round btn-primary btn-sm mr-1 mb-1' data-id_pemilik='%s' onclick='filterin(this)'><i class='icon-pencil'></i></button>", $id_pemilik);
            }
            if(strpos($this->aksesc, "003") !== false) {
                $tombolhapus = sprintf("<button type='button' class='btn btn-icon btn-round btn-danger btn-sm mr-1 mb-1' data-id_pemilik='%s' onclick='hapus(this)'><i class='icon-trash'></i></button>", $id_pemilik);
            }
            if(strpos($this->aksesc, "002") !== false) {
                $tomboldetail = sprintf("<button type='button' class='btn btn-round btn-secondary btn-sm mr-1 mb-1' data-id_pemilik='%s' onclick='detail(this)'>Data UTTP</button>", $id_pemilik);
            }
            
            
           
            // Add the button HTML and other data to the row
            $dtisi .= sprintf('["%s","%s","%s","%s","%s","%s","%s","%s"],', $tomboledit.$tombolhapus.$tomboldetail,$id_pemilik,$nama_pemilik,$nama_usaha,$narahubung,$id_desa,$email,$no_telpon);
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }
    

    public function filter() {
        $status = false;
        $id_pemilik = antiSQLi($this->request->getVar("id_pemilik"));
        $dt = $this->mpu002->Filter($id_pemilik);
        
        if(is_array($dt) && count($dt) > 0) {
            $status = true;
            foreach($dt as $x) {
                $nama_pemilik = $x->nama_pemilik; 
                $nama_usaha = $x->nama_usaha;  
                $narahubung = $x->narahubung; 
                // $izin_pabrik = $x->izin_pabrik; 
                $id_desa = $x->id_desa; 
                $email = $x->email; 
                $no_telpon = $x->no_telpon; 
            }
        }
        if($status){
            echo base64_encode(sprintf('{"kode":"01","pesan":"Data Tersedia","nama_pemilik":"%s","nama_usaha":"%s","narahubung":"%s","id_desa":"%s","email":"%s","no_telpon":"%s"}', $nama_pemilik, $nama_usaha, $narahubung,$id_desa,$email,$no_telpon));
        }else{echo base64_encode('{"kode":"00","pesan":"Data Tidak di Temukan"}');}
    }
    
    public function detail() {
        $status = false;
        $id_pemilik = antiSQLi($this->request->getVar("id_pemilik"));
        $dt = $this->mpu002->Filter($id_pemilik);
        
        if(is_array($dt) && count($dt) > 0) {
            $status = true;
            foreach($dt as $x) {
                $nama_pemilik = $x->nama_pemilik; 
                $nama_usaha = $x->nama_usaha;  
                $narahubung = $x->narahubung; 
                $izin_pabrik = $x->izin_pabrik; 
                $id_desa = $x->id_desa; 
                $email = $x->email; 
                $no_telpon = $x->no_telpon; 
            }
        }
        if($status){
            // Load the view for detail page and pass data to it
            $data['nama_pemilik'] = $nama_pemilik;
            $data['nama_usaha'] = $nama_usaha;
            $data['narahubung'] = $narahubung;
            $data['izin_pabrik'] = $izin_pabrik;
            $data['id_desa'] = $id_desa;
            $data['email'] = $email;
            $data['no_telpon'] = $no_telpon;
            
            return view('Ut002', $data); // Change 'detail_page' to your actual detail page view
        } else {
            // If data not found, redirect or show error message
            return redirect()->to(BASEURLKU); // Or any other action as needed
        }
    }

   
    public function add() {
        if(strpos($this->aksesc, "001") !== false) {
            $id_pemilik = kodeotomatis1();
            $nama_pemilik = antiSQLi($this->request->getVar("nama_pemilik"));
            $nama_usaha = antiSQLi($this->request->getVar("nama_usaha"));
            $narahubung = antiSQLi($this->request->getVar("narahubung"));
            $izin_pabrik = antiSQLi($this->request->getVar("izin_pabrik"));
            $izin_pabrik = antiSQLi($this->request->getVar("izin_pabrik"));
            $id_desa = antiSQLi($this->request->getVar("desa"));
            $email = antiSQLi($this->request->getVar("email"));
            $no_telpon = antiSQLi($this->request->getVar("no_telpon"));
            
            // Cek apakah nama pemilik sudah ada
            $cek = $this->mpu002->filter($id_pemilik);
            if(is_array($cek) && count($cek) > 0) {
                echo base64_encode('{"kode":"02","pesan":"id pemilik sudah ada."}');
                return;
            }
            
            // Lakukan penambahan data
            $opr = $this->mpu002->Add($id_pemilik, $nama_pemilik, $nama_usaha, $izin_pabrik, $narahubung, $id_desa, $email, $no_telpon, IdLogin());
            if($opr == "1") {
                // Log operasi penambahan
                $ket = "ID: $id_pemilik,\nNama_pemilik: $nama_pemilik,\nNama_Usaha : $nama_usaha,\nIzin_Pabrik: $izin_pabrik, \nNarahubung: $narahubung,\nDesa: $id_desa,\nEmail: $email,\nTelpon : $no_telpon";
                $this->mlog->LogHistory("nama_pemilik", "Tambah", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data berhasil ditambahkan."}');
            } else {
                echo base64_encode('{"kode":"02","pesan":"Data gagal ditambahkan, periksa kembali isian Anda."}');
            }
        } else {
            echo base64_encode('{"kode":"00","pesan":"Anda tidak memiliki hak akses menambah data pada form ini."}');
        }
    }
    public function update() {
        if (strpos($this->aksesc, "002") !== false) {
            $id_pemilik = antiSQLi($this->request->getVar("id_pemilik"));
            $nama_pemilik = antiSQLi($this->request->getVar("nama_pemilik"));
            $nama_usaha = antiSQLi($this->request->getVar("nama_usaha"));
            $izin_pabrik = antiSQLi($this->request->getVar("izin_pabrik"));
            $narahubung = antiSQLi($this->request->getVar("narahubung"));
            $id_desa = antiSQLi($this->request->getVar("desa"));
            $email = antiSQLi($this->request->getVar("email"));
            $no_telpon = antiSQLi($this->request->getVar("no_telpon"));
            
            $opr = $this->mpu002->Updatex($id_pemilik, $nama_pemilik, $nama_usaha, $izin_pabrik, $narahubung, $id_desa, $email, $no_telpon, IdLogin());
            
            if ($opr == "1") {
                // Log operasi update
                $ket = "ID: $id_pemilik,\nNama_pemilik: $nama_pemilik,\nNama_Usaha : $nama_usaha,\nIzin_Pabrik: $izin_pabrik, \nNarahubung: $narahubung,\nDesa: $id_desa,\nEmail: $email,\nTelpon : $no_telpon";
                $this->mlog->LogHistory("nama_pemilik", "Update", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data Akun Berhasil di Update"}');
            } else {
                echo base64_encode('{"kode":"02","pesan":"Data Akun Gagal Diupdate, Periksa Kembali Isian Anda"}');
            }
        } else {
            echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Update Data Pada Form Ini"}');
        }
    }
    
    public function delete(){
        if(strpos($this->aksesc, "003") !== false){
            $id_pemilik = antiSQLi($this->request->getVar("id_pemilik"));
            $detail = false;
            $dt = $this->mpu002->filter($id_pemilik);
            if(is_array($dt)){
                if(count($dt)>0){
                    foreach($dt as $x){
                        $nama_pemilik = $x->nama_pemilik; 
                        $nama_usaha = $x->nama_usaha;  
                        $izin_pabrik = $x->izin_pabrik; 
                        $narahubung = $x->narahubung; 
                        $id_desa = $x->id_desa; 
                        $email = $x->email; 
                        $no_telpon = $x->no_telpon; 
                    }
                    $detail = true;
                }
            }
            if($detail){
                $opr = $this->mpu002->Deletex($id_pemilik);
                if($opr == "1"){
                    $ket = "ID: $id_pemilik,\nNama_pemilik: $nama_pemilik,\nNama_Usaha : $nama_usaha, \nNarahubung: $narahubung,\nIzin_Pabrik: $izin_pabrik,\nDesa: $id_desa,\nEmail: $email,\nTelpon : $no_telpon";
                    $this->mlog->LogHistory("nama_pemilik", "Tambah", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data pemilik Berhasil di Hapus"}');
                }else{echo base64_encode('{"kode":"02","pesan":"Data pemilik Gagal Di Hapus"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Data pemilik Ini Tidak Lengkap, Sehingga Tidak Dapat di Hapus"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Hapus Data Pada Form Ini"}');}
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