<?php
namespace App\Models;
use CodeIgniter\Model;
class Mle409 extends Model{
    public function getData(){
        $sql = "SELECT * FROM level ORDER BY id";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id){
        $sql = "SELECT * FROM level WHERE id = '$id' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function CekUse($id){
        $sql = "SELECT * FROM akses WHERE id_level = '$id'";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id, $nama, $status, $idlogin){
        $sql = "INSERT INTO level VALUES('$id','$nama','$status',NOW(),'0000-00-00','$idlogin','')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    public function Updatex($id, $nama, $status, $idlogin){
        $sql = "UPDATE level SET nama='$nama', status='$status', tgl_update=NOW(), id_update='$idlogin' WHERE id='$id'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    public function Deletex($id){
        $sql = "DELETE FROM level WHERE id='$id'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
   
}





