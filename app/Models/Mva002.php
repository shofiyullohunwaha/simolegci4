<?php
namespace App\Models;
use CodeIgniter\Model;
class Mva002 extends Model{
    public function getData(){
        $sql = "SELECT * FROM va ORDER BY id_va";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id_va){
        $sql = "SELECT * FROM va WHERE id_va = '$id_va' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id_va, $tagihan, $total, $tgl_bayar, $channel, $ref, $idlogin){
        $sql = "INSERT INTO va (id_va, tagihan, total, tgl_bayar, channel, ref, tgl_buat, id_buat) 
                VALUES ('$id_va', '$tagihan', '$total', '$tgl_bayar', '$channel', '$ref', NOW(), '$idlogin')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    
    
    public function Updatex($id_va, $tagihan, $total, $tgl_bayar, $channel, $ref){
        $sql = "UPDATE va 
                SET tagihan = '$tagihan', total = '$total', tgl_bayar = '$tgl_bayar', channel = '$channel', ref = '$ref', tgl_update = NOW()
                WHERE id_va = '$id_va'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    
    
    public function Deletex($id_va){
        $sql = "DELETE FROM va WHERE id_va='$id_va'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
}