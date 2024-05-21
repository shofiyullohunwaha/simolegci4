<?php
namespace App\Controllers;
class Va002 extends BaseController{
    protected $hasilc;
    protected $aksesc;
    public function __construct(){
        $h = $this->CekLogin2("form", "va002");
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
            $x["dtxpemilik"]=$this->mpu002->getData();
            $x['dtxtera'] = $this->mra002->teraku();
            return view("basis", $x);
        }else{return redirect()->to(BASEURLKU);}
    }

    public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->mva002->getData();
        foreach ($dt as $k){
            $id_va = $k->id_va;
            $tagihan = $k->tagihan;
            $total = $k->total;
            $tgl_bayar = $k->tgl_bayar;
            $channel = $k->channel;
            $ref = $k->ref;
    
            $tomboledit = "";
            $tombolhapus = "";
    
            if(strpos($this->aksesc, "002") !== false){
                $tomboledit = sprintf("<button type='button' class='btn btn-icon btn-round btn-primary btn-sm mr-1 mb-1' data-id_uttp='%s' onclick='filterin(this)'><i class='icon-pencil'></i></button>", $id_va);
            }
           
            if(strpos($this->aksesc, "003") !== false) {
                $tombolhapus = sprintf("<button type='button' class='btn btn-icon btn-round btn-danger btn-sm mr-1 mb-1' data-id_uttp='%s' onclick='hapus(this)'><i class='icon-trash'></i></button>", $id_va);
            }
    
            $dtisi .= sprintf('["%s","%s","%s","%s","%s","%s","%s","%s"],', $tomboledit.$tombolhapus, $id_va, $tagihan, $total, $tgl_bayar, $channel, $ref);
        }
    
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }
    

    public function filter(){
        $status = false;
        $id_va = trim($this->request->getVar("id_va"));
        $dt = $this->mva002->Filter($id_va);
        
        if(is_array($dt) && count($dt) > 0) {
            foreach($dt as $x){
                $tagihan = $x->tagihan;
                $total = $x->total;
                $tgl_bayar = $x->tgl_bayar;
                $channel = $x->channel;
                $ref = $x->ref;
            }
            $status = true;
        }
        
        if($status){
            echo base64_encode(sprintf('{"kode":"01","pesan":"Data Tersedia","id_va":"%s","tagihan":"%s","total":"%s","tgl_bayar":"%s","channel":"%s","ref":"%s"}', $id_va, $tagihan, $total, $tgl_bayar, $channel, $ref));
        } else {
            echo base64_encode('{"kode":"00","pesan":"Data Tidak ditemukan"}');
        }
    }
    
    
    public function add(){
        if(strpos($this->aksesc, "001") !== false){
            $id_va = kodeotomatis1();
            $tagihan = antiSQLi($this->request->getVar("tagihan"));
            $total = antiSQLi($this->request->getVar("total"));
            $tgl_bayar = antiSQLi($this->request->getVar("tgl_bayar"));
            $channel = antiSQLi($this->request->getVar("channel"));
            $ref = antiSQLi($this->request->getVar("ref"));
            
            $opr = $this->mva002->Add($id_va, $tagihan, $total, $tgl_bayar, $channel, $ref, IdLogin());
            if($opr == "1"){
                // Log the addition operation
                $ket = "ID VA: $id_va,\nTagihan: $tagihan,\nTotal: $total,\nTanggal Bayar: $tgl_bayar,\nChannel: $channel,\nRef: $ref";
                $this->mlog->LogHistory("UTTP", "Tambah", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data VA Berhasil ditambahkan"}');
            } else {
                echo base64_encode('{"kode":"02","pesan":"Gagal menambahkan data VA. Periksa kembali isian Anda."}');
            }
        } else {
            echo base64_encode('{"kode":"00","pesan":"Anda tidak memiliki hak akses untuk menambahkan data pada form ini"}');
        }
    }
    

    public function delete() {
        if(strpos($this->aksesc, "003") !== false) {
            $id_va = antiSQLi($this->request->getVar("id_va"));
            $detail = false;
            $dt = $this->mva002->filter($id_va);
    
            if(is_array($dt)) {
                if(count($dt) > 0) {
                    foreach($dt as $x) {
                        $tagihan = $x->tagihan;
                        $total = $x->total;
                        $tgl_bayar = $x->tgl_bayar;
                        $channel = $x->channel;
                        $ref = $x->ref;
                    }
                    $detail = true;
                }
            }
    
            if($detail) {
                $opr = $this->mva002->Deletex($id_va);
                if($opr == "1") {
                    $ket = "ID VA: $id_va,\nTagihan: $tagihan,\nTotal: $total,\nTanggal Bayar: $tgl_bayar,\nChannel: $channel,\nRef: $ref";
                    $this->mlog->LogHistory("VA", "Hapus", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data VA Berhasil dihapus"}');
                } else {
                    $error_message = "Gagal menghapus data VA. Operasi database gagal.";
                    error_log($error_message);
                    echo base64_encode('{"kode":"02","pesan":"Data VA Gagal Dihapus"}');
                }
            } else {
                $error_message = "Tidak dapat menemukan detail VA dengan ID: $id_va";
                error_log($error_message);
                echo base64_encode('{"kode":"00","pesan":"Data VA tidak lengkap, sehingga tidak dapat dihapus"}');
            }
        } else {
            $error_message = "Anda tidak memiliki hak akses untuk menghapus data VA.";
            error_log($error_message);
            echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Hapus Data Pada Form Ini"}');
        }
    }
    
    
    public function update() {
        if (strpos($this->aksesc, "002") !== false) {
            $id_va = antiSQLi($this->request->getVar("id_va"));
            $tagihan = antiSQLi($this->request->getVar("tagihan"));
            $total = antiSQLi($this->request->getVar("total"));
            $tgl_bayar = antiSQLi($this->request->getVar("tgl_bayar"));
            $channel = antiSQLi($this->request->getVar("channel"));
            $ref = antiSQLi($this->request->getVar("ref"));
            
            $opr = $this->mva002->Updatex($id_va, $tagihan, $total, $tgl_bayar, $channel, $ref);
            if($opr == "1") {
                // Log the update operation
                $ket = "ID VA: $id_va,\nTagihan: $tagihan,\nTotal: $total,\nTanggal Bayar: $tgl_bayar,\nChannel: $channel,\nRef: $ref";
                $this->mlog->LogHistory("VA", "Update", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data VA Berhasil di Update"}');
            } else {
                echo base64_encode('{"kode":"02","pesan":"Data VA Gagal Diupdate, Periksa Kembali Isian Anda"}');
            }
        } else {
            echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Update Data Pada Form Ini"}');
        }
    }

    public function gettera(){
        // $tera = [1716221374];
        $tera = $this->request->getGet('id_tera');
        $date['tera'] = $this->mra002->hteraku($tera);
        return $this->response->setJSON($date);
    }
    
}