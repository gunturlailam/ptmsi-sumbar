<?php

namespace App\Controllers;

use App\Models\AtletModel;
use App\Models\PelatihModel;

class AtletPelatih extends BaseController
{
    public function index()
    {
        $atlet = (new AtletModel())->findAll();
        $pelatih = (new PelatihModel())->findAll();
        return view('atlet_pelatih', compact('atlet', 'pelatih'));
    }
}
