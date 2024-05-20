<?php
namespace App\Models;
use CodeIgniter\Model;
class Mkc002 extends Model{
    public function getData(){
        $sql = "SELECT * FROM kecamatan ORDER BY id_kec";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id_kec){
        $sql = "SELECT * FROM kecamatan WHERE id_kec = '$id_kec' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function CekUse($id_kec){
        $sql = "SELECT * FROM kecamatan WHERE id_kec = '$id_kec'";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id_kec, $nama, $idlogin){
        $sql = "INSERT INTO kecamatan (id_kec, nama) 
                VALUES ('$id_kec', '$nama')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    
    public function Updatex($id_kec, $nama, $idlogin){
        $sql = "UPDATE kecamatan SET nama='$nama' WHERE id_kec='$id_kec'";
        $query = $this->db->query($sql);
        return $query ? "1" : "0";
    }
    

    public function Deletex($id_kec){
        $sql = "DELETE FROM kecamatan WHERE id_kec='$id_kec'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
   
}