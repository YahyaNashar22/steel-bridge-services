<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminManualController extends Controller
{
    public function __invoke()
    {
        return view('admin.manual', [
            'title' => 'Admin Manual',
        ]);
    }
}
