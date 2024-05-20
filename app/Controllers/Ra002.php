<?php
namespace App\Controllers;
class Ra002 extends BaseController{
    protected $hasilc;
    protected $aksesc;
    public function __construct(){
        $h = $this->CekLogin2("form", "ra002");
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
            $x["dtxtarif"] =$this->mtr002->getData();
            $x["dtxpegawai"] =$this->mpg003->getData();
            $x["dtxpemilik"]=$this->mpu002->getData();
            return view("basis", $x);
            return view('filter_view');
        }else{return redirect()->to(BASEURLKU);}
    }

    public function json(){
        // Define the JSON structure
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        // $dt = $this->mra002->getData();
        $dt = [];
        foreach ($dt as $k){
            $id_tera = $k->id_tera;
            $id_uttp = $k->merek;
            $id_tarif = $k->id_tarif;
            $kategori = $k->kategori;
            $tmpt_sidang = $k->tmpt_sidang;
            $harga = $k->harga;
            $id_petugas = $k->nama_pegawai;
            $tgl_approve = $k->tgl_approve;
            $status = $k->status;
            $alasan = $k->alasan;
            $skkhp = $k->skkhp;
            $harga_skhp = $k->harga_skhp;
            $jenis_tera = $k->jenis_tera;
            $hasil_tera = $k->hasil_tera;
            $tgl_sidang = $k->tgl_sidang;
            $tomboledit = "";
            // $tombolreset = "";?\
            $tombolhapus = "";
            if(strpos($this->aksesc, "002") !== false){
                $tomboledit = sprintf("<button type='button' class='btn btn-icon btn-round btn-primary btn-sm mr-1 mb-1' data-id_tera='%s' onclick='filterin(this)'><i class='icon-pencil'></i></button>", $id_tera);
            }
            if(strpos($this->aksesc, "003") !== false) {
                $tombolhapus = sprintf("<button type='button' class='btn btn-icon btn-round btn-danger btn-sm mr-1 mb-1' data-id_tera='%s' onclick='hapus(this)'><i class='icon-trash'></i></button>", $id_tera);
            }
          
    
            // Add the button HTML and other data to the row
            $dtisi .= sprintf('["%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s"],', $tomboledit.$tombolhapus, $id_tera, $id_uttp,  $id_tarif,  $kategori,$tmpt_sidang,$harga, $id_petugas, $tgl_approve, $status, $alasan, $skkhp, $harga_skhp, $jenis_tera, $hasil_tera, $tgl_sidang);
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }
    
    public function filter() {
        $status1 = false;
        $id_tera = antiSQLi($this->request->getVar("id_tera"));
        $dt = $this->mra002->Filter($id_tera);
        
        if(is_array($dt) && count($dt) > 0) {
            $status = true;
            foreach($dt as $x) {
                $id_uttp = $x->id_uttp;
                $id_tarif = $x->id_tarif;
                $kategori = $x->kategori;
                $tmpt_sidang = $x->tmpt_sidang;
                $harga = $x->harga;
                $id_petugas = $x->id_petugas;
                $tgl_approve = $x->tgl_approve;
                $status = $x->status;
                $alasan = $x->alasan;
                $skkhp = $x->skkhp;
                $harga_skhp = $x->harga_skhp;
                $jenis_tera = $x->jenis_tera;
                $hasil_tera = $x->hasil_tera;
                $tgl_sidang = $x->tgl_sidang;
            }
        }
        if($status){
            echo base64_encode(sprintf('{"kode":"01","pesan":"Data Tersedia","id_uttp":"%s","id_tarif":"%s","kategori":"%s","tmpt_sidang":"%s","harga":"%s","id_petugas":"%s","tgl_approve":"%s","status":"%s","alasan":"%s","skkhp":"%s","harga_skhp":"%s","jenis_tera":"%s","hasil_tera":"%s","tgl_sidang":"%s"}', $id_uttp, $id_tarif, $kategori, $tmpt_sidang, $harga,$id_petugas,$tgl_approve, $status, $alasan, $skkhp, $harga_skhp, $jenis_tera, $hasil_tera, $tgl_sidang));
        }else{
            echo base64_encode('{"kode":"00","pesan":"Data Tidak di Temukan"}');
        }
    }
    

    public function add() {
        if(strpos($this->aksesc, "001") !== false) {
            $id_tera = kodeotomatis1();
            $id_uttp = antiSQLi($this->request->getVar("id_uttp"));
            $id_tarif = antiSQLi($this->request->getVar("id_tarif"));
            $kategori = antiSQLi($this->request->getVar("kategori"));
            $tmpt_sidang = antiSQLi($this->request->getVar("tmpt_sidang"));
            $harga = antiSQLi($this->request->getVar("harga"));
            $id_petugas = antiSQLi($this->request->getVar("id_petugas"));
            $tgl_approve = antiSQLi($this->request->getVar("tgl_approve"));
            $status = antiSQLi($this->request->getVar("status"));
            $alasan = antiSQLi($this->request->getVar("alasan"));
            $skkhp = antiSQLi($this->request->getVar("skkhp"));
            $harga_skhp = antiSQLi($this->request->getVar("harga_skhp"));
            $jenis_tera = antiSQLi($this->request->getVar("jenis_tera"));
            $hasil_tera = antiSQLi($this->request->getVar("hasil_tera"));
            $tgl_sidang = antiSQLi($this->request->getVar("tgl_sidang"));
    
            // Cek apakah id_tera sudah ada
            $cek = $this->mra002->filter($id_tera);
            if(is_array($cek) && count($cek) > 0) {
                echo base64_encode('{"kode":"02","pesan":"id tera sudah ada."}');
                return;
            }
    
            // Lakukan penambahan data
            $opr = $this->mra002->Add($id_tera, $id_uttp, $id_tarif, $kategori, $tmpt_sidang, $harga, $id_petugas, $tgl_approve, $status, $alasan, $skkhp, $harga_skhp, $jenis_tera, $hasil_tera, $tgl_sidang, IdLogin());
            if($opr == "1") {
                // Log operasi penambahan
                $ket = "ID Tera: $id_tera,\nID UTTP: $id_uttp,\nID Tarif : $id_tarif,\nKategori: $kategori,\nTempat Sidang: $tmpt_sidang, \nHarga: $harga, \nid_petugas: $id_petugas,\nTanggal Approve: $tgl_approve,\nStatus: $status,\nAlasan: $alasan,\nSKKHP: $skkhp,\nHarga SKHP: $harga_skhp,\nJenis Tera: $jenis_tera,\nHasil Tera : $hasil_tera,\nTanggal Sidang: $tgl_sidang";
                $this->mlog->LogHistory("tera", "Tambah", $ket, IdLogin(), kodeotomatis2());
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
            $id_tera = antiSQLi($this->request->getVar("id_tera"));
            $id_uttp = antiSQLi($this->request->getVar("id_uttp"));
            $id_tarif = antiSQLi($this->request->getVar("id_tarif"));
            $kategori = antiSQLi($this->request->getVar("kategori"));
            $tmpt_sidang = antiSQLi($this->request->getVar("tmpt_sidang"));
            $harga = antiSQLi($this->request->getVar("harga"));
            $id_petugas = antiSQLi($this->request->getVar("id_petugas"));
            $tgl_approve = antiSQLi($this->request->getVar("tgl_approve"));
            $status = antiSQLi($this->request->getVar("status"));
            $alasan = antiSQLi($this->request->getVar("alasan"));
            $skkhp = antiSQLi($this->request->getVar("skkhp"));
            $harga_skhp = antiSQLi($this->request->getVar("harga_skhp"));
            $jenis_tera = antiSQLi($this->request->getVar("jenis_tera"));
            $hasil_tera = antiSQLi($this->request->getVar("hasil_tera"));
            $tgl_sidang = antiSQLi($this->request->getVar("tgl_sidang"));
            
            $opr = $this->mra002->Updatex($id_tera, $id_uttp, $id_tarif, $kategori, $tmpt_sidang, $harga,$id_petugas, $tgl_approve, $status, $alasan, $skkhp, $harga_skhp, $jenis_tera, $hasil_tera, $tgl_sidang, IdLogin());
            
            if ($opr == "1") {
                // Log operasi update
                $ket = "ID Tera: $id_tera,\nID UTTP: $id_uttp,\nID Tarif: $id_tarif,\nKategori: $kategori,\nTempat Sidang: $tmpt_sidang,\nHarga: $harga,\nid_petugas: $id_petugas,\nTanggal Approve: $tgl_approve,\nStatus: $status,\nAlasan: $alasan,\nSKKHP: $skkhp,\nHarga SKHP: $harga_skhp,\nJenis Tera: $jenis_tera,\nHasil Tera : $hasil_tera,\nTanggal Sidang: $tgl_sidang";
                $this->mlog->LogHistory("ID Tera", "Update", $ket, IdLogin(), kodeotomatis2());
                echo base64_encode('{"kode":"01","pesan":"Data Tera Berhasil di Update"}');
            } else {
                echo base64_encode('{"kode":"02","pesan":"Data Tera Gagal Diupdate, Periksa Kembali Isian Anda"}');
            }
        } else {
            echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses Update Data Pada Form Ini"}');
        }
    }
    

    public function delete(){
        if(strpos($this->aksesc, "003") !== false){
            $id_tera = antiSQLi($this->request->getVar("id_tera"));
            $detail = false;
            $dt = $this->mra002->filter($id_tera);
            if(is_array($dt)){
                if(count($dt)>0){
                    foreach($dt as $x){
                        $id_uttp = $x->id_uttp; 
                        $id_tarif = $x->id_tarif;  
                        $kategori = $x->kategori; 
                        $tmpt_sidang = $x->tmpt_sidang; 
                        $harga = $x->harga; 
                        $id_petugas = $x->id_petugas; 
                        $tgl_approve = $x->tgl_approve; 
                        $status = $x->status; 
                        $alasan = $x->alasan; 
                        $skkhp = $x->skkhp; 
                        $harga_skhp = $x->harga_skhp; 
                        $jenis_tera = $x->jenis_tera; 
                        $hasil_tera = $x->hasil_tera; 
                        $tgl_sidang = $x->tgl_sidang; 
                    }
                    $detail = true;
                }
            }
            if($detail){
                $opr = $this->mra002->Deletex($id_tera);
                if($opr == "1"){
                    $ket = "ID Tera: $id_tera,\nID UTTP: $id_uttp,\nID Tarif: $id_tarif, \nKategori: $kategori,\nTempat Sidang: $tmpt_sidang,\nHarga: $harga,\nid_petugas: $id_petugas,\nTanggal Approve: $tgl_approve,\nStatus: $status,\nAlasan: $alasan,\nSKKHP: $skkhp,\nHarga SKHP: $harga_skhp,\nJenis Tera: $jenis_tera,\nHasil Tera : $hasil_tera,\nTanggal Sidang: $tgl_sidang";
                    $this->mlog->LogHistory("Tera", "Hapus", $ket, IdLogin(), kodeotomatis2());
                    echo base64_encode('{"kode":"01","pesan":"Data Tera Berhasil dihapus"}');
                }else{
                    echo base64_encode('{"kode":"02","pesan":"Data Tera Gagal Dihapus"}');
                }
            }else{
                echo base64_encode('{"kode":"00","pesan":"Data Tera Ini Tidak Lengkap, Sehingga Tidak Dapat Dihapus"}');
            }
        }else{
            echo base64_encode('{"kode":"00","pesan":"Anda Tidak Memiliki Hak Akses untuk Menghapus Data pada Form Ini"}');
        }
    }

    public function filterData() {
        $status = false;
        $startDate = antiSQLi($this->request->getVar("startDate"));
        $endDate = antiSQLi($this->request->getVar("endDate"));
        
        
        // Ensure that both start and end dates are provided
        if (!empty($startDate) && !empty($endDate)) {
            $dt = $this->mra002->filterDataByDates($startDate, $endDate);
            
            if (is_array($dt) && count($dt) > 0) {
                $status = true;
                $data = [];
                foreach ($dt as $x) {
                    $data[] = [
                        "id_tera" => $x->id_tera,
                        "id_uttp" => $x->merek,
                        "id_tarif" => $x->id_tarif,
                        "kategori" => $x->kategori,
                        "tmpt_sidang" => $x->tmpt_sidang,
                        "harga" => $x->harga,
                        "id_petugas" => $x->nama_pegawai,
                        "tgl_approve" => $x->tgl_approve,
                        "status" => $x->status,
                        "alasan" => $x->alasan,
                        "skkhp" => $x->skkhp,
                        "harga_skhp" => $x->harga_skhp,
                        "jenis_tera" => $x->jenis_tera,
                        "hasil_tera" => $x->hasil_tera,
                        "tgl_sidang" => $x->tgl_sidang
                    ];
                }
                echo json_encode(["status" => "01", "data" => $data]);
                return;
            }
        }else {
            $data[] = [];
            echo json_encode(["status" => "01", "data" => $data]);
            return;
        }
        
        echo json_encode(["status" => "00", "message" => "Data Tidak di Temukan"]);
    }
    
    // public function filterData() {
    //     $startDate = $this->request->getPost('startDate');
    //     $endDate = $this->request->getPost('endDate');

    //     $data = $this->mra002->filterDataByDates($startDate, $endDate);
        
    //     return $this->response->setJSON(['data' => $data]);
    // }  

    public function getuttp(){
        $pemilik = $this->request->getPost('pemilik');
        $data['pemilik'] = $this->mut002->getDatap($pemilik);
        return $this->response->setJSON($data);
    }

    public function getjenis(){
        $uttp = $this->request->getGet('id_uttp');
        $jenis = $this->mut002->getjenis($uttp);
        $id_jenis = $jenis[0]->id_jenis;
        $data['jenis'] = $this->mtr002->getjenis($id_jenis);
        return $this->response->setJSON($data);
    }    

    public function getharga(){
        $tarif = $this->request->getGet('id_tarif');
        $sidang = $this->request->getGet('sidang');
        $data['harga'] = $this->mtr002->getharga($tarif, $sidang);
        return $this->response->setJSON($data);
    }
    
}