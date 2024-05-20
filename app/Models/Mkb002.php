<?php
namespace App\Models;
use CodeIgniter\Model;
class Mkb002 extends Model{
    public function getData(){
        $sql = "SELECT * FROM kab_kota ORDER BY id_kab";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id_kab){
        $sql = "SELECT * FROM kab_kota WHERE id_kab = '$id_kab' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function CekUse($id_kab){
        $sql = "SELECT * FROM kab_kota WHERE id_kab = '$id_kab'";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id_kab, $nama, $idlogin){
        $sql = "INSERT INTO kab_kota (id_kab, nama) 
                VALUES ('$id_kab', '$nama')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    
    public function Updatex($id_kab, $nama, $idlogin){
        $sql = "UPDATE kab_kota SET nama='$nama' WHERE id_kab='$id_kab'";
        $query = $this->db->query($sql);
        return $query ? "1" : "0";
    }
    

    public function Deletex($id_kab){
        $sql = "DELETE FROM kab_kota WHERE id_kab='$id_kab'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
   
}