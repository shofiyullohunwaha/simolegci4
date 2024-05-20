<?php
namespace App\Models;
use CodeIgniter\Model;
class Mpn002 extends Model{
    public function getData(){
        $sql = "SELECT * FROM pengawasan ORDER BY id_pengawasan";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id_pengawasan){
        $sql = "SELECT * FROM pengawasan WHERE id_pengawasan = '$id_pengawasan' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id_pengawasan, $jns_pengawasan, $id_uttp_ulang, $tgl_pengawasan, $hasil_pengawasan, $status, $id_petugas, $id_uttp_pengawasan, $idlogin) {
        $sql = "INSERT INTO pengawasan (id_pengawasan, jns_pengawasan, id_uttp_ulang, tgl_pengawasan, hasil_pengawasan, status, id_petugas, id_uttp_pengawasan, tgl_buat,id_buat) 
                VALUES ('$id_pengawasan', '$jns_pengawasan', '$id_uttp_ulang', '$tgl_pengawasan', '$hasil_pengawasan', '$status', '$id_petugas', '$id_uttp_pengawasan', NOW(),'$idlogin')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    
    public function Updatex($id_pengawasan, $jns_pengawasan, $id_uttp_ulang, $tgl_pengawasan, $hasil_pengawasan, $status, $id_petugas, $id_uttp_pengawasan, $idlogin) {
        $sql = "UPDATE pengawasan 
                SET jns_pengawasan = '$jns_pengawasan', id_uttp_ulang = '$id_uttp_ulang', tgl_pengawasan = '$tgl_pengawasan', hasil_pengawasan = '$hasil_pengawasan', status = '$status', id_petugas = '$id_petugas', id_uttp_pengawasan = '$id_uttp_pengawasan', tgl_update = NOW(), id_update = '$idlogin'
                WHERE id_pengawasan = '$id_pengawasan'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    
    public function Deletex($id_pengawasan){
        $sql = "DELETE FROM pengawasan WHERE id_pengawasan='$id_pengawasan'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
}