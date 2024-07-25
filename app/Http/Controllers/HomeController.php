<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $categoryId = $request->input('category_id');
        
        $products = Product::when($categoryId, function ($query, $categoryId) {
            return $query->where('category_id', $categoryId);
        })->get();

        return view('home', compact('categories', 'products'));
    }
}
