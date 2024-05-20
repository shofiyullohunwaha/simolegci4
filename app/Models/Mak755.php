<?php
namespace App\Models;
use CodeIgniter\Model;
class Mak755 extends Model{
    public function getData(){
        $sql = "SELECT a.*, b.nama AS level FROM akses AS a LEFT JOIN level AS b ON a.id_level = b.id ORDER BY a.id_level";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id){
        $sql = "SELECT * FROM akses WHERE id = '$id' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter2($username){
        $sql = "SELECT * FROM akses WHERE username = '$username' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id, $nama, $username, $password, $level, $status, $idlogin){
        $sql = "INSERT INTO akses VALUES('$id','$nama','$username','$password','$level','$status',NOW(),'0000-00-00','$idlogin','')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    public function Updatex($id, $nama, $level, $status, $idlogin){
        $sql = "UPDATE akses SET nama='$nama', id_level='$level', status='$status', tgl_update=NOW(), id_update='$idlogin' WHERE id='$id'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    public function Deletex($id){
        $sql = "DELETE FROM akses WHERE id='$id'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    public function Resetx($id, $password, $idlogin){
        $sql = "UPDATE akses SET password='$password', tgl_update=NOW(), id_update='$idlogin' WHERE id='$id'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
}