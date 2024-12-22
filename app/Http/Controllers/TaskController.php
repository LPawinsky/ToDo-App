<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        return view('tasks.index');
    }

}
