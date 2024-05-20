<?php
namespace App\Controllers;

class Ut002 extends BaseController{
    protected $hasilc;
    protected $aksesc;
    
    public function __construct(){
        $h = $this->CekLogin2("form", "ut002");
        $this->aksesc = $h[2];
        $this->hasilc = $h;
    }

    public function index($id_pemilik){
        if($this->hasilc[0]){
            $x["dtlogin"] = $this->hasilc[1];
            $x["akses"] = $this->hasilc[2];
            $x["dtmenu"] = $this->hasilc[3];
            $x["dtform"] = $this->hasilc[4];
            $x["ids"] = $this->hasilc[5];
            $x["idf"] = $this->hasilc[6];
            $x["hal"] = $this->hasilc[7];
            $x["dtxjenis"] = $this->mju002->getData();
            $x["id_pemilik"] = $id_pemilik;
            return view("basis", $x);
        } else {
            return redirect()->to(BASEURLKU);
        }
    }

    public function json() {
        $id_pemilik = $this->request->getGet('id_pemilik');
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->mut002->getDatap($id_pemilik);

        foreach ($dt as $k) {
            $id_uttp = $k->id_uttp;
            $id_jenis = $k->nama;
            $merek = $k->merek;
            $type_model = $k->type_model;
            $no_seri = $k->no_seri;
            $kapasitas = $k->kapasitas;
            $buatan = $k->buatan;
            $koofesien = $k->koofesien;
            $jumlah_nosel = $k->jumlah_nosel;
            $medium = $k->medium;
            $id_pemilik = $k->id_pemilik;
            // $id_buat = $k->id_buat;
            $tgl_beli = $k->tgl_beli;
            $sudah_tera = $k->sudah_tera;
        
            $tomboledit = "";
            $tombolhapus = "";

            if (strpos($this->aksesc, "002") !== false) {
                $tomboledit = sprintf("<button type='button' class='btn btn-icon btn-round btn-primary btn-sm mr-1 mb-1' data-id_uttp='%s' onclick='filterin(this)'><i class='icon-pencil'></i></button>", $id_uttp);
            }

            if (strpos($this->aksesc, "003") !== false) {
                $tombolhapus = sprintf("<button type='button' class='btn btn-icon btn-round btn-danger btn-sm mr-1 mb-1' data-id_uttp='%s' onclick='hapus(this)'><i class='icon-trash'></i></button>", $id_uttp);
            }

            $dtisi .= sprintf('["%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s"],', $tomboledit . $tombolhapus, $id_uttp, $id_jenis, $merek, $type_model, $no_seri, $kapasitas, $buatan, $koofesien, $jumlah_nosel, $medium, $id_pemilik, $tgl_beli, $sudah_tera);
        }

        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }

    public function filter(){
        $status = false;
        $id_uttp = trim($this->request->getVar("id_uttp"));
        $dt = $this->mut002->Filter($id_uttp);

        if (is_array($dt) && count($dt) > 0) {
            foreach ($dt as $x) {
                $id_jenis = $x->id_jenis;
                $merek = $x->merek;
                $type_model = $x->type_model;
                $no_seri = $x->no_seri;
                $kapasitas = $x->kapasitas;
                $buatan = $x->buatan;
                $koofesien = $x->koofesien;
                $jumlah_nosel = $x->jumlah_nosel;
                $medium = $x->medium;
                $id_buat = $x->id_buat;
                $tgl_beli = $x->tgl_beli;
                $sudah_tera = $x->sudah_tera;
            }
            $status = true;
        }

        if ($status) {
            echo base64_encode(sprintf('{"kode":"01","pesan":"Data Tersedia","id_uttp":"%s","id_jenis":"%s","merek":"%s","type_model":"%s","no_seri":"%s","kapasitas":"%s","buatan":"%s","koofesien":"%s","jumlah_nosel":"%s","medium":"%s","id_buat":"%s","tgl_beli":"%s","sudah_tera":"%s"}', $id_uttp, $id_jenis, $merek, $type_model, $no_seri, $kapasitas, $buatan, $koofesien, $jumlah_nosel, $medium, $id_buat, $tgl_beli, $sudah_tera));
        } else {
            echo base64_encode('{"kode":"00","pesan":"Data Tidak ditemukan"}');
        }
    }

