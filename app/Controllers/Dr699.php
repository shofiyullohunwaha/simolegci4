<?php
namespace App\Controllers;
class Dr699 extends BaseController{
    protected $hasilc;
    protected $aksesc;
    public function __construct(){
        $h = $this->CekLogin2("form", "dr699");
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
            $x["dtxlevel"] = $this->mle409->getData();
            $x["dtxform"] = $this->mfo110->getData();
            $x["dtxakses"] = $this->mka556->getData();
            return view("basis", $x);
        }else{return redirect()->to(BASEURLKU);}
    }
    public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->mdr699->getData();
        foreach ($dt as $k){
            $id = $k->id;
            $level = $k->level;
            $form = $k->form;
            $akses = $k->akses;
            $nama_akses = "";
            if($akses != ""){
                $dtakses = $this->mdr699->getAkses(str_replace(",", "','", $akses));
                if(is_array($dtakses)){
                    if(count($dtakses)>0){
                        foreach($dtakses as $m){
                            $nama_akses = $m->nama_akses;
                        }
                    }
                }
            }
            $tomboledit = "";
            $tombolhapus = "";
            if(strpos($this->aksesc, "002") !== false){
                $tomboledit = sprintf("<button type='button' class='btn btn-icon btn-round btn-primary btn-sm mr-1 mb-1' data-id='%s' onclick='filter(this)'><i class='icon-pencil'></i></button>", $id);
            }
            if(strpos($this->aksesc, "003") !== false) {
                $tombolhapus = sprintf("<button type='button' class='btn btn-icon btn-round btn-danger btn-sm mr-1 mb-1' data-id='%s' onclick='hapus(this)'><i class='icon-trash'></i></button>", $id);
            }
            $dtisi .= sprintf('["%s","%s","%s","%s","%s"],', $tomboledit.$tombolhapus, $id, $form, $level, $nama_akses);
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }
    public function filter(){
        $status = false;
        $id = antiSQLi($this->request->getVar("id"));
        $dt = $this->mdr699->Filter($id);
        if(is_array($dt)){
            if(count($dt)>0){
                $status = true;
                foreach($dt as $x){
                    $idlevel = $x->id_level;
                    $idform = $x->id_form;
                    $akses = $x->akses;
                }
            }
        }
        if($status){
            echo base64_encode(sprintf('{"kode":"01","pesan":"Data Tersedia","level":"%s","form":"%s","akses":"%s"}', $idlevel, $idform, $akses));
        }else{echo base64_encode('{"kode":"00","pesan":"Data Tidak di Temukan"}');}
    }
    public function add(){
        if(strpos($this->aksesc, "001") !== false){
            $id = kodeotomatis1();
            $level = antiSQLi($this->request->getVar("level"));
            $form = antiSQLi($this->request->getVar("form"));
            $akses = antiSQLi($this->request->getVar("akses"));
            $hasilcek = true;
            $cek = $this->mdr699->Filter2($level, $form);
            if(is_array($cek)){if(count($cek)>0){$hasilcek = false;}}
            if($hasilcek){
                $opr = $this->mdr699->Add($id, $level, $form, $akses, IdLogin());
                if($opr == "1"){
                    $ket = "ID: $id,\nID Level: $level,\nID Form: $form,\nKode Akses: $akses";
                    $this->mlog->LogHistory("Form Level", "Tambah", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data Form Level Berhasil di Tambahkan"}');
                }else{echo base64_encode('{"kode":"02","pesan":"Data Form Level Gagal Ditambahkan, Periksa Kembali Isian Anda"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Form pada Level yang Anda Masukkan Sudah Ada"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Menambah Data Pada Form Ini"}');}
    }
    public function update(){
        if(strpos($this->aksesc, "002") !== false){
            $id = antiSQLi($this->request->getVar("id"));
            $level = antiSQLi($this->request->getVar("level"));
            $form = antiSQLi($this->request->getVar("form"));
            $akses = antiSQLi($this->request->getVar("akses"));
            $opr = $this->mdr699->Updatex($id, $level, $form, $akses, IdLogin());
            if($opr == "1"){
                $ket = "ID: $id,\nID Level: $level,\nID Form: $form,\nKode Akses: $akses";
				$this->mlog->LogHistory("Form Level", "Update", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data Form Level Berhasil di Update"}');
            }else{echo base64_encode('{"kode":"02","pesan":"Data Form Level Gagal Diupdate, Periksa Kembali Isian Anda"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Update Data Pada Form Ini"}');}
    }
    public function delete(){
        if(strpos($this->aksesc, "003") !== false){
            $id = antiSQLi($this->request->getVar("id"));
            $detail = false;
            $dt = $this->mdr699->filter($id);
            if(is_array($dt)){
                if(count($dt)>0){
                    foreach($dt as $x){
                        $level = $x->id_level;
                        $form = $x->id_form;
                        $akses = $x->akses;
                    }
                    $detail = true;
                }
            }
            if($detail){
                $opr = $this->mdr699->Deletex($id);
                if($opr == "1"){
                    $ket = "ID: $id,\nID Level: $level,\nID Form: $form,\nKode Akses: $akses";
                    $this->mlog->LogHistory("Form Level", "Hapus", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data Form Level Berhasil di Hapus"}');
                }else{echo base64_encode('{"kode":"02","pesan":"Data Form Level Gagal Di Hapus"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Data Form Level Ini Tidak Lengkap, Sehingga Tidak Dapat di Hapus"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Hapus Data Pada Form Ini"}');}
    }
}