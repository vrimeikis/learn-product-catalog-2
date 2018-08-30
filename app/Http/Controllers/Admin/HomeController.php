<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Class HomeController
 * @package App\Http\Controllers\Admin
 */
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }
}