    public function add(){
        if (strpos($this->aksesc, "001") !== false) {
            $id_uttp = kodeotomatis1();
            $id_jenis = antiSQLi($this->request->getVar("id_jenis"));
            $merek = antiSQLi($this->request->getVar("merek"));
            $type_model = antiSQLi($this->request->getVar("type_model"));
            $no_seri = antiSQLi($this->request->getVar("no_seri"));
            $kapasitas = antiSQLi($this->request->getVar("kapasitas"));
            $buatan = antiSQLi($this->request->getVar("buatan"));
            $koofesien = antiSQLi($this->request->getVar("koofesien"));
            $jumlah_nosel = antiSQLi($this->request->getVar("jumlah_nosel"));
            $medium = antiSQLi($this->request->getVar("medium"));
            // $id_buat = antiSQLi($this->request->getVar("id_buat"));
            $tgl_beli = antiSQLi($this->request->getVar("tgl_beli"));
            $sudah_tera = antiSQLi($this->request->getVar("sudah_tera"));
            $id_pemilik = antiSQLi($this->request->getVar("id_pemilik"));

            $opr = $this->mut002->Add($id_uttp, $id_jenis, $merek, $type_model, $no_seri, $kapasitas, $buatan, $koofesien, $jumlah_nosel, $medium, $id_pemilik,$tgl_beli, $sudah_tera, IdLogin());
            if ($opr == "1") {
                $ket = "ID UTTP: $id_uttp,\nID Jenis: $id_jenis,\nMerek: $merek,\nType Model: $type_model,\nNo. Seri: $no_seri,\nKapasitas: $kapasitas,\nBuatan: $buatan,\nkoofesien: $koofesien,\nJumlah Nosel: $jumlah_nosel,\nMedium: $medium,,\nId_pemilik: $id_pemilik,\nTanggal Beli: $tgl_beli,\nSedah Tera: $sudah_tera";
                $this->mlog->LogHistory("UTTP", "Tambah", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data UTTP Berhasil ditambahkan"}');
            } else {
                echo base64_encode('{"kode":"02","pesan":"Gagal menambahkan data UTTP. Periksa kembali isian Anda."}');
            }
        } else {
            echo base64_encode('{"kode":"00","pesan":"Anda tidak berhak melakukan proses ini."}');
        }
    }

    public function edit(){
        if (strpos($this->aksesc, "002") !== false) {
            $id_uttp = antiSQLi($this->request->getVar("id_uttp"));
            $id_jenis = antiSQLi($this->request->getVar("id_jenis"));
            $merek = antiSQLi($this->request->getVar("merek"));
            $type_model = antiSQLi($this->request->getVar("type_model"));
            $no_seri = antiSQLi($this->request->getVar("no_seri"));
            $kapasitas = antiSQLi($this->request->getVar("kapasitas"));
            $buatan = antiSQLi($this->request->getVar("buatan"));
            $koofesien = antiSQLi($this->request->getVar("koofesien"));
            $jumlah_nosel = antiSQLi($this->request->getVar("jumlah_nosel"));
            $medium = antiSQLi($this->request->getVar("medium"));
            $id_buat = antiSQLi($this->request->getVar("id_buat"));
            $tgl_beli = antiSQLi($this->request->getVar("tgl_beli"));
            $sudah_tera = antiSQLi($this->request->getVar("sudah_tera"));
            $id_pemilik = antiSQLi($this->request->getVar("id_pemilik"));

            $dt = $this->mut002->getData1($id_uttp);
            $ket = "ID UTTP: $id_uttp,\nID Jenis: $id_jenis,\nMerek: $merek,\nType Model: $type_model,\nNo. Seri: $no_seri,\nKapasitas: $kapasitas,\nBuatan: $buatan,\nkoofesien: $koofesien,\nJumlah Nosel: $jumlah_nosel,\nMedium: $medium,\nID Akun: $id_buat,\nTanggal Beli: $tgl_beli,\nSedah Tera: $sudah_tera,\nId_pemilik: $id_pemilik";

            $opr = $this->mut002->Edit($id_uttp, $id_jenis, $merek, $type_model, $no_seri, $kapasitas, $buatan, $koofesien, $jumlah_nosel, $medium, $id_buat, $tgl_beli, $sudah_tera, $id_pemilik);
            if ($opr == "1") {
                $this->mlog->LogHistory("UTTP", "Edit", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data UTTP Berhasil diedit"}');
            } else {
                echo base64_encode('{"kode":"02","pesan":"Gagal mengedit data UTTP. Periksa kembali isian Anda."}');
            }
        } else {
            echo base64_encode('{"kode":"00","pesan":"Anda tidak berhak melakukan proses ini."}');
        }
    }

    public function hapus() {
        if (strpos($this->aksesc, "003") !== false) {
            $id_uttp = antiSQLi($this->request->getVar("id_uttp"));
            $dt = $this->mut002->getData1($id_uttp);
            $ket = "ID UTTP: $id_uttp";

            foreach ($dt as $k) {
                $id_jenis = $k->id_jenis;
                $merek = $k->merek;
                $type_model = $k->type_model;
                $no_seri = $k->no_seri;
                $kapasitas = $k->kapasitas;
                $buatan = $k->buatan;
                $koofesien = $k->koofesien;
                $jumlah_nosel = $k->jumlah_nosel;
                $medium = $k->medium;
                $id_buat = $k->id_buat;
                $tgl_beli = $k->tgl_beli;
                $sudah_tera = $k->sudah_tera;
                $id_pemilik = $k->id_pemilik;
            }

            $ket .= sprintf(",\nID Jenis: %s,\nMerek: %s,\nType Model: %s,\nNo. Seri: %s,\nKapasitas: %s,\nBuatan: %s,\nKoofesien: %s,\nJumlah Nosel: %s,\nMedium: %s,\nID Akun: %s,\nTanggal Beli: %s,\nSedah Tera: %s,\nId_pemilik: %s", $id_jenis, $merek, $type_model, $no_seri, $kapasitas, $buatan, $koofesien, $jumlah_nosel, $medium, $id_buat, $tgl_beli, $sudah_tera, $id_pemilik);

            $opr = $this->mut002->Hapus($id_uttp);
            if ($opr == "1") {
                $this->mlog->LogHistory("UTTP", "Hapus", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data UTTP Berhasil dihapus"}');
            } else {
                echo base64_encode('{"kode":"02","pesan":"Gagal menghapus data UTTP. Periksa kembali isian Anda."}');
            }
        } else {
            echo base64_encode('{"kode":"00","pesan":"Anda tidak berhak melakukan proses ini."}');
        }
    }
}