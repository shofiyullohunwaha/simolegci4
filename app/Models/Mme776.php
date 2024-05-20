<?php
namespace App\Models;
use CodeIgniter\Model;
class Mme776 extends Model{
    public function getData(){
        $sql = "SELECT * FROM menu ORDER BY urut";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id){
        $sql = "SELECT * FROM menu WHERE id = '$id' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function CekUse($id){
        $sql = "SELECT * FROM form WHERE id_sistem = '$id'";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id, $nama, $urut, $status, $icon, $idlogin){
        $sql = "INSERT INTO menu VALUES('$id','$nama','$icon','$status','$urut',NOW(),'0000-00-00','$idlogin','')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    public function Updatex($id, $nama, $urut, $status, $icon, $idlogin){
        $sql = "UPDATE menu SET nama='$nama', icon='$icon', status='$status', urut='$urut', tgl_update=NOW(), id_update='$idlogin' WHERE id='$id'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    public function Deletex($id){
        $sql = "DELETE FROM menu WHERE id='$id'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
   
}