<?php
namespace App\Models;
use CodeIgniter\Model;
class Mfo110 extends Model{
    public function getData(){
        $sql = "SELECT a.*, b.nama AS menu, c.nama AS sistem FROM form AS a LEFT JOIN menu AS b ON a.id_menu = b.id LEFT JOIN sistem AS c ON a.id_sistem = c.id  ORDER BY a.id_sistem, a.id_menu, a.urut";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Filter($id){
        $sql = "SELECT * FROM form WHERE id = '$id' LIMIT 1";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function CekUse($id){
        $sql = "SELECT * FROM form_level WHERE id_form = '$id'";
        $dt = db_connect()->query($sql);
        return $dt ? $dt->getResult() : 0;
    }
    public function Add($id, $nama, $menu, $sistem, $urut, $status, $icon, $tampil, $idlogin){
        $sql = "INSERT INTO form VALUES('$id','$nama','$menu','$sistem','$icon','$status','$urut','$tampil',NOW(),'0000-00-00','$idlogin','')";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    public function Updatex($id, $nama, $menu, $sistem, $urut, $status, $icon, $tampil, $idlogin){
        $sql = "UPDATE form SET nama='$nama', id_menu='$menu', id_sistem='$sistem', icon='$icon', status='$status', urut='$urut', tampil='$tampil', tgl_update=NOW(), id_update='$idlogin' WHERE id='$id'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
    public function Deletex($id){
        $sql = "DELETE FROM form WHERE id='$id'";
        $dt = db_connect()->query($sql);
        return $dt ? "1" : "0";
    }
   
}





