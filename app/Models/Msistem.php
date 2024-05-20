<?php
namespace App\Models;
use CodeIgniter\Model;
class Msistem extends Model{
    public function UpdateProfil($id, $nama){
        $sql = "UPDATE akses SET nama='$nama', tgl_update=NOW(), id_update='$id' WHERE id='$id'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }

    public function getSistem($status){
        $sql = "SELECT * FROM sistem WHERE status = '$status'";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }

    public function getDashboard01(){
        $sql = "SELECT (SELECT COUNT(*) FROM sistem) AS sistem, (SELECT COUNT(*) FROM level) AS level, (SELECT COUNT(*) FROM form) AS form, (SELECT COUNT(*) FROM akses) AS akun, (SELECT COUNT(*) FROM kode_akses) AS hakakses, (SELECT COUNT(*) FROM log_history) AS log";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }

    public function getLogBulanan(){
        $sql = "SELECT DATE_FORMAT(tgl, '%d-%m-%Y') AS tgl, COUNT(*) AS jumlah FROM log_history WHERE YEAR(tgl) = YEAR(CURDATE()) AND MONTH(tgl) = MONTH(CURDATE()) GROUP BY DATE_FORMAT(tgl, '%d-%m-%Y') ORDER BY DATE_FORMAT(tgl, '%d-%m-%Y')";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
}
