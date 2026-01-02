<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsertionSortController extends Controller
{
    public function index()
        {
         // Kirim data acak ke View
            $cards = [10, 3, 7, 5, 2, 8, 4]; 
            return view('insertion_sort', compact('cards'));
        }

}
