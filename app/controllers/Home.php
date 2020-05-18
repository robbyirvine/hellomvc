<?php

namespace App\Controllers;

use Core\View;
use app\models\sumbangan;
class Home extends \Core\Controller
{
    public function index()
    {
        $result = sumbangan::getName();
        View::renderTemplate("home/index.html", [
            'judul' => 'Donasi COVID-19',
            'jenis' => $result
        ]);
    }

    public function inputdata()
    {   
        $warning = "";
        $tipedonasi = $_POST['jenisSumbangan'];
        $total = $_POST['jumlah'];
        if(!isset($_POST['submit'])) return;
        
        foreach($total as $tot){
            if($tot == "" || $tot == 0 ) $warning = "Jumlah kosong";
        }
        foreach($tipedonasi as $td){
            if($td == "") $warning = "Jenis kosong";
        }
        if($_POST['name'] == "") $warning = "Nama kosong";
        if($warning != ""){
            $result = sumbangan::getName();
            View::renderTemplate("home/index.html", [
            'judul' => 'Sumbangan COVID-19',
            'jenis' => $result,
            'alert' => $warning
        ]);
        return;
        }

        if(!isset($_POST['submit'])) return;

        $userid = sumbangan::setUser( $_POST['name'], $_POST['gender'] );

        
        $iter = 0;

        foreach($tipedonasi as $td){
            $tdid = sumbangan::isThere($td);

            if( $tdid >= 1){
                $done = sumbangan::setSumbangan($userid,$tdid,$total[$iter]);
            }
            else{
                $tdid = sumbangan::setJS($td);
                $done = sumbangan::setSumbangan($userid, $tdid[0], $total[$iter]);
            }
            $iter++;
        }
        $result = sumbangan::getName();
        View::renderTemplate("home/index.html", [
            'judul' => 'Donasi',
            'jenis' => $result,
            'pesan' => 'Donasi Berhasil',
        ]);

    }
}