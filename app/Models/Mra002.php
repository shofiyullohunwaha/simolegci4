<?php
namespace App\Models;
use CodeIgniter\Model;
class Mra002 extends Model{
    public function getData(){
        $sql = "SELECT pu.*, d.merek AS merek, p.nama_pegawai AS nama_pegawai FROM tera AS pu LEFT JOIN uttp AS d ON pu.id_uttp = d.id_uttp LEFT JOIN pegawai AS p ON pu.id_petugas = p.id_pegawai ORDER BY pu.id_tera;";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id_tera){
        // $sql = "SELECT pu.*, d.merek AS merek FROM tera AS pu LEFT JOIN uttp AS d ON pu.id_uttp = d.id_uttp ORDER BY pu.id_tera LIMIT 1";
        $sql = "SELECT * FROM tera WHERE id_tera = '$id_tera' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id_tera, $id_uttp, $id_tarif,  $kategori, $tmpt_sidang, $harga, $id_petugas,$tgl_approve, $status, $alasan, $skkhp, $harga_skhp, $jenis_tera, $hasil_tera, $tgl_sidang, $idlogin){
        $sql = "INSERT INTO tera (id_tera, id_uttp, id_tarif, kategori, tmpt_sidang, harga,id_petugas, tgl_approve, status, alasan, skkhp, harga_skhp, jenis_tera, hasil_tera, tgl_sidang, tgl_buat, id_buat) 
                VALUES ('$id_tera', '$id_uttp', '$id_tarif', '$kategori', '$tmpt_sidang', '$harga', '$id_petugas','$tgl_approve', '$status', '$alasan', '$skkhp', '$harga_skhp', '$jenis_tera', '$hasil_tera', '$tgl_sidang', NOW(), '$idlogin')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }

    public function Updatex( $id_tera,$id_uttp,$id_tarif,  $kategori, $tmpt_sidang, $harga,$id_petugas, $tgl_approve, $status, $alasan, $skkhp, $harga_skhp, $jenis_tera, $hasil_tera, $tgl_sidang, $idlogin){
        $sql = "UPDATE tera 
                SET id_uttp = '$id_uttp',id_tarif = '$id_tarif', kategori = '$kategori',   tmpt_sidang = '$tmpt_sidang',harga = '$harga', id_petugas ='$id_petugas', tgl_approve = '$tgl_approve', status = '$status', alasan = '$alasan', skkhp = '$skkhp', harga_skhp = '$harga_skhp', jenis_tera = '$jenis_tera', hasil_tera = '$hasil_tera', tgl_sidang = '$tgl_sidang', tgl_update = NOW(), id_update = '$idlogin'
                WHERE id_uttp = '$id_uttp'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }

    public function Deletex($id_tera){
        $sql = "DELETE FROM tera WHERE id_tera='$id_tera'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }

    public function filterDataByDates($startDate, $endDate) {
        $sql = "SELECT pu.*, d.merek AS merek, p.nama_pegawai AS nama_pegawai FROM tera AS pu 
        LEFT JOIN uttp AS d ON pu.id_uttp = d.id_uttp
        LEFT JOIN pegawai AS p ON pu.id_petugas = p.id_pegawai
        WHERE pu.tgl_sidang BETWEEN '$startDate' AND '$endDate'
        ORDER BY pu.id_tera;";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : [];
    }
}