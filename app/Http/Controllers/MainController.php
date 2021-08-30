<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(){

        $products = Product::paginate();
        return view('index', compact('products'));
        
    }

    public function show(){
        return view('products');
    }
}
