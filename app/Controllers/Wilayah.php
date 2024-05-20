<?php
namespace App\Controllers;
class Wilayah extends BaseController{
    protected $hasilc;
    protected $aksesc;
    public function __construct(){
        $h = $this->CekLogin2("form", "wilayah");
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
            // $x["dtxdesa"] = $this->mds002->getData();
            $x['provinsi'] = $this->wilayah->get_provinsi();
            // $x["dtxlevel"] = $this->mle409->getData();
            return view("basis", $x);
        }else{return redirect()->to(BASEURLKU);}
    }

	public function data_kabupaten() {
		$data = $this->wilayah->get_kabupaten();
		foreach ($data->result() as $d) {
			echo "<option value=$d->kab_id>$d->nama</option>";
		}
	}

	public function data_kecamatan() {
		$data = $this->wilayah->get_kecamatan();
		foreach ($data->result() as $k) {
			echo "<option value=$k->kec_id>$k->nama</option>";
		}
	}
	public function data_desa() {
		$data = $this->wilayah->get_desa();
		foreach ($data->result() as $k) {
			echo "<option value=$k->id_desa>$k->nama</option>";
		}
	}
}