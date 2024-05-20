<?php
namespace App\Models;
use CodeIgniter\Model;
class Mpu002 extends Model{
    public function getData(){
        $sql = "SELECT pu.*, d.nama AS nama FROM pemilik_uttp AS pu LEFT JOIN desa AS d ON pu.id_desa = d.id_desa ORDER BY pu.id_pemilik";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id_pemilik){
        $sql = "SELECT * FROM pemilik_uttp WHERE id_pemilik = '$id_pemilik' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter2($id_pemilik){
        $sql = "SELECT * FROM pemilik_uttp WHERE id_pemilik = '$id_pemilik' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id_pemilik, $nama_pemilik, $nama_usaha, $izin_pabrik, $narahubung, $id_desa, $email, $no_telpon, $idlogin){
        $sql = "INSERT INTO pemilik_uttp (id_pemilik, nama_pemilik, nama_usaha, izin_pabrik, narahubung, id_desa, email, no_telpon, tgl_buat, id_buat) 
        VALUES ('$id_pemilik', '$nama_pemilik', '$nama_usaha', '$izin_pabrik', '$narahubung', '$id_desa', '$email', '$no_telpon', NOW(), '$idlogin')";
      $dt = db_connect()->query($sql);
      return $dt ? "1" : "0";
  }
    
    
  public function Updatex($id_pemilik, $nama_pemilik, $nama_usaha, $izin_pabrik, $narahubung, $id_desa, $email, $no_telpon, $idlogin){
    $sql = "UPDATE pemilik_uttp SET  nama_pemilik = '$nama_pemilik',  nama_usaha = '$nama_usaha', izin_pabrik = '$izin_pabrik', narahubung = '$narahubung',  id_desa = '$id_desa', email = '$email',  no_telpon = '$no_telpon', tgl_update = NOW(), id_update = '$idlogin' WHERE id_pemilik = '$id_pemilik'";
    $dt = db_connect()->query($sql);
    return $dt ? "1" : "0";
}

    

    public function Deletex($id_pemilik){
        $sql = "DELETE FROM pemilik_uttp WHERE id_pemilik='$id_pemilik'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
   
}