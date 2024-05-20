<?php
namespace App\Models;
use CodeIgniter\Model;
class Mpg003 extends Model{
    public function getData(){
         $sql = "SELECT pu.*, d.nama AS nama FROM pegawai AS pu LEFT JOIN desa AS d ON pu.id_desa = d.id_desa ORDER BY pu.id_pegawai";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id_pegawai){
        $sql = "SELECT * FROM pegawai WHERE id_pegawai = '$id_pegawai' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id_pegawai, $nama_pegawai, $jenis_kelamin, $no_telpon, $email, $id_desa, $idlogin){
        $sql = "INSERT INTO pegawai (id_pegawai, nama_pegawai, jenis_kelamin, no_telpon, email, id_desa,tgl_buat,id_buat) 
                VALUES ('$id_pegawai', '$nama_pegawai', '$jenis_kelamin', '$no_telpon', '$email', '$id_desa',NOW(), '$idlogin')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    
    public function Updatex($id_pegawai, $nama_pegawai, $jenis_kelamin, $no_telpon, $email, $id_desa, $idlogin){
        $sql = "UPDATE pegawai 
                SET nama_pegawai = '$nama_pegawai', jenis_kelamin = '$jenis_kelamin', no_telpon = '$no_telpon', email = '$email', id_desa = '$id_desa' 
                WHERE id_pegawai = '$id_pegawai'";
        $query = $this->db->query($sql);
        return $query ? "1" : "0";
    }
        
    public function Deletex($id_pegawai){
        $sql = "DELETE FROM pegawai WHERE id_pegawai='$id_pegawai'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }

    public function getKab($prov_id) {
        $sql = "SELECT * FROM `kab_kota` WHERE provinsi_id =`$prov_id`";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
  
    
}