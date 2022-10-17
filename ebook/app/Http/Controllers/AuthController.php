<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function me(){
        return[
        'NIS' => 3103120199,
        'Name' => 'Rizki Syafa Nirmala',
        'Phone' => '085326831850',
        'Class' => 'XII RPL 6'
    ];
    }
}
