<?php
namespace App\Models;
use CodeIgniter\Model;
class Mut002 extends Model{
    public function getData() {
        $sql = "SELECT pu.*, d.nama AS nama FROM uttp AS pu LEFT JOIN jenis_uttp AS d ON pu.id_jenis = d.id_jenis ORDER BY pu.id_uttp";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }

    public function getDatap($id_pemilik) {
        $sql = "SELECT pu.*, d.nama AS nama FROM uttp AS pu LEFT JOIN jenis_uttp AS d ON pu.id_jenis = d.id_jenis WHERE pu.id_pemilik = ? ORDER BY pu.id_uttp";
        $dt = db_connect()->query($sql, [$id_pemilik]);
        return $dt ? $dt->getResult() : 0;
    }

    public function getjenis($id_uttp){
        $sql = "SELECT id_jenis FROM uttp WHERE id_uttp = ?";
        $dt = db_connect()->query($sql, [$id_uttp]);
        return $dt ? $dt->getResult() : 0;
    }
    
    public function Filter($id_uttp){
        $sql = "SELECT * FROM uttp WHERE id_uttp = '$id_uttp' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id_uttp, $id_jenis, $merek, $type_model, $no_seri, $kapasitas, $buatan, $koofesien, $jumlah_nosel, $medium, $id_pemilik, $tgl_beli, $sudah_tera,$idlogin){
        $sql = "INSERT INTO uttp (id_uttp, id_jenis, merek, type_model, no_seri, kapasitas, buatan, koofesien, jumlah_nosel, medium, id_pemilik, tgl_beli, sudah_tera, tgl_buat, id_buat) 
                VALUES ('$id_uttp', '$id_jenis', '$merek', '$type_model', '$no_seri', '$kapasitas', '$buatan', '$koofesien', '$jumlah_nosel', '$medium', '$id_pemilik', '$tgl_beli', '$sudah_tera', NOW(), '$idlogin')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    
    public function Updatex($id_uttp, $id_jenis, $merek, $type_model, $no_seri, $kapasitas, $buatan, $koofesien, $jumlah_nosel, $medium, $id_pemilik, $tgl_beli, $sudah_tera,$idlogin){
        $sql = "UPDATE uttp 
                SET id_jenis = '$id_jenis', merek = '$merek', type_model = '$type_model', no_seri = '$no_seri', kapasitas = '$kapasitas', buatan = '$buatan', koofesien = '$koofesien', jumlah_nosel = '$jumlah_nosel', medium = '$medium', id_pemilik = '$id_pemilik', tgl_beli = '$tgl_beli', sudah_tera = '$sudah_tera', tgl_update = NOW(), id_update = '$idlogin'
                WHERE id_uttp = '$id_uttp'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    
    public function Deletex($id_uttp){
        $sql = "DELETE FROM uttp WHERE id_uttp='$id_uttp'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
}