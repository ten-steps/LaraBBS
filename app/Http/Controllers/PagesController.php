<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Horizon\Horizon;

class PagesController extends Controller
{
    public function root()
    {
        return view('pages.root');
    }
}
