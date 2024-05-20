<?php
namespace App\Controllers;
class Basis extends BaseController{
    public function x001(){
        $h[0] = $this->CekLogin2("dashboard", "001");
        $h[1] = $this->msistem->getDashboard01();
        $h[2] = $this->msistem->getLogBulanan();
        return $this->keseharusnya($h);
    }
    private function keseharusnya($h){
        if($h[0][0]){
            $x["dtlogin"] = $h[0][1];
            $x["akses"] = $h[0][2];
            $x["dtmenu"] = $h[0][3];
            $x["dtform"] = $h[0][4];
            $x["ids"] = $h[0][5];
            $x["idf"] = $h[0][6];
            $x["hal"] = $h[0][7];
            $x["datax"] = $h[1];
            $x["grafikx"] = $h[2];
            return view("basis", $x);
        }else{return redirect()->to(BASEURLKU);}
    }
}

