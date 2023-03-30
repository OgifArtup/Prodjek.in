<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    // Core Controller
    private $database;

    public function __construct()
    {
        $this->database = \App\Services\FirebaseService::connect();
    }

}
