<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    // Core Controller
    protected $database, $auth;

    public function __construct()
    {
        $factory = (new factory)
            ->withServiceAccount('../../../prodjek-in-firebase-adminsdk-ubs1n-eb82c4e517.json')
            ->withDatabaseUrl('https://prodjek-in-default-rtdb.asia-southeast1.firebasedatabase.app/');

        $this->auth = $factory->createAuth();
        $this->database = $factory->createDatabase();
    }

}
