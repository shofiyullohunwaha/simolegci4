<?php
namespace App\Models;
use CodeIgniter\Model;
class Mds002 extends Model{
    public function getData(){
        $sql = "SELECT * FROM desa ORDER BY id_desa";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function getDatap(){
        $sql = "SELECT * FROM provinsi ORDER BY id_provinsi";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function getDatak($id_provinsi){
        $sql = "SELECT * FROM kab_kota WHERE provinsi_id = ? ORDER BY id_kab";
        $dt = db_connect()->query($sql, [$id_provinsi]);
        return $dt ? $dt->getResult() : [];
    }
    public function getDatakc($id_kab){
        $sql = "SELECT * FROM kecamatan WHERE kab_id = ? ORDER BY id_kec";
        $dt = db_connect()->query($sql, [$id_kab]);
        return $dt ? $dt->getResult() : [];
    }
    public function getDatads($id_kec){
        $sql = "SELECT * FROM desa WHERE kec_id = ? ORDER BY id_desa";
        $dt = db_connect()->query($sql, [$id_kec]);
        return $dt ? $dt->getResult() : [];
    }
    public function Filter($id_desa){
        $sql = "SELECT * FROM desa WHERE id_desa = '$id_desa' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function CekUse($id_desa){
        $sql = "SELECT * FROM desa WHERE id_desa = '$id_desa'";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id_desa, $nama, $idlogin){
        $sql = "INSERT INTO desa (id_desa, nama) 
                VALUES ('$id_desa', '$nama')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    
    public function Updatex($id_desa, $nama, $idlogin){
        $sql = "UPDATE desa SET nama='$nama' WHERE id_desa='$id_desa'";
        $query = $this->db->query($sql);
        return $query ? "1" : "0";
    }
    public function Deletex($id_desa){
        $sql = "DELETE FROM desa WHERE id_desa='$id_desa'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
   
}