<?php
namespace App\Models;
use CodeIgniter\Model;
class Mdr699 extends Model{
    public function getData(){
        $sql = "SELECT a.*, b.nama AS level, c.nama AS form FROM form_level AS a LEFT JOIN level AS b ON a.id_level = b.id LEFT JOIN form AS c ON a.id_form = c.id ORDER BY a.id_level";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id){
        $sql = "SELECT * FROM form_level WHERE id = '$id' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter2($level, $form){
        $sql = "SELECT * FROM form_level WHERE id_level = '$level' AND id_form = '$form'";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function getAkses($keyword){
        $sql = "SELECT GROUP_CONCAT(deskripsi SEPARATOR ', ') AS nama_akses FROM kode_akses WHERE id IN('$keyword')";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id, $level, $form, $akses, $idlogin){
        $sql = "INSERT INTO form_level VALUES('$id','$level','$form','$akses',NOW(),'0000-00-00','$idlogin','')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    public function Updatex($id, $level, $form, $akses, $idlogin){
        $sql = "UPDATE form_level SET id_level='$level', id_form='$form', akses='$akses', tgl_update=NOW(), id_update='$idlogin' WHERE id='$id'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    public function Deletex($id){
        $sql = "DELETE FROM form_level WHERE id='$id'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
   
}





