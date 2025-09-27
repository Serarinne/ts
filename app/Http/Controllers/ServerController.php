<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ServerController extends Controller{
    public function serverDomain(){
        return "waifuwall.com";
    }
}