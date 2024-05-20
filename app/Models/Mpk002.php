<?php
namespace App\Models;
use CodeIgniter\Model;
class Mpk002 extends Model{
    public function getData(){
        $sql = "SELECT * FROM penyidikan ORDER BY id_penyidikan";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id_penyidikan){
        $sql = "SELECT * FROM penyidikan WHERE id_penyidikan = '$id_penyidikan' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id_penyidikan, $id_pengawasan, $sebab, $id_uttp_pengawasan, $tgl_penyidikan, $hasil_penyidikan, $status, $id_petugas, $id_uttp_penyidikan, $idlogin) {
        $sql = "INSERT INTO penyidikan (id_penyidikan, id_pengawasan, sebab, id_uttp_pengawasan, tgl_penyidikan, hasil_penyidikan, status, id_petugas, id_uttp_penyidikan, tgl_buat, id_buat) 
                VALUES ('$id_penyidikan', '$id_pengawasan', '$sebab', '$id_uttp_pengawasan', '$tgl_penyidikan', '$hasil_penyidikan', '$status', '$id_petugas', '$id_uttp_penyidikan', NOW(), '$idlogin')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    
    public function Updatex($id_penyidikan, $id_pengawasan, $sebab, $id_uttp_pengawasan, $tgl_penyidikan, $hasil_penyidikan, $status, $id_petugas, $id_uttp_penyidikan, $idlogin) {
        $sql = "UPDATE penyidikan 
                SET sebab = '$sebab', id_uttp_pengawasan = '$id_uttp_pengawasan', tgl_penyidikan = '$tgl_penyidikan', hasil_penyidikan = '$hasil_penyidikan', status = '$status', id_petugas = '$id_petugas', id_uttp_penyidikan = '$id_uttp_penyidikan', tgl_update = NOW(), id_update = '$idlogin'
                WHERE id_penyidikan = '$id_penyidikan'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    
    
    public function Deletex($id_penyidikan){
        $sql = "DELETE FROM penyidikan WHERE id_penyidikan='$id_penyidikan'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
}