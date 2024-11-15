<?php

namespace App\Http\Controllers;
use App\Models\{Store,Package};

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
       $packages=Package::with('store','commune.wilaya','deliveryType','status')->paginate(500);
    //    return $packages;
       return view('index',compact('packages'));
    }
}
