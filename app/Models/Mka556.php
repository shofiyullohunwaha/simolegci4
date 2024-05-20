<?php
namespace App\Models;
use CodeIgniter\Model;
class Mka556 extends Model{
    public function getData(){
        $sql = "SELECT * FROM kode_akses ORDER BY id";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id){
        $sql = "SELECT * FROM kode_akses WHERE id = '$id' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function CekUse($id){
        $sql = "SELECT * FROM form_level WHERE akses LIKE '%$id%'";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id, $nama, $idlogin){
        $sql = "INSERT INTO kode_akses VALUES('$id','$nama',NOW(),'0000-00-00','$idlogin','')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    public function Updatex($id, $nama, $idlogin){
        $sql = "UPDATE kode_akses SET deskripsi='$nama', tgl_update=NOW(), id_update='$idlogin' WHERE id='$id'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    public function Deletex($id){
        $sql = "DELETE FROM kode_akses WHERE id='$id'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
   
}





