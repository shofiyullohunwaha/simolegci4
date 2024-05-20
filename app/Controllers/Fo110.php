<?php
namespace App\Controllers;
class Fo110 extends BaseController{
    protected $hasilc;
    protected $aksesc;
    public function __construct(){
        $h = $this->CekLogin2("form", "fo110");
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
            $x["dtxmenu"] = $this->mme776->getData();
            $x["dtxsistem"] = $this->msi933->getData();
            return view("basis", $x);
        }else{return redirect()->to(BASEURLKU);}
    }
    public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->mfo110->getData();
        foreach ($dt as $k){
            $id = $k->id;
            $nama = $k->nama;
            $menu = $k->menu;
            $sistem = $k->sistem;
            $icon = $k->icon;
            $status = $k->status;
            $urut = $k->urut;
            $tampil = $k->tampil;
            $tomboledit = "";
            $tombolhapus = "";
            if(strpos($this->aksesc, "002") !== false){
                $tomboledit = sprintf("<button type='button' class='btn btn-icon btn-round btn-primary btn-sm mr-1 mb-1' data-id='%s' onclick='filter(this)'><i class='icon-pencil'></i></button>", $id);
            }
            if(strpos($this->aksesc, "003") !== false) {
                $tombolhapus = sprintf("<button type='button' class='btn btn-icon btn-round btn-danger btn-sm mr-1 mb-1' data-id='%s' onclick='hapus(this)'><i class='icon-trash'></i></button>", $id);
            }
            $visualicon = "<i class='".$icon."' style='font-size: 25px;'></i>";
            $dtisi .= sprintf('["%s","%s","%s","%s","%s","%s","%s"],', $tomboledit.$tombolhapus, $id, $nama, $menu, $sistem, $visualicon, $tampil);
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }
    public function filter(){
        $status = false;
        $id = antiSQLi($this->request->getVar("id"));
        $dt = $this->mfo110->Filter($id);
        if(is_array($dt)){
            if(count($dt)>0){
                $status = true;
                foreach($dt as $x){
                    $nama = $x->nama;
                    $idmenu = $x->id_menu;
                    $idsistem = $x->id_sistem;
                    $icon = $x->icon;
                    $statusx = $x->status;
                    $urut = $x->urut;
                    $tampil = $x->tampil;
                }
            }
        }
        if($status){
            echo base64_encode(sprintf('{"kode":"01","pesan":"Data Tersedia","nama":"%s","idmenu":"%s","idsistem":"%s","icon":"%s","status":"%s","urut":"%s","tampil":"%s"}', $nama, $idmenu, $idsistem, $icon, $statusx, $urut, $tampil));
        }else{echo base64_encode('{"kode":"00","pesan":"Data Tidak di Temukan"}');}
    }
    public function add(){
        if(strpos($this->aksesc, "001") !== false){
            $id = antiSQLi($this->request->getVar("id"));
            $nama = antiSQLi($this->request->getVar("nama"));
            $menu = antiSQLi($this->request->getVar("menu"));
            $sistem = antiSQLi($this->request->getVar("sistem"));
            $urut = antiSQLi($this->request->getVar("urut"));
            $status = antiSQLi($this->request->getVar("status"));
            $icon = antiSQLi($this->request->getVar("icon"));
            $tampil = antiSQLi($this->request->getVar("tampil"));
            $hasilcek = true;
            $cek = $this->mfo110->Filter($id);
            if(is_array($cek)){if(count($cek)>0){$hasilcek = false;}}
            if($hasilcek){
                $opr = $this->mfo110->Add($id, $nama, $menu, $sistem, $urut, $status, $icon, $tampil, IdLogin());
                if($opr == "1"){
                    $ket = "ID: $id,\nNama: $nama,\nID Menu: $menu,\nID Sistem: $sistem,\nUrut: $urut,\nStatus: $status,\nIcon: $icon,\nTampil: $tampil";
                    $this->mlog->LogHistory("Form", "Tambah", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data Form Berhasil di Tambahkan"}');
                }else{echo base64_encode('{"kode":"02","pesan":"Data Form Gagal Ditambahkan, Periksa Kembali Isian Anda"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Kode Form yang Anda Masukkan Sudah Ada"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Menambah Data Pada Form Ini"}');}
    }
    public function update(){
        if(strpos($this->aksesc, "002") !== false){
            $id = antiSQLi($this->request->getVar("id"));
            $nama = antiSQLi($this->request->getVar("nama"));
            $menu = antiSQLi($this->request->getVar("menu"));
            $sistem = antiSQLi($this->request->getVar("sistem"));
            $urut = antiSQLi($this->request->getVar("urut"));
            $status = antiSQLi($this->request->getVar("status"));
            $icon = antiSQLi($this->request->getVar("icon"));
            $tampil = antiSQLi($this->request->getVar("tampil"));
            $opr = $this->mfo110->Updatex($id, $nama, $menu, $sistem, $urut, $status, $icon, $tampil, IdLogin());
            if($opr == "1"){
                $ket = "ID: $id,\nNama: $nama,\nID Menu: $menu,\nID Sistem: $sistem,\nUrut: $urut,\nStatus: $status,\nIcon: $icon,\nTampil: $tampil";
				$this->mlog->LogHistory("Form", "Update", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data Form Berhasil di Update"}');
            }else{echo base64_encode('{"kode":"02","pesan":"Data Form Gagal Diupdate, Periksa Kembali Isian Anda"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Update Data Pada Form Ini"}');}
    }
    public function delete(){
        if(strpos($this->aksesc, "003") !== false){
            $id = antiSQLi($this->request->getVar("id"));
            $cek = $this->mfo110->CekUse($id);
            $status = true;
            if(is_array($cek)){if(count($cek)>0){$status = false;}}
            if($status){
                $detail = false;
                $dt = $this->mfo110->filter($id);
                if(is_array($dt)){
                    if(count($dt)>0){
                        foreach($dt as $x){
                            $nama = $x->nama;
                            $idmenu = $x->id_menu;
                            $idsistem = $x->id_sistem;
                            $icon = $x->icon;
                            $statusx = $x->status;
                            $urut = $x->urut;
                            $tampil = $x->tampil;
                        }
                        $detail = true;
                    }
                }
                if($detail){
                    $opr = $this->mfo110->Deletex($id);
                    if($opr == "1"){
                        $ket = "ID: $id,\nNama: $nama,\nID Menu: $idmenu,\nID Sistem: $idsistem,\nUrut: $urut,\nStatus: $statusx,\nIcon: $icon,\Tampil: $tampil";
                        $this->mlog->LogHistory("Form", "Hapus", $ket, IdLogin(), kodeotomatis2());
                        echo base64_encode('{"kode":"01","pesan":"Data Form Berhasil di Hapus"}');
                    }else{echo base64_encode('{"kode":"02","pesan":"Data Form Gagal Di Hapus"}');}
                }else{echo base64_encode('{"kode":"00","pesan":"Data Form Ini Tidak Lengkap, Sehingga Tidak Dapat di Hapus"}');}
            }else{echo base64_encode('{"kode":"00","pesan":"Data Form Ini Masih di Gunakan pada Data Form, Sehingga Tidak Dapat di Hapus"}');}
        }else{echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Hapus Data Pada Form Ini"}');}
    }
}

