<?php
namespace App\Models;
use CodeIgniter\Model;
class Mlog extends Model{
    public function Login($u, $p){
        $sql = "SELECT * FROM akses WHERE (id = '$u' OR username = '$u') AND password = '$p' AND status = 'Y'";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }

    public function CekSistem($idform){
        $sql = "SELECT * FROM form WHERE id = '$idform' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }

    public function CekLogin($id, $ps){
        $dx = $this->Login($id, $ps);
        $idlevel = "";
        if(is_array($dx)){
            if(count($dx)>0){
                foreach($dx as $t){$idlevel = $t->id_level;}
            }
        }
        if($idlevel == ""){return 0;}
        else{
            if($idlevel == "000"){
                $sql = "SELECT a.id, a.nama, a.username, a.id_level, a.status, b.id AS id_sistem, (SELECT nama FROM level WHERE id = a.id_level) AS level, b.nama AS sistem, b.icon, b.deskripsi FROM akses AS a, sistem AS b WHERE a.id = '$id' AND a.password = '$ps' AND a.status = 'Y' AND b.status = 'Y' GROUP BY a.id, a.username, b.id ORDER BY b.urut";
            }else{
                $sql = "SELECT a.id, a.nama, a.username, a.id_level, a.status, c.id_sistem, d.nama AS level, e.nama AS sistem, e.icon, e.deskripsi FROM akses AS a LEFT JOIN form_level AS b ON a.id_level = b.id_level LEFT JOIN form AS c ON b.id_form = c.id LEFT JOIN level AS d ON a.id_level = d.id LEFT JOIN sistem AS e ON c.id_sistem = e.id WHERE a.id = '$id' AND a.password = '$ps' AND a.status = 'Y' AND e.status = 'Y' GROUP BY a.id, a.username, c.id_sistem ORDER BY e.urut";
            }
        }
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }

    public function CekMenu($idsistem, $idlevel){
        if($idlevel == "000"){
			$sql = "SELECT a.id AS id_menu, a.nama AS menu, a.icon AS icon_menu FROM menu AS a JOIN form AS b ON a.id = b.id_menu WHERE b.id_sistem = '$idsistem' AND b.id NOT IN (".admin_forbidden.") GROUP BY a.id ORDER BY a.urut";
		}else{
			$sql = "SELECT a.id AS id_menu, a.nama AS menu, a.icon AS icon_menu FROM menu AS a JOIN form AS b ON a.id = b.id_menu JOIN form_level AS c ON b.id = c.id_form WHERE b.id_sistem = '$idsistem' AND c.id_level = '$idlevel' GROUP BY a.id ORDER BY a.urut";
		}
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }

    public function CekForm($idsistem, $idlevel){
        if($idlevel == "000"){
			$sql = "SELECT id AS id_form, nama AS nama_form, id_menu, id_sistem, icon AS icon_form, (SELECT GROUP_CONCAT(id) FROM kode_akses ORDER BY id) AS akses, tampil FROM form WHERE id_sistem = '$idsistem' AND status = 'Y' AND id NOT IN (".admin_forbidden.") ORDER BY id_sistem, id_menu, urut";
		}else{
			$sql = "SELECT b.id AS id_form, b.nama AS nama_form, b.id_menu, b.id_sistem, b.icon AS icon_form, c.id_level, c.akses, b.tampil FROM menu AS a JOIN form AS b ON a.id = b.id_menu JOIN form_level AS c ON b.id = c.id_form WHERE b.id_sistem = '$idsistem' AND c.id_level = '$idlevel' AND b.status = 'Y' ORDER BY a.urut, b.urut";
		}
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }

    public function UpdatePassword($u, $p){
        $sql = "UPDATE akses SET password = '$p' WHERE id = '$u'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }

    public function LogHistory($data, $operasi, $keterangan, $idlogin, $kodeoto){
        $sql = "INSERT INTO log_history VALUES('$kodeoto','$data','$operasi','$keterangan','$idlogin',NOW())";
        $dt = db_connect()->query($sql);
    }
}