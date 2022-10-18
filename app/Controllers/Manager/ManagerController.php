<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;

class ManagerController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];

        return View('Manager/Home/index', $data);
    }
}
