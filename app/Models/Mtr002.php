<?php
namespace App\Models;
use CodeIgniter\Model;
class Mtr002 extends Model{
    public function getData(){
        $sql = "SELECT * FROM tarif_uttp ORDER BY id_tarif";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id_tarif){
        $sql = "SELECT * FROM tarif_uttp WHERE id_tarif = '$id_tarif' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id_tarif, $id_jenis, $kategori, $harga_diluar, $harga_ditempat, $idlogin){
    $sql = "INSERT INTO tarif_uttp (id_tarif, id_jenis, kategori, harga_diluar, harga_ditempat, tgl_buat, id_buat) 
            VALUES ('$id_tarif', '$id_jenis', '$kategori', '$harga_diluar', '$harga_ditempat', NOW(), '$idlogin')";
    $dt = db_connect()->query($sql);
    return $dt ? "1" : "0";
    }

    public function Updatex($id_tarif, $id_jenis, $kategori, $harga_diluar, $harga_ditempat, $idlogin){
        $sql = "UPDATE tarif_uttp 
                SET id_jenis = '$id_jenis', kategori = '$kategori', harga_diluar = '$harga_diluar', harga_ditempat = '$harga_ditempat', tgl_update = NOW(), id_update = '$idlogin'
                WHERE id_tarif = '$id_tarif'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
 
    public function Deletex($id_tarif){
        $sql = "DELETE FROM tarif_uttp WHERE id_tarif='$id_tarif'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
   
}