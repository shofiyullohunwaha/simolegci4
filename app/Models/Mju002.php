<?php
namespace App\Models;
use CodeIgniter\Model;
class Mju002 extends Model{
    public function getData(){
        $sql = "SELECT * FROM jenis_uttp ORDER BY id_jenis";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id_jenis){
        $sql = "SELECT * FROM jenis_uttp WHERE id_jenis = '$id_jenis' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
   
    public function Add($id_jenis, $nama, $satuan,$idlogin){
        $sql = "INSERT INTO jenis_uttp (id_jenis, nama, satuan, tgl_buat, id_buat) 
                VALUES ('$id_jenis', '$nama', '$satuan', NOW(), '$idlogin')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    
    
    public function Updatex($id_jenis, $nama, $satuan, $idlogin){
        $sql = "UPDATE jenis_uttp 
                SET nama = '$nama', satuan = '$satuan', tgl_update = NOW(), id_update = '$idlogin'
                WHERE id_jenis = '$id_jenis'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    
    public function Deletex($id_jenis){
        $sql = "DELETE FROM jenis_uttp WHERE id_jenis='$id_jenis'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
   
}