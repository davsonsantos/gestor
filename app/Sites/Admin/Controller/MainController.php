<?php

namespace App\Sites\Admin\Controller;

use App\Core\Controller;
use App\Core\Security;

class MainController extends Controller
{

    public function __construct()
    {
        parent::__construct('Admin');

        Security::protect([1, 2]);
    }

    public function index()
    {
        $this->view('home.index');
    }
}
