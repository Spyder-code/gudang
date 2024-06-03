<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Finance extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'pages' => 'Dashboard'
        ];
        return view('dashboard/finance/index', $data);
    }
}
