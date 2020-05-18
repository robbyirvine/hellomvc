<?php

namespace App\Controllers;
use Core\View;
use App\Models\sumbangan;
class Jenis extends \Core\Controller
{
    public function index()
    {
        $result = sumbangan::getName();
        $data = sumbangan::getSumbangan();
        View::renderTemplate("home/rekap.html", [
            'judul' => 'List Sumbangan COVID-19',
            'jenis' => $result,
            'data' => $data,
            'nav' => FALSE,
            'name'=> 'all'
        ]);

    }
    public function filter()
    {
        if(!isset($_GET['submit'])) return;
        $result = sumbangan::getName();
        $data = sumbangan::getFilterSumbangan($_GET['submit']);
        View::renderTemplate("home/rekap.html", [
            'judul' => 'List Sumbangan ' . $_GET['submit'] . ' COVID-19',
            'jenis' => $result,
            'data' => $data,
            'nav' => FALSE,
            'name' => $_GET['submit']
        ]);

    }
}