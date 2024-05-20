<?php
namespace App\Models;
use CodeIgniter\Model;
class Mpv002 extends Model{
    public function getData(){
        $sql = "SELECT * FROM provinsi ORDER BY id_provinsi";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id_provinsi){
        $sql = "SELECT * FROM provinsi WHERE id_provinsi = '$id_provinsi' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function CekUse($id_provinsi){
        $sql = "SELECT * FROM provinsi WHERE id_provinsi = '$id_provinsi'";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id_provinsi, $nama, $idlogin){
        $sql = "INSERT INTO provinsi (id_provinsi, nama) 
                VALUES ('$id_provinsi', '$nama')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    
    public function Updatex($id_provinsi, $nama, $idlogin){
        $sql = "UPDATE Provinsi SET nama='$nama' WHERE id_provinsi='$id_provinsi'";
        $query = $this->db->query($sql);
        return $query ? "1" : "0";
    }
    

    public function Deletex($id_provinsi){
        $sql = "DELETE FROM provinsi WHERE id_provinsi='$id_provinsi'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }

   
}